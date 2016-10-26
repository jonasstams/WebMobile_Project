<?php
require_once('IDailyReportRepository.php');
require_once('DailyReport.php');
require_once('CustomerRepository.php');
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 9/10/2016
 * Time: 2:27
 */


class DailyReportRepository implements IDailyReportRepository
{
    private $connection = null;
 
    public function __construct(\PDO $connection)
    {
            $this->connection = $connection;
    }


    public function findDailyReportById($dailyReportId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM daily_report WHERE id=?');
            $stmt->bindParam(1, $dailyReportId, \PDO::PARAM_INT);
            $stmt->execute();

            $dailyReport = $stmt->fetchObject('DailyReport');

            if (!empty($dailyReport)) {
                return $dailyReport;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function findDailyReportsByCustomerId($customerId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM daily_report WHERE customer_id=?');
            $stmt->bindParam(1, $customerId, \PDO::PARAM_INT);
            $stmt->execute();
            $dailyReports = [];
            while($dailyReport = $stmt->fetchObject('DailyReport'))
            {
                $dailyReports[] = $dailyReport->toArray();
            }

            if (count($dailyReports) > 0) {
                return $dailyReports;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addDailyReport($customerId, $dailyReport)
    {
        if(!empty($dailyReport->created_at)){
            $date = DateTime::createFromFormat('d-m-Y', $dailyReport->created_at)->format('Y-m-d');
        }else{
            $date = date("Y-m-d");
        }

       $customerRepository = new CustomerRepository($this->connection);
       
        $customerExists = $customerRepository->checkCustomerExists($customerId);

        if($customerExists){
            if($this->checkIfNoDailyReportOnDate($customerId, $date)){
            try {
            $objDailyReport = new DailyReport();

            $objDailyReport->setCustomerId($customerId);

            if(isset($dailyReport->habit1_done))
            $objDailyReport->setHabit1Done($dailyReport->habit1_done);
            else
            $objDailyReport->setHabit1Done(false);

            if(isset($dailyReport->habit2_done))
            $objDailyReport->setHabit2Done($dailyReport->habit2_done);
            else
            $objDailyReport->setHabit2Done(false);

            if(isset($dailyReport->habit3_done))
            $objDailyReport->setHabit3Done($dailyReport->habit3_done);
            else
            $objDailyReport->setHabit3Done(false);

            if(isset($dailyReport->weight))
            $objDailyReport->setWeight($dailyReport->weight);
            else
            $objDailyReport->setWeight(0);

            if(isset($dailyReport->calories))
            $objDailyReport->setCalories($dailyReport->calories);
            else
            $objDailyReport->setCalories(0);

            if(isset($dailyReport->extra_information))
            $objDailyReport->setExtraInformation($dailyReport->extra_information);
            else
            $objDailyReport->setExtraInformation('No information given');

            $objDailyReport->setCreatedAt($date);

            $stmt = $this->connection->prepare("INSERT INTO daily_report(customer_id, habit1_done, habit2_done, habit3_done, weight, calories, extra_information, created_at)
                                            VALUES(:customer_id, :habit1_done, :habit2_done, :habit3_done, :weight, :calories, :extra_information, :created_at)");
            $stmt->execute(array(
                "customer_id" => $objDailyReport->getCustomerId(),
                "habit1_done" => $objDailyReport->getHabit1Done(),
                "habit2_done" => $objDailyReport->getHabit2Done(),
                "habit3_done" => $objDailyReport->getHabit3Done(),
                "weight" => $objDailyReport->getWeight(),
                "calories" => $objDailyReport->getCalories(),
                "extra_information" => $objDailyReport->getExtraInformation(),
                "created_at" => $objDailyReport->getCreatedAt()
            ));
            return array("created" => true);
        } catch (PDOException $e) {
             return array("created" => false, "error" => $e->getMessage());
        }
             }else{
            return array("created" => false,"error" => 'Only 1 daily reports per day! id:'. $customerId . ' date:' .$date);
        }
        
        }else{
                return array("created" => false,"error" => 'No customer found with id '. $customerId);
        
        }
   }
     

    public function changeDailyReport($dailyReportId, $dailyReportUpdate)
    {
        try
        {
            $dailyReport = $dailyReport = $this->findDailyReportById($dailyReportId);
            if($dailyReport != null){
                if($this->validateUpdateData($dailyReportUpdate))
                {
                if(isset($dailyReportUpdate->habit1_done))
                    $dailyReport->setHabit1Done($dailyReportUpdate->habit1_done);
                if(isset($dailyReportUpdate->habit2_done))
                    $dailyReport->setHabit2Done($dailyReportUpdate->habit2_done);
                if(isset($dailyReportUpdate->habit3_done))
                    $dailyReport->setHabit3Done($dailyReportUpdate->habit3_done);
                if(isset($dailyReportUpdate->weight))
                    $dailyReport->setWeight($dailyReportUpdate->weight);
                if(isset($dailyReportUpdate->calories))
                    $dailyReport->setCalories($dailyReportUpdate->calories);
                if(isset($dailyReportUpdate->extra_information))
                    $dailyReport->setExtraInformation($dailyReportUpdate->extra_information);
                    

                $stmt = $this->connection->prepare("UPDATE daily_report SET habit1_done = :habit1_done, 
                                                                            habit2_done = :habit2_done, 
                                                                            habit3_done = :habit3_done, 
                                                                            weight = :weight, 
                                                                            calories = :calories, 
                                                                            extra_information = :extra_information
                                                                            WHERE id = :id");
                $stmt->execute(array(
                    "habit1_done" => $dailyReport->getHabit1Done(),
                    "habit2_done" => $dailyReport->getHabit2Done(),
                    "habit3_done" => $dailyReport->getHabit3Done(),
                    "weight" => $dailyReport->getWeight(),
                    "calories" => $dailyReport->getCalories(),
                    "extra_information" => $dailyReport->getExtraInformation(),
                    "id" => $dailyReportId
                ));
                 return array("changed"=>true);   
          
            }else{
                   return array("changed"=>false,"error"=>"Check your data, no correct PUT data found");   
            }
            }else{
                return array("changed"=>false, "error"=>"No daily report with id: " . $dailyReportId);
            }            
        }catch (PDOException $e)
        {
            return array("changed"=>false,"error"=>$e->getMessage());   
        }

    }

    public function checkIfNoDailyReportOnDate($customerId, $date)
    {
         $stmt = $this->connection->prepare("SELECT * FROM daily_report WHERE customer_id = :customer_id AND Date(created_at) = :created_at");
                $stmt->execute(array(
                    "customer_id" => $customerId,
                    "created_at" => date($date),
                ));
            if($stmt->rowCount() == 0){
                return true;
            }else{
                return false;
            }     return array("changed"=>false, "error"=>"No daily report with id: " . $dailyReportId);
    }

    public function countDailyReports()
    {
        $stmt = $this->connection->prepare("SELECT COUNT(id) FROM daily_report");
        $stmt->execute();
        $count = $stmt->fetch();
        return $count[0];
    }

    public function findMetaData($extra_information)
    {
        try
        {
           $metaData = array("daily_report_count" => $this->countDailyReports(), "extra_information" => $extra_information);
            return array("meta" => $metaData);

        }catch (PDOException $e)
        {
             return null;
        }
    }

    public function validateUpdateData($data)
    {
        if(isset($data)){
              if(isset($data->habit1_done) || isset($data->habit2_done) || isset($data->habit3_done) || isset($data->weight) || isset($data->calories) )
                return true;
            else
                return false;
        }else{
            return false;
        }
                
    }
}
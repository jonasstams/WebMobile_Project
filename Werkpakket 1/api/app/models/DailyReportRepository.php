<?php
require_once('IDailyReportRepository.php');
require_once('DailyReport.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 9/10/2016
 * Time: 2:27
 */


class DailyReportRepository implements IDailyReportRepository
{
    private $connection = null;
    private $log;

    public function __construct(\PDO $connection)
    {
        try {
            $this->connection = $connection;
            $this->log = new Logger('PDOReport_Logger');
            $this->log->pushHandler(new StreamHandler('../logs/PDOReport_Logfile.log', Logger::WARNING));
        } catch (PDOException $e) {
            $this->log->addWarning('Unable to connect with the database.');
            $this->log->addError($e->getMessage());
        }
    }


    public function findDailyReportById($dailyReportId)
    {
        try {
            $this->log->addWarning('findDailyReportsById executed with id = ' . $dailyReportId);
            $stmt = $this->connection->prepare('SELECT * FROM daily_report WHERE id=?');
            $stmt->bindParam(1, $dailyReportId, \PDO::PARAM_INT);
            $stmt->execute();

            $dailyReport = $stmt->fetchObject('DailyReport');

            if (!empty($dailyReport)) {
                return $dailyReport;
            } else {
                $this->log->addError("Daily Report with id = " . $dailyReportId . " does not exist.");
                return null;
            }
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }
    }

    public function findDailyReportsByCustomerId($customerId)
    {
        try {
            $this->log->addWarning('findDailyReportsByCustomerId executed for customer with id = ' . $customerId);
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
                $this->log->addError("Customer with id = " . $customerId . " does not exist.");
                return null;
            }
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }
    }

    public function addDailyReport($customerId, $dailyReport)
    {
        try {
            $this->log->addWarning('addDailyReport executed for customer with id = ' . $customerId);
            $objDailyReport = new DailyReport();
            $objDailyReport->setCustomerId($customerId);
            $objDailyReport->setHabit1Done($dailyReport->habit1_done);
            $objDailyReport->setHabit2Done($dailyReport->habit2_done);
            $objDailyReport->setHabit3Done($dailyReport->habit3_done);
            $objDailyReport->setWeight($dailyReport->weight);
            $objDailyReport->setCalories($dailyReport->calories);
            $objDailyReport->setExtraInformation($dailyReport->extra_information);

            $stmt = $this->connection->prepare("INSERT INTO daily_report(customer_id, habit1_done, habit2_done, habit3_done, weight, calories, extra_information)
                                            VALUES(:customer_id, :habit1_done, :habit2_done, :habit3_done, :weight, :calories, :extra_information)");
            $stmt->execute(array(
                "customer_id" => $objDailyReport->getCustomerId(),
                "habit1_done" => $objDailyReport->getHabit1Done(),
                "habit2_done" => $objDailyReport->getHabit2Done(),
                "habit3_done" => $objDailyReport->getHabit3Done(),
                "weight" => $objDailyReport->getWeight(),
                "calories" => $objDailyReport->getCalories(),
                "extra_information" => $objDailyReport->getExtraInformation()
            ));
            $this->log->addWarning('Daily report created.');
            return true;
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
            return false;
        }
    }

    public function changeDailyReport($dailyReportId, $dailyReportUpdate)
    {
        try
        {
            $this->log->addWarning('changeDailyReport executed for daily report with id = ' . $dailyReportId);
            
            if(!empty($dailyReportUpdate))
            {
                $dailyReport = $this->findDailyReportById($dailyReportId);
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
                $this->log->addWarning('Daily report with id ' . $dailyReportId . ' changed.') ;
                return true;
            }
            
        }catch (PDOException $e)
        {
            $this->log->addError($e->getMessage());
        }

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
            $this->log->addWarning('findMetaData executed in DailyReportRepository');
            $metaData = array("daily_report_count" => $this->countDailyReports(), "extra_information" => $extra_information);
            return array("meta" => $metaData);

        }catch (PDOException $e)
        {
            $this->log->addError($e->getMessage());
        }
    }
}
<?php
require_once('ICustomerRepository.php');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CustomerRepository implements ICustomerRepository
{

    private $connection = null;
    private $log;

    public function __construct(PDO $connection = null)
    {
            $this->connection = $connection;
    }

    public function findAllAsObject()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM customers');
            $stmt->execute();
            $customers = [];
            while($customer = $stmt->fetchObject('Customer'))
            {
                $customers[] = $customer;
            }
            if (count($customers) > 0) {
                return $customers;
            } else {
                return null;
                }
        } catch (PDOException $e) {
                return null;
        }

    }

    public function findAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM customers');
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($customers) > 0)
                return $customers;
            else
                return null;
        } catch (PDOException $e) {
            return null;
      }

    }


    public function findCustomerById($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM customers WHERE id=?');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $customer = $stmt->fetchObject('Customer');

            if (!empty($customer)) {
                return $customer;
            } else {
               return null;
            }
        } catch (PDOException $e) {
            return null;
     }
    }

    public function findHabitsFromCustomerById($id) {
        $customer = $this->findCustomerById($id);
        if($customer != null)
            return $customer->getHabits();
        else
            return null;
    }


    public function addCustomer($customerPostData)
    {
        try {

            $customer = new Customer();
                if(isset($customerPostData->first_name))
                        $customer->setFirstName($customerPostData->first_name);
                    if(isset($customerPostData->last_name))
                        $customer->setLastName($customerPostData->last_name);
                    if(isset($customerPostData->habit1))
                        $customer->setHabit1($customerPostData->habit1);
                    if(isset($customerPostData->habit2))
                        $customer->setHabit2($customerPostData->habit2);
                    if(isset($customerPostData->habit3))
                        $customer->setHabit3($customerPostData->habit3);
                    if(isset($customerPostData->profile_picture))
                        $customer->setProfilePictureUrl($customerPostData->profile_picture_url);

            $stmt = $this->connection->prepare
                (
                    "INSERT INTO customers(first_name, last_name, habit1, habit2, habit3, profile_picture_url)
                     VALUES(:first_name, :last_name, :habit1,:habit2,:habit3, :profile_picture)"
                );
            $stmt->execute(array(
                'first_name' => $customer->getFirstName(),
                'last_name' => $customer->getLastName(),
                'habit1' => $customer->getHabit1(),
                'habit2' => $customer->getHabit2(),
                'habit3' => $customer->getHabit3(),
                'profile_picture' => $customer->getProfilePictureUrl()
            ));
            return array("created" => true);
        } catch (PDOException $e) {
             return array("created" => false, "error" => $e->getMessage());
        }
    }

    public function changeCustomer($customerId, $customerUpdateData)
    {
        try
        {
            $customer = $this->findCustomerById($customerId);
            if($customer != null){
                  if($this->validateUpdateData($customerUpdateData))
                {
                    if(isset($customerUpdateData->first_name))
                        $customer->setFirstName($customerUpdateData->first_name);
                    if(isset($customerUpdateData->last_name))
                        $customer->setLastName($customerUpdateData->last_name);
                    if(isset($customerUpdateData->habit1))
                        $customer->setHabit1($customerUpdateData->habit1);
                    if(isset($customerUpdateData->habit2))
                        $customer->setHabit2($customerUpdateData->habit2);
                    if(isset($customerUpdateData->habit3))
                        $customer->setHabit3($customerUpdateData->habit3);

                    $stmt = $this->connection->prepare
                    (
                        "UPDATE customers SET  first_name = :first_name, 
                                            last_name = :last_name, 
                                            habit1 = :habit1, 
                                            habit2 = :habit2, 
                                            habit3 = :habit3 
                                            WHERE id = :id"
                    );
                    $stmt->execute(array(
                        "first_name" => $customer->getFirstName(),
                        "last_name" => $customer->getLastName(),
                        "habit1" => $customer->getHabit1(),
                        "habit2" => $customer->getHabit2(),
                        "habit3" => $customer->getHabit3(),
                        "id" => $customerId
                    ));
                    return array("changed"=>true); 

                }else{
                      return array("changed"=>false,"error"=>"Check your data, no correct PUT data found");   
            }
            }else{
                     return array("changed"=>false, "error"=>"No customer with id: " . $customerId);
            }
                      
        }catch (PDOException $e)
        {
                      return array("changed"=>false, "error"=>$e->getMessage());
        }
    }

    public function removeCustomer($id)
    {
        $customerExists = $this->checkCustomerExists($id);
       if($customerExists){
        $stmt = $this->connection->prepare("DELETE FROM customers WHERE id=:id");
        $stmt->execute(array("id" => $id));
        return true;
       }else{
           return false;
       }
        
    }

    public function countCustomers()
    {
        $stmt = $this->connection->prepare("SELECT COUNT(id) FROM customers");
        $stmt->execute();
        $count = $stmt->fetch();
        return $count[0];
    }

    public function checkCustomerExists($customerId)
    {
        $stmt = $this->connection->prepare("SELECT id FROM customers WHERE id=:id");
        $stmt->execute(array(":id" => $customerId));
        $customer = $stmt->fetch();
        if($customer != null)
            return true;
        else
            return false;
    }
    public function findMetaData($extra_information)
    {
        try
        {
           $customers = $this->findAll();
            $metaData = array("customers_count" => $this->countCustomers(), "extra_information" => $extra_information);
            $customerIds = [];
            foreach ($customers as $customer)
            {
                $customerIds[] = "id:".$customer->getId();
            }
            return array("meta" => $metaData, "customers" => $customerIds);

        }catch (PDOException $e)
        {
             return null;
        }
    }

    public function validateUpdateData($data)
    {
        if(isset($data)){
            if(isset($data->first_name) || isset($data->last_name) || isset($data->habit1)|| isset($data->habit2) || isset($data->habit3))
                  return true;
            else
                return false;
        }else{
            return false;
        }
   }
}
<?php
require_once('ICustomerRepository.php');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CustomerRepository implements ICustomerRepository
{

    private $connection = null;
    private $log;

    public function __construct(\PDO $connection = null)
    {
        try {
            $this->connection = $connection;
            $this->log = new Logger('PDOCustomer_Logger');
            $this->log->pushHandler(new StreamHandler('../logs/PDOCustomer_Logfile.log', Logger::WARNING));
        } catch (PDOException $e) {
            $this->log->addWarning('Unable to connect with the database.');
            $this->log->addError($e->getMessage());
        }

    }

    public function findAll()
    {
        try {
            $this->log->addWarning('findAll executed.');
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
                $this->log->addError("There are no customers in the database.");
                return null;
            }
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }

    }

    public function findAllAsArray()
    {
        try {
            $this->log->addWarning('findAll executed.');
            $stmt = $this->connection->prepare('SELECT * FROM customers');
            $stmt->execute();
            $customers = [];
            while($customer = $stmt->fetchObject('Customer'))
            {
                $customers[] = $customer->toArray();
            }
            if (count($customers) > 0) {
                return $customers;
            } else {
                $this->log->addError("There are no customers in the database.");
                return null;
            }
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }

    }


    public function findCustomerById($id)
    {
        try {
            $this->log->addWarning('findCustomerById executed for customer with id = ' . $id);
            $stmt = $this->connection->prepare('SELECT * FROM customers WHERE id=?');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $customer = $stmt->fetchObject('Customer');

            if (!empty($customer)) {
                return $customer;
            } else {
                $this->log->addError("Customer with id = " . $id . " does not exist.");
                return null;
            }
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }

    }

    public function findHabitsFromCustomerById($id) {
        $customer = $this->findCustomerById($id);
        if($customer != null)
            return $customer->getHabits();
        else
            return null;
    }


    public function addCustomer($newCustomerData)
    {
        try {
            $this->log->addWarning('addCustomer executed to create a new customer.');
            $newCustomer = new Customer();
            $newCustomer->setFirstName($newCustomerData->first_name);
            $newCustomer->setLastName($newCustomerData->last_name);
            $newCustomer->setHabit1($newCustomerData->habit1);
            $newCustomer->setHabit2($newCustomerData->habit2);
            $newCustomer->setHabit3($newCustomerData->habit3);
            $newCustomer->setUserId($newCustomerData->user_id);
            $stmt = $this->connection->prepare
                (
                    "INSERT INTO customers(first_name, last_name, habit1, habit2, habit3, user_id)
                     VALUES(:first_name, :last_name, :habit1,:habit2,:habit3,:user_id)"
                );
            $stmt->execute(array(
                'first_name' => $newCustomer->getFirstName(),
                'last_name' => $newCustomer->getLastName(),
                'habit1' => $newCustomer->getHabit1(),
                'habit2' => $newCustomer->getHabit2(),
                'habit3' => $newCustomer->getHabit3(),
                'user_id' => $newCustomer->getUserId()
            ));
        } catch (PDOException $e) {
            $this->log->addError($e->getMessage());
        }
    }

    public function changeCustomer($customerId, $customerUpdateData)
    {
        try
        {
            $this->log->addWarning('changeCustomer executed for daily report with id = ' . $customerId);

            if(!empty($customerUpdateData))
            {
                $customer = $this->findCustomerById($customerId);
                if(!empty($customer)){
                    if(isset($customerUpdateData->username))
                        $customer->setUsername($customerUpdateData->username);
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

                    $stmt = $this->connection->prepare("UPDATE customers SET username = :username,  
                                                                            first_name = :first_name, 
                                                                            last_name = :last_name, 
                                                                            habit1 = :habit1, 
                                                                            habit2 = :habit2, 
                                                                            habit3 = :habit3 
                                                                            WHERE id = :id");
                    $stmt->execute(array(
                        "username" => $customer->getUsername(),
                        "first_name" => $customer->getFirstName(),
                        "last_name" => $customer->getLastName(),
                        "habit1" => $customer->getHabit1(),
                        "habit2" => $customer->getHabit2(),
                        "habit3" => $customer->getHabit3(),
                        "id" => $customerId
                    ));
                    $this->log->addWarning('changed Customer with id ' . $customerId) ;
                    return true;

                }else{
                    return false;
                }
            }
        }catch (PDOException $e)
        {
            $this->log->addError($e->getMessage());
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
            $this->log->addWarning('findMetaData executed in CustomerRepository');
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
            $this->log->addError($e->getMessage());
        }
    }

}
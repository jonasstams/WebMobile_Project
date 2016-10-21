<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 14/10/2016
 * Time: 11:54
 */
require_once __DIR__.'/../models/Customer.php';
require_once __DIR__.'/../controllers/CustomerController.php';



class CustomerControllerTest extends PHPUnit_Framework_TestCase
{
    protected $customer;
    protected $exampleJson;
    protected $customerRepositoryMock;
    protected $customerViewMock;
    const CUST_ID = 2;

    public function setUp() {
        $this->customer = new Customer();
        $this->customer->setFirstName("Vincent");
        $this->customer->setLastName("Ravoet");
        
        $this->customerRepositoryMock = $this->getMockBuilder(CustomerRepository::class)
                                                ->disableOriginalConstructor()
                                                ->getMock();
        
        $this->customerViewMock  = $this->getMockBuilder(CustomerView::class)
                                                 ->getMock();
        $this->exampleJson = "{
                'first_name': 'Jonas',
                'last_name': 'Jonas',
                'habit1': 'Niet Roken',
                'habit2': 'drinken',
                'habit3': 'wandelen',
                'username': '',
                'password': ''
                }";
    }

    public function testFindAll_OK() {
        $customer1 = new Customer();
        $customer2 = new Customer();
        $customer3 = new Customer();

        $customer1->setFirstName("Vincent");
        $customer1->setLastName("Ravoet");

        $customer2->setFirstName("Jonas");
        $customer2->setLastName("Stams");

        $customer3->setFirstName("Pieter");
        $customer3->setLastName("Bollen");

        $customers = [$customer1, $customer2, $customer3];

       
        $this->customerRepositoryMock->expects($this->once())
            ->method('findAllAsArray')
            ->will($this->returnValue($customers));

        $this->customerViewMock->expects($this->once())
            ->method('show');
        
        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindAllCustomers();
    }

    public function testFindAll_NoContent() {

        $this->customerRepositoryMock->expects($this->once())
            ->method('findAllAsArray')
            ->will($this->returnValue(null));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpNoContent');


        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindAllCustomers();
    }
    public function testFindCustomerById_OK()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findCustomerById')
            ->will($this->returnValue($this->customer));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindCustomerById(self::CUST_ID);
    }

    public function testFindCustomerById_NoContent()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findCustomerById')
            ->will($this->returnValue(null));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpNoContent');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindCustomerById(self::CUST_ID);
    }

    public function testAddCustomer_Created()
    {

        $this->customerRepositoryMock->expects($this->once())
            ->method('addCustomer')
            ->will($this->returnValue(true));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpCreated');
        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleAddCustomer($this->exampleJson);
    }

    public function testAddCustomer_BadRequest()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('addCustomer')
            ->will($this->returnValue(false));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpBadRequest');
        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleAddCustomer($this->exampleJson);

    }
    
    public function testChangeCustomer_Accepted()
    {

        $this->customerRepositoryMock->expects($this->once())
            ->method('changeCustomer')
            ->will($this->returnValue(true));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpAccepted');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleChangeCustomer(self::CUST_ID,$this->exampleJson);
    }

    public function testChangeCustomer_BadRequest()
    {

        $this->customerRepositoryMock->expects($this->once())
            ->method('changeCustomer')
            ->will($this->returnValue(false));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpBadRequest');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleChangeCustomer(self::CUST_ID,$this->exampleJson);
    }
    
    public function testFindHabitsFromCustomerByCustomerId_OK()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findHabitsFromCustomerById')
            ->will($this->returnValue($this->customer));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindHabitsFromCustomerByCustId(self::CUST_ID);
    }

    public function testFindHabitsFromCustomerByCustomerId_NoContent()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findHabitsFromCustomerById')
            ->will($this->returnValue(null));

        $this->customerViewMock->expects($this->once())
            ->method('sendHttpNoContent');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindHabitsFromCustomerByCustId(self::CUST_ID);
    }
    public function tearDown()
    {
        $this->customer = null;
        $this->customerRepositoryMock = null;
        $this->customerViewMock = null;
        $this->exampleJson = null;
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 14/10/2016
 * Time: 11:54
 */

use App\Controllers\CustomerController;
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

    public function testFindAll() {
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

    public function testFindAllWithCustomerEqualsNull() {

        $this->customerRepositoryMock->expects($this->once())
            ->method('findAllAsArray')
            ->will($this->returnValue(null));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $this->customerRepositoryMock->expects($this->once())
            ->method('findMetaData');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindAllCustomers();
    }
    public function testFindCustomerByIdWithWorkingId()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findCustomerById')
            ->will($this->returnValue($this->customer));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindCustomerById(self::CUST_ID);
    }

    public function testFindCustomerByIdWithCustomerEqualsNull()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findCustomerById')
            ->will($this->returnValue(null));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $this->customerRepositoryMock->expects($this->once())
            ->method('findMetaData');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindCustomerById(self::CUST_ID);
    }

    public function testAddCustomer()
    {

        $this->customerRepositoryMock->expects($this->once())
            ->method('addCustomer');

        $customerController = new CustomerController($this->customerRepositoryMock);
        $customerController->handleAddCustomer($this->exampleJson);
    }
    
    public function testChangeCustomer()
    {

        $this->customerRepositoryMock->expects($this->once())
            ->method('changeCustomer');

        $customerController = new CustomerController($this->customerRepositoryMock);
        $customerController->handleChangeCustomer(self::CUST_ID,$this->exampleJson);
    }
    
    public function testFindHabitsFromCustomerByCustomerId()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findHabitsFromCustomerById')
            ->will($this->returnValue($this->customer));

        $this->customerViewMock->expects($this->once())
            ->method('show');

        $customerController = new CustomerController($this->customerRepositoryMock, $this->customerViewMock);
        $customerController->handleFindHabitsFromCustomerByCustId(self::CUST_ID);
    }

    public function testFindHabitsFromCustomerByCustomerIdWithCustomerEqualsNull()
    {
        $this->customerRepositoryMock->expects($this->once())
            ->method('findHabitsFromCustomerById')
            ->will($this->returnValue(null));

        $this->customerRepositoryMock->expects($this->once())
            ->method('findMetaData');

        $this->customerViewMock->expects($this->once())
            ->method('show');

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
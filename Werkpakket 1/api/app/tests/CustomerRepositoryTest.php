<?php
require_once(__DIR__ . '/../models/CustomerRepository.php');

class CustomerRepositoryTest extends PHPUnit_Framework_TestCase
{
    protected $pdoMock;
    protected $pdoStatementMock;
    protected $customerMock;

    public function setUp()
    {
        $this->pdoMock = $this->getMockBuilder(PDOMock::class)->getMock();
        $this->pdoStatementMock = $this->getMockBuilder(PDOStatement::class)->getMock();
        $this->customerMock = $this->getMockBuilder(Customer::class)->getMock();
    }

    public function testFindAll()
    {
        $this->pdoStatementMock->expects($this->once())->method('execute');
        $this->pdoStatementMock->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->will($this->returnValue(null));
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM customers'))
            ->will($this->returnValue($this->pdoStatementMock));
        $customerRepository = new CustomerRepository($this->pdoMock);
        $customerRepository->findAll();
    }

    public function testFindCustomerById()
    {
        $this->pdoStatementMock->expects($this->once())->method('execute');
        $this->pdoStatementMock->expects($this->once())
            ->method('fetchObject')
            ->will($this->returnValue(null));
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM customers WHERE id=?'))
            ->will($this->returnValue($this->pdoStatementMock));
        $customerRepository = new CustomerRepository($this->pdoMock);
        $customerRepository->findCustomerById(1);
    }
}

class PDOMock extends \PDO
{
    public function __construct()
    {
    }
}
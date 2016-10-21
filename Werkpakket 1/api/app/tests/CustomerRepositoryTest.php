<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 20/10/2016
 * Time: 13:47
 */


class CustomerRepositoryTest extends PHPUnit_Framework_TestCase
{
    protected $pdoMock;
    protected $pdoStatementMock;
    protected $customerMock;
    public function setUp()
    {
        $this->pdoMock =  $this->getMockBuilder(PDOMock::class)->getMock();
        $this->pdoStatementMock = $this->getMockBuilder(PDOStatement::class)->getMock();
        $this->customerMock = $this->getMockBuilder(Customer::class)->getMock();
    }

    public function testFindAllAsArray()
    {
        $this->pdoStatementMock->expects($this->once())->method('execute');

        $this->pdoStatementMock->expects($this->once())->method('fetchObject')->will($this->returnValue(false));
        $this->customerMock->expects($this->any())->method('toArray');
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM customers'))
            ->will($this->returnValue($this->pdoStatementMock));


        $customerRepository = new CustomerRepository($this->pdoMock);

        $customerRepository->findAll();

    }
}
class PDOMock extends \PDO {
    public function __construct() {}
}
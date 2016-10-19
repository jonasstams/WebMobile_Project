<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 18:06
 */

require_once __DIR__.'/../models/DailyReport.php';
require_once __DIR__.'/../models/CustomerRepository.php';
require_once __DIR__.'/../controllers/DailyReportController.php';

class DailyReportControllerTest extends PHPUnit_Framework_TestCase
{
    protected $dailyReport;
    protected $exampleJson;
    protected $dailyReportRepositoryMock;
    protected $dailyReportViewMock;
    const CUST_ID = 2;
    const DR_ID = 2;

    public function setUp() {

        $this->dailyReportRepositoryMock = $this->getMockBuilder(DailyReportRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dailyReportViewMock  = $this->getMockBuilder(DailyReportView::class)
            ->getMock();
        $this->exampleJson = "{'habit1_done': '1',
                                'habit2_done': '1',
                                'habit3_done': '1',
                                'weight': '0',
                                'calories': '0',
                                'extra_information': 'No information given.'}";

        $this->dailyReport = new DailyReport();

        $this->dailyReport->setHabit1Done(true);
        $this->dailyReport->setHabit2Done(true);
        $this->dailyReport->setHabit3Done(false);
        $this->dailyReport->setWeight(65.5);
        $this->dailyReport->setCalories(1000);

    }

    public function testFindDailyReportById_Ok()
    {

        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('findDailyReportById')
            ->will($this->returnValue($this->dailyReport));

        $this->dailyReportViewMock->expects($this->once())
                ->method('show');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleFindDailyReportById(self::DR_ID);
    }

    public function testFindDailyReportById_NoContent()
    {

        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('findDailyReportById')
            ->will($this->returnValue(null));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpNoContent');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleFindDailyReportById(self::DR_ID);
    }

    public function testFindDailyReportByCustomerId_Ok()
    {
       
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('findDailyReportsByCustomerId')
            ->will($this->returnValue($this->dailyReport));

        $this->dailyReportViewMock->expects($this->once())
            ->method('show');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleFindDailyReportByCustomerId(self::CUST_ID);
    }

    public function testFindDailyReportByCustomerId_NoContent()
    {
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('findDailyReportsByCustomerId')
            ->will($this->returnValue(null));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpNoContent');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleFindDailyReportByCustomerId(self::CUST_ID);
    }

    public function testAddDailyReportByCustomerId_Created()
    {
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('addDailyReport')
            ->will($this->returnValue(true));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpCreated');


        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleAddDailyReportByCustomerId(self::CUST_ID, $this->exampleJson);

    }

    public function testAddDailyReportByCustomerId_NoContent()
    {
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('addDailyReport')
            ->will($this->returnValue(false));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpBadRequest');


        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleAddDailyReportByCustomerId(self::CUST_ID, $this->exampleJson);

    }

    public function testChangeDailyReport_Accepted()
    {
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('changeDailyReport')
            ->will($this->returnValue(true));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpAccepted');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleChangeDailyReport(self::CUST_ID, $this->exampleJson);

    }

    public function testChangeDailyReport_BadRequest()
    {
        $this->dailyReportRepositoryMock->expects($this->once())
            ->method('changeDailyReport')
            ->will($this->returnValue(false));

        $this->dailyReportViewMock->expects($this->once())
            ->method('sendHttpBadRequest');

        $dailyReportController =  new DailyReportController($this->dailyReportRepositoryMock, $this->dailyReportViewMock);

        $dailyReportController->handleChangeDailyReport(self::CUST_ID, $this->exampleJson);

    }
    
}
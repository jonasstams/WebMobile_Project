<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 14:33
 */

require_once __DIR__.'/../core/Controller.php';
require_once __DIR__.'/../models/DailyReportRepository.php';
require_once __DIR__.'/../models/CustomerRepository.php';
require_once __DIR__.'/../models/IDailyReportRepository.php';
require_once __DIR__.'/../models/DailyReport.php';
require_once __DIR__.'/../views/DailyReportView.php';
class DailyReportController extends Controller
{
    protected $dailyReport;
    protected $repository;
    protected $view;

    public function __construct(IDailyReportRepository $repository = null, DailyReportView $view = null)
    {
        if($repository == null)
        {
            $this->repository = new DailyReportRepository($this->getDbConnection());
        }else{
            $this->repository = $repository;
        }
        $this->customer = $this->model('Customer');

        if($view == null)
        {
            $this->view = new DailyReportView();
        }else{
            $this->view = $view;
        }

    }

    public function handleFindDailyReportById($dailyReportId)
    {
        $dailyReport = $this->repository->findDailyReportById($dailyReportId);
        if($dailyReport != null)
            $this->view->show(['data' => $dailyReport->toArray()]);
        else
            $this->view->show(['data' => $this->repository->findMetaData("No daily report found with id ". $dailyReportId ."!")]);
    }
    
    public function handleFindDailyReportByCustomerId($customerId)
    {
          $dailyReports = $this->repository->findDailyReportsByCustomerId($customerId);
            if($dailyReports != null)
                $this->view->show(['data' => $dailyReports]);
            else
                $this->view->show(['data' => $this->repository->findMetaData("No daily reports found for customer with id ". $customerId ."!")]);
    }


    public function handleAddDailyReportByCustomerId($customerId, $postData)
    {
        $dailyReport = $this->decodeJson($postData);
        $this->repository->addDailyReport($customerId, $dailyReport);
    }

    public function handleChangeDailyReport($dailyReportId, $putData)
    {
        $dailyReportUpdate = $this->decodeJson($putData);
        $this->repository->changeDailyReport($dailyReportId, $dailyReportUpdate);
    }

}
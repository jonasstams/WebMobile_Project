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
            $this->view->sendHttpNoContent();
    }
    
    public function handleFindDailyReportByCustomerId($customerId)
    {
          $dailyReports = $this->repository->findDailyReportsByCustomerId($customerId);
            if($dailyReports != null)
                $this->view->show(['data' => $dailyReports]);
            else
                $this->view->sendHttpNoContent();
    }


    public function handleAddDailyReportByCustomerId($customerId, $postData)
    {
        $dailyReport = $this->decodeJson($postData);
        $dailyReportCreated = $this->repository->addDailyReport($customerId, $dailyReport);
        if($dailyReportCreated)
            $this->view->sendHttpCreated();
        else
            $this->view->sendHttpBadRequest();


    }

    public function handleChangeDailyReport($dailyReportId, $putData)
    {
        $dailyReportUpdate = $this->decodeJson($putData);
        $dailyReportChanged = $this->repository->changeDailyReport($dailyReportId, $dailyReportUpdate);
        if($dailyReportChanged)
                $this->view->sendHttpAccepted();
            else
                $this->view->sendHttpBadRequest();
    }

}
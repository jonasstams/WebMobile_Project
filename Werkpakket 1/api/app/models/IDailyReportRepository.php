<?php

interface IDailyReportRepository
{
    public function findDailyReportsByCustomerId($customerId);
    public function addDailyReport($customerId, $dailyReport);
}
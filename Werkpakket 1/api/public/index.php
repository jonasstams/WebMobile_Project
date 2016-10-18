<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . '/../app/init.php');
$pdo = Database::getDbConnection();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$customerPDORepository = new CustomerRepository($pdo);
$customerView = new CustomerView();
$customerController = new CustomerController($customerPDORepository, $customerView);
$dailyReportPDORepository = new DailyReportRepository($pdo);
$dailyReportView = new DailyReportView();
$dailyReportController = new DailyReportController($dailyReportPDORepository, $dailyReportView);
$homeController = new HomeController();
$router = new AltoRouter();
$router->setBasePath('/api/public');

$router->map('GET', '/', function() use (&$homeController){
    $homeController->openHomePage();
});

$router->map('GET', '/customers', function() use (&$customerController){
    $customerController->handleFindAllCustomers();
});

$router->map('POST', '/customers', function () use (&$customerController){
    $jsonPostData = file_get_contents('php://input');
    $customerController->handleAddCustomer($jsonPostData);
});

$router->map('GET', '/customers/[i:id]', function ($id) use (&$customerController) {
    $customerController->handleFindCustomerById($id);
});

$router->map('PUT', '/customers/[i:id]', function ($id) use (&$customerController) {
    $jsonPutData = file_get_contents('php://input');
    $customerController->handleChangeCustomer($id, $jsonPutData);
});


$router->map('GET', '/habits/[i:id]', function ($customerId) use ($customerController){
    $customerController->handleFindHabitsFromCustomerByCustId($customerId);
});

$router->map('GET', '/reports/[i:id]', function ($customerId) use ($dailyReportController){
    $dailyReportController->handleFindDailyReportByCustomerId($customerId);
});

$router->map('POST', '/reports/[i:id]', function ($customerId) use ($dailyReportController){
    $jsonPostData = file_get_contents('php://input');
    $dailyReportController->handleAddDailyReportByCustomerId($customerId, $jsonPostData);
});

$router->map('PUT', '/reports/[i:id]', function ($dailyReportID) use ($dailyReportController){
    $jsonPutData = file_get_contents('php://input');
    $dailyReportController->handleChangeDailyReport($dailyReportID, $jsonPutData);
});

$router->map('GET', '/daily-reports/[i:id]', function ($dailyReportID) use ($dailyReportController){
    $dailyReportController->handleFindDailyReportById($dailyReportID);
});

$match = $router->match();


if ($match) {

  call_user_func_array($match['target'], $match['params']);
}
else
{
   $homeController->open404Page();
}

<?php

require_once 'core/Constants.php';
require_once 'core/Database.php';
require_once 'core/Controller.php';
require_once 'core/View.php';

require_once 'controllers/CustomerController.php';
require_once 'controllers/DailyReportController.php';
require_once 'controllers/HomeController.php';

require_once 'models/CustomerRepository.php';
require_once 'models/ICustomerRepository.php';
require_once 'models/DailyReportRepository.php';
require_once 'models/IDailyReportRepository.php';

require_once 'views/CustomerView.php';
require_once 'views/DailyReportView.php';


require_once  __DIR__.'/../vendor/altorouter/altorouter/AltoRouter.php';
require_once __DIR__.'/../vendor/autoload.php';
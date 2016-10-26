<?php

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Constants.php';
require_once 'core/Database.php';
require_once 'vendor/autoload.php';
require_once 'vendor/phpunit/phpunit/src/Framework/TestCase.php';
require_once 'controllers/CustomerController.php';
require_once 'controllers/HomeController.php';
require_once 'models/CustomerRepository.php';
require_once 'views/CustomerView.php';
require_once 'controllers/DailyReportController.php';
require_once 'models/DailyReportRepository.php';
require_once 'views/DailyReportView.php';
require_once 'core/Database.php';
require_once  'vendor/altorouter/altorouter/AltoRouter.php';
require_once 'vendor/monolog/monolog/src/Monolog/Logger.php';
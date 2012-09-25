<?php
$yiit = '/../../../framework/yiit.php';
$config = dirname(__FILE__) . '/../config/test.php';

require_once($yiit);
//require_once 'PHPUnit/Autoload.php';
require_once '/../../../framework/test/CTestCase.php';
Yii::setPathOfAlias("api", dirname(__FILE__).'/../modules/api');
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);

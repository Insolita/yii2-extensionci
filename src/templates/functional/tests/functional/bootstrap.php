<?php
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', realpath(dirname(__DIR__ ).'/../' ));
$config = require(dirname(__DIR__ ). '/config/functional.php');
(new \yii\web\Application($config))->run();
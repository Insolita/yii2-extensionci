<?php
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', realpath(__DIR__ . '/../../templates/'));
$config = require(__DIR__ . '/../config/functional.php');
(new \yii\web\Application($config))->run();
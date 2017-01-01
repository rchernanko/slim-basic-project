<?php

require '../vendor/autoload.php';

$app = new \Slim\App;

require_once('../app/api/hello_name.php');

$app->run();
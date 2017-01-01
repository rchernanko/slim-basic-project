<?php

require '../vendor/autoload.php';

$app = new \Slim\App;

require_once('../app/api/users.php');

$app->run();
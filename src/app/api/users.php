<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

require_once('dbconnect.php');

$app->get('/api/users', function (Request $request, Response $response) {

    global $mysqli;

    $query = "select * from users order by id";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
    }
});

$app->get('/api/users/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute('id');

    global $mysqli;

    $query = "select * from users where id=$id";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
    }
});

$app->post('/api/users', function (Request $request, Response $response) {

    //done this via postman

    global $mysqli;

    $query = "INSERT INTO `users` (`firstName`, `lastName`, `footballTeam`) VALUES (?,?,?)";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("sss", $firstName, $lastName, $footballTeam);

    $firstName = $request->getParsedBody()['firstName'];
    $lastName = $request->getParsedBody()['lastName'];
    $footballTeam = $request->getParsedBody()['footballTeam'];

    $stmt->execute();
});

$app->put('/api/users/{id}', function (Request $request) {

    //done this via postman

    global $mysqli;

    $id = $request->getAttribute('id');

    $query = "UPDATE `users` SET `firstName` = ?, `lastName` = ?, `footballTeam` = ? WHERE `users`.`id` = $id";


    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("sss", $firstName, $lastName, $footballTeam);

    $firstName = $request->getParsedBody()['firstName'];
    $lastName = $request->getParsedBody()['lastName'];
    $footballTeam = $request->getParsedBody()['footballTeam'];

    $stmt->execute();
});

$app->delete('/api/users/{id}', function (Request $request, Response $response) {

    //done this via postman

    global $mysqli;

    $id = $request->getAttribute('id');
    $query = "delete from users where id = $id";
    $mysqli->query($query);

    $response->write("User with id $id has been deleted");
});
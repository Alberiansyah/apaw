<?php

require __DIR__ . '/../connections/connections.php';

function getSegment()
{
    $urlSegment = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $lastSegment = array_pop($urlSegment);

    return $lastSegment;
}

function tampilData($request)
{
    global $pdo;
    $query = $pdo->prepare($request);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_OBJ);

    return $row;
}

<?php
$host = "localhost";
$dbname = "dpr";
$user   = "root";
$pass   = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$hostToRoot = 'http://localhost/DPRD/';
$hostToResources = 'http://localhost/DPRD/wp-resources/';
$title = 'DPRD | Projects';
$version = 'Beta Build 1.0 (Bug are expected)';

session_start();

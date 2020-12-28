<?php


// Connect database
$serverName = 'localhost';
$userName   = 'root';
$password   = '';
$dbName     = 'assignment';

$conn         = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
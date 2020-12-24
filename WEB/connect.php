<?php

// Connect database
$serverName = 'localhost';
$userName   = 'root';
$password   = '';
$dbName     = 'assignment';
$conn         = new PDO("mysql:host=$serverName;dbname=$dbName;port=3307", $userName, $password);
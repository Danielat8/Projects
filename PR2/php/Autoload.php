<?php
require_once __DIR__ . "/Database/Conection.php";
$createConn = new Connection("mysql", "localhost", "library", "4306", "root", "");
$createConn->Connection();
$conObj = $createConn->getConnection();
session_start();

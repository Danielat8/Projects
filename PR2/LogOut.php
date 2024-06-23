<?php
require_once __DIR__ . "/php/Autoload.php";
session_destroy();

header("Location: index.php");
exit;

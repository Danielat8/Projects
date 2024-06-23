<?php

require_once __DIR__ . "/../Autoload.php";

function LoginAdmin($requireAdmin)
{
    if (!isset($_SESSION["role"])) {
        header("Location: /PR2/AboutBook.php");

        exit();
    }
    if ($requireAdmin && $_SESSION["role"] != 'admin') {
        header("Location: /PR2/AboutBook.php");
        exit();
    }
}

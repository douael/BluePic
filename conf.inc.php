<?php
date_default_timezone_set('Europe/Paris');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", "25");

define("DS", DIRECTORY_SEPARATOR);
define("PATH_RELATIVE", "/MVC/");
define("PATH_RELATIVE_PATTERN", "\/MVC\/");

switch ($_SERVER['SERVER_NAME']) {
    default:
        define('HOSTNAME', 'localhost');
        define('DB_HOST', 'mysql556.sql002');
        define('DB_NAME', 'elomaridibbla');
        define('DB_USER', 'elomaridibbla');
        define('DB_PWD', 'Iramole199');
        define('DB_PORT', '3306');
        define('DB_PREFIXE', '');
        define('DIR', $_SERVER['DOCUMENT_ROOT']);
}

<?php
require './vendor/autoload.php';
session_start();
header('Content-Type: text/html; charset=UTF8');
error_reporting(E_ALL);
ob_start();


$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;


$err = array();
echo 'Проверка сессии';
dump(isset($_SESSION['user']));


include './config.php'; //константы приложения
include './bd/bd.php'; //подключение к бд
include './func/funct.php';
include './scripts/auth/auth.php';
include './scripts/auth/auth_form.html';
include './scripts/auth/show.php';


$content = ob_get_contents();
ob_end_clean();

//Подключаем наш шаблон
include './html/index.html';
?>			
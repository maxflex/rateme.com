<?php
/* Файл конфигурации */
	const DB_LOGIN 		= "root";
	const DB_PASSWORD 	= "";
	const DB_HOST 		= "localhost";
	define("BASE_ROOT", $_SERVER["DOCUMENT_ROOT"]);
	
	// Открываем соединение с БД
	$db_settings = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, "settings");
	
	// Установлено ли соединение
	if (mysqli_connect_errno($db_settings))
	{
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
	
	// Устанавливаем кодировку
	$db_settings->set_charset("utf8");
	
	// Подключаем основные функции
	include_once("functions.php");
	
	// Подключаем модели
	include_once("models/user.php");
?>
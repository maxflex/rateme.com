<?php
	/* Файл конфигурации */

	
	// Константы
	$_constants = array(
		"DB_LOGIN"		=> "root",
		"DB_PASSWORD"	=> "root",
		"DB_HOST"		=> "localhost",
		"BASE_ROOT"		=> $_SERVER["DOCUMENT_ROOT"]."/rateme.com/www/",
	);

	// Контроллеры и модели 
	$_controllers_and_models = array(
		"User",
	);
	
	
	/********************************************************************/
	
	
	// Объявляем константы
	foreach ($_constants as $key => $val)
	{
		define($key, $val);
	}
		
	// Конфигурация ошибок (error_reporing(0) - отключить вывод ошибок)
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	// Открываем соединение с основной БД
	$db_settings = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, "settings");
	
	// Установлено ли соединение
	if (mysqli_connect_errno($db_settings))
	{
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
	
	// Устанавливаем кодировку
	$db_settings->set_charset("utf8");
	
	include_once("functions.php");				// Подключаем основные функции
	require_once("controllers/Controller.php");	// Основной контроллер
	require_once("models/Model.php");			// Основная модель
	
	// Подключаем контроллеры и модели
	foreach($_controllers_and_models as $val)
	{
		require_once("controllers/{$val}Controller.php");	// Подключаем контроллер
		require_once("models/{$val}.php");					// Подключаем модель к контроллеру
	}
?>
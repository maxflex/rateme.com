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
	$_controllers	= array(
		"", "User", "Index", "Profile", "Test",
	);
	
	$_models		= array(
	 	"Model", "User", "Adjective", "Vote", "DefaultAdjective", "Subscription", "Subscriber"
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
	
	// Подключаем модели
	foreach($_models as $val)
	{
		require_once("models/{$val}.php");					// Подключаем модель
	}
	
	// Подключаем контроллеры
	foreach($_controllers as $val)
	{
		require_once("controllers/{$val}Controller.php");	// Подключаем контроллер
	}
?>
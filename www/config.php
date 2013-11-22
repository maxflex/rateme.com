<?php
	/* Файл конфигурации */
	
	
	
	// Подключаем основные функции
	include_once("functions.php");
	
	// Открываем соединение с БД
	$db = new mysqli("localhost","root","","user_maxflex");

	// Установлено ли соединение
	if (mysqli_connect_errno($db))
	{
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
	
	// Устанавливаем кодировку
	$db->set_charset("utf8");



?>
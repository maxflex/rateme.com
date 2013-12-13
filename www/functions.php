<?php
	// Глобальные функции сайта
	
	/*
	 * Пре-тайп
	 */
	function preType($anything, $exit = false)
	{
		echo "<pre>";
		print_r($anything);
		echo "</pre>";
		
		if ($exit)
		{
			exit();
		}
	}
	
	/*
	 * Возвращает соединение DB_SETTINGS
	 */
	function dbSettings()
	{
		global $db_settings;
		return $db_settings;
	}
	
	/*
	 * Создает и возвращает соединение пользователя
	 */
	function dbUser()
	{
		global $db_user;
		
		return $db_user;
	}
	
	/*
	 * Создаем подключение к БД user_x
	 */
	function initUserConnection($id_user)
	{
		global $db_user; 

		// Открываем соединение с основной БД		
		$db_user = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, "user_{$id_user}");
		
		// Установлено ли соединение
		if (mysqli_connect_errno($db_user))
		{
			die("Failed to connect to USER {$id_user} MySQL: " . mysqli_connect_error());
		}
		
		// Устанавливаем кодировку
		$db_user->set_charset("utf8");		
	}
	
	/*
	 * Добавляет JavaScript
	 */
	function addJs($js)
	{
		echo "<script src='js/{$js}.js'></script>";
	}
	
	/*
	 * Добавляет CSS
	 */
	function addCss($css)
	{
		echo "<link href='css/{$css}.css' rel='stylesheet'>";
	}
	
	/*
	 * Обрезает пробелы и извлекает теги
	 */
	function secureString($string)
	{
		return trim(strip_tags($string));
	}
?>
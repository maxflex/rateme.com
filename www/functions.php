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

?>
<?php
	class Adjective extends Model
	{
		public static $mysql_table	= "adjectives";
		
		/*
		 * Функция определяет соединение БД
		 */
		public static function dbConnection()
		{
			return dbUser();	// БД user_x
		}
	}
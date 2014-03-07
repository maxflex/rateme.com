<?php
	class Vote extends Model
	{
	
		public static $mysql_table	= "votes"; 
		
		/*
		 * Функция определяет соединение БД
		 */
		public static function dbConnection()
		{
			return dbUser();	// БД user_x
		}
		
		/*
		 * Получаем прилагательное
		 */
		public function Adjective()
		{
			return Adjective::findById($this->id_adjective);
		}
		
		/*
		 * Первый голос для данного прилагательного
		 * @return true если это первый голос для текущего прилагательного
		 */
		public function isFirst()
		{
			return ($this->Adjective()->id_first_vote == $this->id);
		}
	}
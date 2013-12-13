<?php
	class User extends Model
	{
		public static $mysql_table	= "users";
		
		// Переменная с прилагательными
		public $Adjectives = NULL;
		
		public function __construct($array)
		{
			parent::__construct($array);
			
			// Инициализируем подключение к БД пользователя
			if (!$this->isNewRecord) {
				initUserConnection($this->id);
			}
			
			// Находим все прилагательные пользователя
			$this->Adjectives = Adjective::findAll();
		}
		
		/*
		 * Добавить прилагательное
		 * $adjective	– прилагательное
		 */
		public function addAdjective($adjective)
		{
			// Обрезаем пробелы и теги в прилагательном
			$adjective = strtolower(secureString($adjective));
			
			// Смотрим было есть ли уже такое прилагательное
			$OldAdjective = Adjective::find(array(
				"condition" => "adjective = '$adjective'",
			));
			
			// Если такое прилагательное уже есть, добавляем +1 лайк к нему
			if ($OldAdjective) {
				
				$OldAdjective->likes++;
				$OldAdjective->save();
				
				// Добавляем новое прилагательное в Adjectives объекта
				$this->Adjectives[] = $OldAdjective;
				
				return $OldAdjective;
				
			} else { // Иначе добавляем новое прилагательное
			
				// Создаем новое прилагательное пользователю
				$NewAdjective = new Adjective(array(
					"adjective"	=> $adjective,	
				));
							
				// Сохраняем прилагательное
				$NewAdjective->save();
				
				// Добавляем новое прилагательное в Adjectives объекта
				$this->Adjectives[] = $NewAdjective;
				
				// Возвращаем только что добавленное прилагательное
				return $NewAdjective;	
				
			}
		}
	}
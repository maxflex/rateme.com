<?php
	class Adjective extends Model
	{


		/*====================================== ПЕРЕМЕННЫЕ И КОНСТАНТЫ ====================================*/


		// Максимальная длинна прилагательного
		const MAX_LENGTH = 20;
		
		const TYPE_POSITIVE = 1;	// Положительные голоса
		const TYPE_NEGATIVE = 0;	// Отрицательные голоса
		
		public static $mysql_table	= "adjectives";
		
		
		/*====================================== СИСТЕМНЫЕ ФУНКЦИИ =========================================*/


		public function __construct($array)
		{
			parent::__construct($array);
			
			// Создаем переменные для ANGULAR
			$this->_constructAngular();
		}

		/*====================================== СТАТИЧЕСКИЕ ФУНКЦИИ =======================================*/
				
		/*
		 * Функция определяет соединение БД
		 */
		public static function dbConnection()
		{
			return dbUser();	// БД user_x
		}
		
		
		/*====================================== ФУНКЦИИ КЛАССА ============================================*/

		
		/*
		 * Возвратить прилагательное с форматированием
		 */
		public function formatAdjective()
		{
			$encoding = "UTF-8";
			
			$str = mb_ereg_replace('^[\ ]+', '', $this->adjective);
			
	        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
	               mb_substr($str, 1, mb_strlen($str), $encoding);
	               
	        return $str;
		}
		
		/*
		 * Процент положительных голосов
		 */
		public function positivePercent()
		{
			// Кол-во всех голосов
			$total = $this->countVotes();
			
			// Если голосов нет
			if (!$total) {
				return 0;
			}
			
			// Кол-во положительных голосов
			$positive = $this->countVotes(self::TYPE_POSITIVE);
			
			// Подсчитываем кол-во положительных
			return round($positive * 100 / $total);
		}
		
		/*
		 * Кол-во голосов
		 * $type - тип голосов для подсчета (положительные/отрицательные), если не указан, подсчитывает все
		 */
		public function countVotes($type = -1)
		{
			return Vote::findAll(array(
				"condition"	=> (($type != -1) ? "type=$type and " : "")."id_adjective={$this->id}",
			), true);
		}
		
		/*
		 * Добавить голос к прилагательному
		 * $ajax			– echo-ответы аяксу
		 * $type			– тип голоса (0/1 негатив/позитив)
		 * @return 			– код только что добавленного голоса либо FALSE в случае ошибки
		 */
		public function addVote($ajax = false, $type = 1)
		{
			//print_r(User::fromSession());
			// Проверяем, может уже голосовалось за это прилагательное
			$Vote = Vote::find(array(
				"condition"	=> "id_adjective={$this->id} AND ip='".realIp()."'",
			));
			
			
			// Если все-таки уже голосовалось
			if ($Vote) {
				
				// Проверяем, не был ли он изменен с позитивного на негативный или наоборот
				if ($Vote->type != $type) {
					$Vote->type = $type;
					$Vote->save();
				} else { // Если еще раз голосуют за то, где уже проголосовали, то голос убирается
					$Vote->delete();
				}
				
				/* // Посылаем ответ аяксу 
				if ($ajax) {
					echo "Ваш голос уже был учтен ;)";
				} */
				
				return false;
				
			// ИНАЧЕ ГОЛОСУЕМ
			} else { 
				// Получаем текущего залогиненного пользователя
				$CurrentUser = User::fromSession(false);
				
				$Vote = new Vote(array(
					"id_adjective"	=> $this->id,
					"type"			=> $type,
					"ip"			=> realIp(),
					"id_user"		=> (($CurrentUser->id && !$CurrentUser->anonymous) ? $CurrentUser->id : 0), // Если залогенен пользователь и у него выключено анонимное голосование, проставляем ID проголосовавшего в голос
				));
				
				$Vote->save();		// Сохраняем голос
				return $Vote->id;	// Возвращаем ID голоса		
			}
		}
		
		/*
		 * Проверяет за что отдавал голос пользователь к этому прилагательному
		 * возвращает -1, если еще ни за что не голосовал, 0 - голосовал «против», 1 - голосовал «за»
		 */
		public function checkVote()
		{
			// Проверяем, может уже голосовалось за это прилагательное
			$Vote = Vote::find(array(
				"condition"	=> "id_adjective={$this->id} AND ip='".realIp()."'",
			));
			
			// Если ни за что не голосовал 
			if (!$Vote) {
				return -1;
			} else {
				return $Vote->type;
			}
		}
		
		public function adjRate()
		{
			$pos = (float) $this->countVotes(self::TYPE_POSITIVE);
			$neg = (float) $this->countVotes(self::TYPE_NEGATIVE);
			$sum = $pos + $neg;
			$pos = $pos / $sum + 1;
			$neg = $neg / $sum + 1;
			
			$rate = max($pos, $neg);
			$rate *= $sum;
			return $rate;
		}
		
		/*
		 * Устанавливает переменные для Angular
		 */
		private function _constructAngular()
		{
			$this->_ang_adjective	= $this->formatAdjective();									// Отформатированное прилагательное (для вывода в ANGULAR)
			$this->_ang_pos			= $this->checkVote() == self::TYPE_POSITIVE ? "voted" : "";	// Голос «ЗА»
			$this->_ang_neg			= $this->checkVote() == self::TYPE_NEGATIVE ? "voted" : "";	// Голос «ПРОТИВ»
			$this->_ang_pos_count	= $this->countVotes(self::TYPE_POSITIVE);					// Кол-во голосов «ЗА»
			$this->_ang_neg_count	= $this->countVotes(self::TYPE_NEGATIVE);					// Кол-во голосов «ПРОТИВ»
			$this->_ang_pos_percent	= $this->positivePercent();									// Процент положительных голосов
			$this->_ang_order		= $this->adjRate();											// Дополнительная сортировка
		}
	}
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
	 * Показываем к какой таблице пользователя подключены (бд user_x)
	 */
	function showDbUser()
	{
		global $db_user;
		echo $db_user->query("SELECT DATABASE()")->fetch_array()[0];
	}
	
	/*
	 * Добавляет JavaScript
	 * Добавление скриптов через запятую ( addJs('script_1, script_2') )
	 */
	function addJs($js)
	{
		$js = explode(", ", $js);
		
		foreach ($js as $script_name) {
			echo "<script src='js/{$script_name}.js'></script>";
		}
	}
	
	/*
	 * Добавляет CSS
	 */
	function addCss($css)
	{
		$css = explode(", ", $css);
		
		foreach ($css as $css_name) {
			echo "<link href='css/{$css_name}.css' rel='stylesheet'>";
		}
	}
	
	/*
	 * Обрезает пробелы и извлекает теги
	 */
	function secureString($string)
	{
		return trim(strip_tags($string));
	}
	
	/*
	 * Настоящий IP пользователя
	 */
	function realIp()
	{
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];
	
	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }
	
	    return $ip;
	}
	
	/*
	 * Включить PARTIAL
	 * $string	– название включаемого файла
	 * $vars	– переменные, которые будут доступны в файле
	 */
	function partial($string, $vars = array())
	{
		// Если передаем переменные в инклуд, то объявляем их здесь (иначе будут недоступны)
		if (!empty($vars)) {
			// Объявляем переменные, соответсвующие элементам массива
			foreach ($vars as $key => $value) {
				$$key = $value;
			}
		}
			
		$called_dir = dirname(debug_backtrace()[0]["file"]);	// Получаем путь к директории, откуда была вызвана функция
		
		include_once($called_dir."/_".$string.".php");
	}
	
	/*
	 * В формат ангуляра
	 */
	function angInit($name, $Object)
	{
		return $name." = ".htmlspecialchars(json_encode($Object, JSON_NUMERIC_CHECK));
	}
	
	/*
	 * Преобразование true/false в 1/0 для сохранения в БД
	 */
	function trueFalseConvert(&$array)
	{
		foreach ($array as $key => $val)
		{
			if ($val === "true") {
				$array[$key] = true;
			} elseif ($val === "false") {
				$array[$key] = false;
			}
		}
	}
	
	/*
	 * Возвратить значение, если оно установлено
	 * $value 	- проверяемое значение
	 * $pre		- если значение установлено, добавить при выводе
	 */ 
	function ifSet($value, $pre = "")
	{
		return (isset($value) ? $pre.$value : "");
	}
	
	/*
	 * Создать URL
	 * $params = array (controller, action, text, 
	 * params - массив, дополнительные параметры, будут переданы в GET 
	 * htmlOptions - массив, аттрибуты HTML элемента)
	 */
	function createUrl($params)
	{
		// Если есть опции HTML (атрибуты)
		if (isset($params["htmlOptions"])) {
			foreach ($params["htmlOptions"] as $option => $value) {
				$htmlOptions .= $option."='$value' ";
			}
		}
		
		echo "<a $htmlOptions href='index.php?controller=".$params['controller']
			 	.ifSet($params["action"], "&action=")
			 	.(isset($params["params"]) ? "&".http_build_query($params["params"]) : "")."'>"
			 	.$params["text"]."</a>";
	}
	
	/*
	 * Проверяет активен ли пункт меню
	 * $controller	– контроллер, при котором пункт меню активен
	 * $action		– экшн, при котором пункт меню становится активен
	 * $params (array) - дополнительные параметры для сравнения
	 */
	function menuActive($controller, $action = null, $params = array())
	{
		// Проверяем контроллер
		if ($_GET["controller"] != $controller) {
			return;
		}
		
		// Проверяем экшн
		if (isset($action) && $_GET["action"] != $action) {
			return;
		}
		
		// Проверяем дополнительные параметры
		foreach ($params as $param_name => $param_val) {
			if ($param_val != $_GET[$param_name]) {
				return;
			}
		}
		
		// Если все проверки пройдены, возвращаем активный класс
		return "class='active'";
		
		/*
		if ($_GET["controller"] == $menu) {
			if (!empty($action)) {
				if ($_GET["action"] == $action) {
					
				}
			}
		}*/
		/*
		return ($_GET["controller"] == $controller && $_GET["action"] == $action) ? "class='active'" : "";*/
	}
	
	/* 
	 * Показать новости
	 * $id_last_seen	– если FALSE, то отображать свои же новости (иначе указать LAST_SEEN_ID - с какого ID считаются новыми новости)
	 * $tophr 			– разделительный <hr> будет вверху, вместо отделения между новыми/старыми голосами
	 */
	function displayNews($User, $id_last_seen = false, $tophr = false)
	{
		if ($tophr) {
			echo '<hr class="news-seperator">';
		}
		
		// Проверяем, есть ли вообще новости (После регистрации ничего нет. Проверяем старые голоса - если их нет, то никаких новостей не было вообще)
		$OldVotes = $User->oldVotes($id_last_seen);
		
		// Если совсем никаких новостей не было
		if (!$OldVotes) {
			echo "<h3 class='trans center-content text-white badge-success animate-show mg-top'>"
				 ."<span class='glyphicon glyphicon-file'></span>Новостная лента пуста</h3>";
			return;
		}
		
		/* НОВЫЕ ГОЛОСА */		
		foreach ($User->newVotes($id_last_seen) as $Vote) {
			echo '<div class="news-row">';
			
			if ($Vote->id_user) {
				// Находим проголосовавшего пользователя
				$VotedUser = User::findById($Vote->id_user);
				
				// Выводим аву
				createUrl(array(
					"controller"=> "user",
					"params"	=> array(
						"user"	=> $VotedUser->login,
					),
					"text"		=> '<img style="background-image: url('.$VotedUser->avatar.')" class="news-ava '.($VotedUser->stretch ? "stretch" : "").'">',
				));
				
				createUrl(array(
					"controller"	=> "user",
					"params"		=> array(
						"user"	=> $VotedUser->login,
					),
					"text"			=> $VotedUser->login,
					"htmlOptions"	=> array(
						"class"	=> "login-link",
					),
				));
				
				$User->initConnection();	// Переподключаемся к пользователю
				//echo "<a href='index.php?controller=user&user=gamezo$VotedUser->login;
			} else {
				echo '<img src="img/profile/noava.png" class="news-rounded">';
				echo "Аноним";
			}
			
			// Если это первый голос
			if ($Vote->isFirst()) {
				echo " оставил новую оценку – ";
				$icon_class = "plus plus";	// Класс иконки
			} else {
				echo " проголосовал ".($Vote->type ? "за" : "против");
				$icon_class = "thumbs-".($Vote->type ? "up" : "down")." ".($Vote->type ? "for" : "against"); // Класс иконки
			}
			
			echo '<span class="voted-adj"> '.$Vote->Adjective()->adjective.'</span>';
			echo '<span class="thumb-circle glyphicon glyphicon-'.$icon_class.' pull-right"></span>';
			echo '</div>';
		}
		/* КОНЕЦ НОВЫЕ ГОЛОСА */
		if (!$tophr) {
			echo '<hr class="news-seperator">';
		}			
		
					
		/* СТАРЫЕ ГОЛОСА */
		// $OldVotes уже получали вверху функции
		foreach ($OldVotes as $Vote) {
			echo '<div class="news-row old">';
			
			if ($Vote->id_user) {
				// Находим проголосовавшего пользователя
				$VotedUser = User::findById($Vote->id_user);
				
				// Выводим аву
				createUrl(array(
					"controller"=> "user",
					"params"	=> array(
						"user"	=> $VotedUser->login,
					),
					"text"		=> '<img style="background-image: url('.$VotedUser->avatar.')" class="news-ava '.($VotedUser->stretch ? "stretch" : "").'">',
				));
				
				createUrl(array(
					"controller"	=> "user",
					"params"		=> array(
						"user"	=> $VotedUser->login,
					),
					"text"			=> $VotedUser->login,
					"htmlOptions"	=> array(
						"class"	=> "login-link",
					),
				));
				
				$User->initConnection();	// Переподключаемся к пользователю
				//echo "<a href='index.php?controller=user&user=gamezo$VotedUser->login;
			} else {
				echo '<img src="img/profile/noava.png" class="news-rounded">';
				echo "Аноним";
			}
			
			// Если это первый голос
			if ($Vote->isFirst()) {
				echo " оставил новую оценку – ";
				$icon_class = "plus oplus";	// Класс иконки
			} else {
				echo " проголосовал ".($Vote->type ? "за" : "против");
				$icon_class = "thumbs-".($Vote->type ? "up" : "down")." ".($Vote->type ? "ofor" : "oagainst"); // Класс иконки
			}
			
			echo '<span class="voted-adj"> '.$Vote->Adjective()->adjective.'</span>';
			echo '<span class="thumb-circle old glyphicon glyphicon-'.$icon_class.' pull-right"></span>';
			echo '</div>';
		}
		/* КОНЕЦ СТАРЫЕ ГОЛОСА */
	}
?>
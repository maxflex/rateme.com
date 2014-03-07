<?php
	class Controller
	{
		// Экшн по умолчанию
		public $defaultAction = "Main";
		
		// Папка VIEWS
		protected $_viewsFolder	= "";
		
		
		/*
		 * Отобразить view
		 */
		protected function render($view, $vars = array())
		{
			// Если передаем переменные в рендер, то объявляем их здесь (иначе будут недоступны)
			if (!empty($vars)) {
				// Объявляем переменные, соответсвующие элементам массива
				foreach ($vars as $key => $value) {
					$$key = $value;
				}
			}
			
			include_once(BASE_ROOT."/views/".(!empty($this->_viewsFolder) ? $this->_viewsFolder."/" : "")."{$view}.php");
		}
		
		
		/*
		 * Редирект
		 */
		protected function redirect($parameters)
		{
			header("Location: index.php?".http_build_query($parameters));
		}
	}
?>
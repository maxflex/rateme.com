<?php
	class Controller
	{
		// Экшн по умолчанию
		public $defaultAction = "Main";
		
		
		/*
		 * Отобразить view
		 */
		protected function render($view, $vars = array())
		{
			if (!empty($vars)) {
				// Объявляем переменные, соответсвующие элементам массива
				foreach ($vars as $key => $value) {
					$$key = $value;
				}
			}
			include_once(BASE_ROOT."/views/{$view}.php");
		}
	}
?>
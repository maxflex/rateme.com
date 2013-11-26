<?php
	class Controller
	{
		// Экшн по умолчанию
		public $defaultAction = "Main";
		
		
		/*
		 * Отобразить view
		 */
		protected function render($view)
		{
			include_once(BASE_ROOT."/views/{$view}.php");
		}
	}
?>
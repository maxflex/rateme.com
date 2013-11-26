<?php
	// Подключаем файл конфигураций
	include_once("config.php");
	
	// Лэйаут
	include_once("layouts/header.php");
	include_once("layouts/menu.php");
	
	
	
	/* Основные действия */
	
	$_controller	 = $_GET["controller"];	// Получаем название контроллера
	$_action		 = $_GET["action"];		// Получаем название экшена
	
	$_controllerName = ucfirst(strtolower($_controller))."Controller";	// Преобразуем название контроллера в NameController
	$_actionName	 = "action".ucfirst(strtolower($_action));			// Преобразуем название экшена в actionName
	
	
	$IndexController = new $_controllerName;	// Создаем объект контроллера
	
	// Если указанный _actionName существует – запускаем его
	if (method_exists($IndexController, $_actionName))
	{
		$IndexController->$_actionName();			// Запускаем нужное действие
	} // иначе запускаем метод по умолчанию
	else
	{
		$IndexController->{"action".$IndexController->defaultAction}();
	}
	
	/*********************/
	
	
	
	// Лэйаут
	include_once("layouts/footer.php");
?>
<?php	// Контроллер пользователей	class UserController extends Controller	{		public $defaultAction = "Test";				// Тестовая функция		public function actionTest()		{			$TestUsers = User::findById(0);			preType($TestUsers);			$this->render("test", array(				"TestUsers" => $TestUsers,			));		}	}
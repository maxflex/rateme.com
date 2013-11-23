<?php
	class User
	{
		public $id;				// id в бд settings
		public $first_name;		// имя
		public $last_name;		// фамилия
		public $password;		// пароль
		
		public function connect($id)
		{
			global $db_settings;
			$user_info = $db_settings->query("SELECT * FROM users WHERE id={$id}")
				->fetch_assoc();
			foreach($user_info as $key => $value)
			{
				$this->{$key} = $value;
			}
			$this->first_name 	= $user_info["first_name"];
			$this->last_name 	= $user_info["last_name"];
			$this->password 	= $user_info["password"];
			//$db_user = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, "user_1");
		}
	}
?>
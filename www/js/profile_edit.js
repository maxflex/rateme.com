$(document).ready(function(){
	$("#main-page").addClass(_page_additional_start_animation);
});

// Подключаем модуль NG-Animate к приложению UserPage
angular.module('ProfileEdit', ['ngAnimate', 'NgSwitchery']);

	// Контроллер страницы пользователя
	function ProfileEditCtrl($scope) {
		
		// Значения по умолчанию
		angular.element(document).ready(function(){
			// Если нет авы – кнопка «удалить» неактивна
			$scope.delete_disable = ($scope.user.avatar == "img/profile/noava.png" ? true : false);
			
			// Пароль
			$scope.new_password = "PASSWORD NOT CHANGED";
		});
		
		// Удалить аву
		$scope.deleteAva = function() {
			bootbox.confirm(_ALERT_CLEAR_PHOTO + "Удалить текущий аватар?", function(result) {
				if (result == true) {
					$scope.user.avatar = "img/profile/noava.png";
					$scope.delete_disable = true;
					$scope.$apply();	
				}
			});
		}
		
		// Установить аву
		$scope.newAva = function() {
			bootbox.prompt(
			{ "title" 		: _ALERT_POLAROID + "Вставьте URL изображения:", 
			  "callback" 	: function(result) {
								if (result !== null) {
								/*
									$scope.user.avatar = result;
									$scope.delete_disable = false;
									$scope.$apply();
								*/
									var img = new Image();
									img.onload = function() {
										// Если ширина изображения больше длинны
									  if (this.width > this.height) {
										  $scope.user.stretch = 1;
									  } else {
										  $scope.user.stretch = 0;
									  }
									  
									  $scope.user.avatar = result;
									  $scope.delete_disable = false;
									  $scope.$apply();
									}
									
									img.onerror = function() {
										bootbox.alert(_ALERT_CAUTION + "По указанной ссылке изображение не найдено");
									}
									
									img.src = result;
								}                              
							  },
			 buttons: {
			    confirm: {   
			      label: "Установить",
			    }
    
   		    }});							  
							  
		}
		
		
		// Сохранить изменения
		$scope.save = function() {			
			ajaxStart();
			$scope.saving = true;
			
			// Проверяем был ли изменен пароль, если да, то просим повторить ввести
			if ($scope.new_password != "PASSWORD NOT CHANGED") {
				$scope.confirmPassword();
			} else { // Иначе продолжаем сохранение
				$.post("?controller=profile&action=AjaxSave", $scope.user)
				.success(function(response) {
					$scope.afterSave(true);
					console.log(response);
				})
				.error(function(response) {
					$scope.afterSave(false);
					bootbox.alert(_ALERT_CAUTION + " Ну удалось сохранить! <br><i class='text-error'>" + response + "</i>");
				});
			}
		}
		
		$scope.afterSave = function(success) {
			ajaxEnd();
			$scope.saving = false;
			
			// если успешно сохранено
			if (success == true) {
				$scope.saved = true;
				
				setTimeout(function() {
					$scope.saved = false;
					
					$scope.$apply();
				}
				, 2500);
			}
			
			$scope.$apply();
		}
		
		// Проверить логин
		$scope.checkLogin = function() {
			// Проверяем длинну логина
			if ($scope.user.login.length < 3) {
				$scope.login_error = "слишком короткий";
			} else if ($scope.user.login.length > 15) {
				$scope.login_error = "слишком длинный";
			} else if (!$scope.user.login.match(/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/)) {
				$scope.login_error = "в неверном формате";
			} else {
				ajaxStart();
				$.post("?controller=profile&action=AjaxCheckLogin", {"login" : $scope.user.login})
					.success(function(login_taken) {
						ajaxEnd();
						// Если логин уже занят
						if (login_taken) {
							$scope.login_error = "уже занят";
						} else {
							$scope.login_error = ""; // Иначе нет никаких ошибок
						}
						$scope.$apply();
					});
			}
		}
		
		// Проверить email
		$scope.checkEmail = function() {
			$scope.email_error = !$scope.user.email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
		}
		
		// Проверить пароль
		$scope.checkPassword = function() {
			$scope.password_error = $scope.new_password.length < 6;
		}
		
		// Убираем символы при фокусе пароля (Иммитируем Placeholder)
		$scope.focusPassword = function() {
			$scope.new_password = "";
		}
		
		// Иммитируем Placeholder
		$scope.blurPassword = function() {
			if ($scope.new_password == "") {
				$scope.new_password = "PASSWORD NOT CHANGED";
			}
		}
		
		
		// Подтверждение пароля
		$scope.confirmPassword = function() {
			bootbox.prompt(
				{ "title" 		: _ALERT_SECURITY + "Повторите новый пароль:", 
				  "inputType"	: "password",
				  "callback" 	: function(result) { 
				  					// Если нажали «Отмена», отменяем сохранение
				  					if (result === null) {
					  					$scope.afterSave(false);
					  					return;
				  					}
				  					//  Если введенные пароли не совпали               
									if (result != $scope.new_password) {
										// Выводим сообщение и не сохраняем изменения в профиле
										bootbox.alert(_ALERT_CAUTION + "Пароли не совпали");
										$scope.afterSave(false);
									} else {
										// Присваиваем пароль пользователю
										$scope.user.password = $scope.new_password;
										
										$scope.new_password = "PASSWORD NOT CHANGED";
										
										// Сохраняем изменения в профиле
										$scope.save();
									}                            
								  },
				 buttons: {
				    confirm: {   
				      label: "Изменить",
				    }
   		    }});	
		}
	}
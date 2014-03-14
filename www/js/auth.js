	$(document).ready(function(){
		$("#main-page").addClass(_page_start_animation);
		
		// Инициализация приложения ВК
		VK.init({
		  apiId: 4229872
		});
	});
	
	// Подключаем модуль NG-Animate к приложению UserPage
	angular.module('Auth', ['ngAnimate']);
	
	// Контроллер страницы пользователя
	function AuthCtrl($scope) {
		
		// После загрузи документа проверяем статус (залогинен ли?)
		angular.element(document).ready(function(){
			$scope.logged_in = false;
			
			// Проверяем, если залогинен
			VK.Auth.getLoginStatus(function(response) {
				// Проверяем, залогинен ли пользователь
				if (response.session) {
					$scope.getUserData();
				} else {
					$scope.logged_in = false;
					$scope.$apply();
				}
				
			});
		});	
		
		
		// Логин
		$scope.login = function() {
			// Посылаем запрос на логин
			VK.Auth.login(function(response) {
				// Если залогинен
				if (response.session) {
					$scope.getUserData();
				} else {
					$scope.logged_in = false;
					$scope.$apply();
				}
			});			
		}
		
		// Выход
		$scope.logout = function() {
			VK.Auth.logout(function(response) {
				delete $scope.user;
				$scope.logged_in = false;
				$scope.$apply();
			});
		}
		
		// Получаем данные пользователя
		$scope.getUserData = function() {
			// Проверяем, залогинен ли
			VK.Auth.getLoginStatus(function(response) {
				// Если залогинен
				if (response.status == "connected") {
					$scope.logged_in = true;
					VK.Api.call('users.get', {
						uids	: response.session.mid,
						fields	: "first_name,last_name,sex,photo_max,domain,connections"
					}, function(r) { 
						$scope.user = r.response[0];
						
						$.post("?controller=index&action=ajaxLoginOrRegister", $scope.user)
							.success(function(response) {
								// Ответ функции ajaxLoginOrRegister в JSON
								response = $.parseJSON(response);
								
								// Редирект на страницу пользователя
								redirect({
									controller	: "user",
									user 		: response.login,
								});
								// console.log(response);
							});
						console.log($scope.user);
						$scope.$apply();
					}); 
				}
			});
		}
	}
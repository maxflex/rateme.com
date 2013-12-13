$(document).ready(function(){
	$("#adjective").fancyInput();
	
});

	// Контроллер страницы пользователя
	function UserCtrl($scope) {
		
		// По ходу печати пишет прилагательное сверху
		$scope.updateHello = function() {
			$scope.adjective	= angular.lowercase($scope.adjective);
		};
		
		// Добавить мысль о человеке
		$scope.think = function(){
			// Пост-запрос
			$.post("?controller=user&action=AjaxAddThought", {"adjective" : $scope.adjective})
				.success(function(response) {
					alert(response);
				})
				.error(function(){
					alert("Произошла ошибка! Попробуйте снова");
				});
		}
	}
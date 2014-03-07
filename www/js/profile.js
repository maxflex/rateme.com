$(document).ready(function(){
	$("#profile-page").addClass(_page_start_animation);
});

// Подключаем модуль NG-Animate к приложению UserPage
angular.module('ProfilePage', ['ngAnimate']);

	// Контроллер страницы пользователя
	function ProfileCtrl($scope) {
		
		// Просмотреть подписку
		$scope.showNews = function(id_user, id_last_seen) 
		{
			ajaxStart();
			$.post("?controller=profile&action=AjaxSubNews", {"id_user" : id_user, "id_last_seen" : id_last_seen})
				.success(function(response) {
					ajaxEnd();
					$scope.sub_watch = true;
					$scope.$apply();
					$(".sub-news-container").html(response);
				});
		}
	}
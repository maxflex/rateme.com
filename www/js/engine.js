	// Анимация появления страницы
	var _page_start_animation 				= "animated fadeInDown";
	var _page_additional_start_animation 	= "animated fadeInLeft";
	
	// Картинки в начале сообщения
	var _ALERT_CLEAR_PHOTO		=	"<img src='img/icon/64/paintbrush2.png'>";
	var _ALERT_CAUTION			=	"<img src='img/icon/64/caution.png'>";
	var _ALERT_CAMERA			=	"<img src='img/icon/64/camera.png'>";
	var _ALERT_POLAROID			=	"<img src='img/icon/64/polaroids.png'>";
	var _ALERT_SECURITY			=	"<img src='img/icon/64/security.png'>";
	
	
	
	
	// Анимация загрузки AJAX
	function ajaxStart() {
		$(".top-loader").css("display", "block");
	}
	
	
	// Конец анимации загрузки AJAX
	function ajaxEnd() {
		$(".top-loader").css("display", "none");	
	}
	
	// Первая буква большая
	function ucfirst(string)
	{
	    return string.charAt(0).toUpperCase() + (string.slice(1)).toLowerCase();
	}
	
	// Переход на страницу 
	function goTo(controller, action) {
		window.location = "index.php?controller=" + controller + "&action=" + action;
	}
	
	// Переход назад
	function goBack()
	{
		history.back();
	}

	

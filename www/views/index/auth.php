<div class="container" ng-app="Auth" id="main-page" ng-controller="AuthCtrl">
	<div class="row">
		<div class="col-md-12 center-t">
			<h1 class="text-white trans">LOGGED IN = {{logged_in}}</h1>
			<input ng-show="!logged_in" type="button" ng-click="login()" value="Войти" class="btn btn-primary btn-large br5 animate-show">
			<region ng-show="logged_in" class="animate-show">
				<input type="button" ng-click="logout()" value="Выйти" class="btn btn-primary btn-large br5">
				<br><br>
				<input type="button" onclick="postToVk()" value="Запостить" class="btn btn-primary btn-large br5">
				<input type="button" ng-click="getUserData()" value="Получить данные" class="btn btn-primary btn-large br5">
			</region>
		</div>
	</div>
	
	<div class="row" ng-show="user" class="animate-show-hide">
		<div class="col-md-12">
			<hr>
			<h2 class="text-white"><b class="trans">Пользователь:</b> {{user.first_name}} {{user.last_name}}</h2>
			<h2 class="text-white"><b class="trans">Login:</b> {{user.domain}}</h2>
			<h2 class="text-white"><b class="trans">Ava:</b> {{user.photo_max}}</h2>
			<h2 class="text-white"><b class="trans">Sex:</b> {{user.sex}}</h2>
			<h2 class="text-white"><b class="trans">Instagram:</b> {{user.instagram}}</h2>
			<h2 class="text-white"><b class="trans">Twitter:</b> {{user.twitter}}</h2>

			
		</div>
	</div>
</div>
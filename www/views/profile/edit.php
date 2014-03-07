<div class="container" ng-app="ProfileEdit" id="main-page" ng-controller="ProfileEditCtrl" ng-init="<?=angInit("user", $user_data)?>">
	<span class="arrow-back big glyphicon glyphicon-chevron-left pull-left path-icon clickable left" onclick="goBack()"></span>
<!-- 	<img src="img/icon/settings.png" class="path-icon"> -->
	<h1 id="name-lastname">Редактирование профиля</h1>
	<hr>
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<div class="ava-wrap" ng-mouseenter="ehover = true" ng-mouseleave="ehover = false">
				<div class="ava-blink edit-profile animate-fade" ng-hide="!ehover">
					<button class="btn first btn-success btn-large" ng-click="newAva()">Изменить</button>
					<button class="btn second btn-danger btn-large" ng-click="deleteAva()" ng-disabled="delete_disable">Удалить</button>
				</div>
				<img class="avatar center nofloat" ng-class="{'stretch' : user.stretch == 1}" style="background-image: url('{{ user.avatar }}')">
			</div>
			
			<!--
<div class="additional-settings">
				<div class="s-name">
					<span>Замалым</span>
				</div>
				<div class="s-content">
					<input type="checkbox" ui-switch checked>
				</div>
			</div>		
-->	
			<table class="additional-settings">
				<tr>
					<td><img src="img/icon/64/megaphone.png"></td>
					<td width="250px"><span>Голосовать анонимно</span></td>
					<td>
						<input type="checkbox" ui-switch ng-model="user.anonymous">
					</td>
				</tr>
				
				<tr>
					<td><img src="img/icon/64/locked.png"></td>
					<td width="250px"><span>Приватный профиль</span></td>
					<td>
						<input type="checkbox" ui-switch ng-model="user.private">
					</td>
				</tr>
			</table>
			
			<button class="btn btn-primary btn-large br5 save" ng-click="save()" ng-disabled="saving || login_error || email_error || password_error">Сохранить</button>	
			
			<h3 ng-show="saved" class="center-content text-white badge-success saved animate-show-hide"><span class="glyphicon glyphicon-ok"></span> Сохранено</h3>		
		</div>
		
		<div class="col-md-6">
			
			<!-- ЗАГОЛОВКИ -->
			<div class="row">
				<div class="col-md-10">
				
					<!--
<div class="edit-row">
						<h2 class="trans text-white">Имя</h2>
						<input type="text" value="Колядин Максим" class="icon compose" disabled>
					</div>
-->
					
					<div class="edit-row clearfix">	
						<h2 class="trans text-white animate-show" ng-hide="login_error">Логин</h2>
						<h2 class="trans text-error animate-show" ng-show="login_error">Логин {{ login_error }}</h2>
						<input type="text" value="{{ user.login }}" ng-model="user.login" class="icon login" ng-change="checkLogin()">
					</div>
					
					<div class="edit-row">	
						<h2 class="trans text-white animate-show" ng-hide="email_error">Email</h2>
						<h2 class="trans text-error animate-show" ng-show="email_error">Неверный email</h2>
						<input type="text" value="{{ user.email }}" ng-model="user.email" class="icon mail" ng-change="checkEmail()">
					</div>

					<div class="edit-row">	
						<h2 class="trans text-white animate-show" ng-hide="password_error">Пароль</h2>
						<h2 class="trans text-error animate-show" ng-show="password_error">Слишком короткий пароль</h2>
						<input type="password" value="{{ new_password }}" ng-model="new_password" class="icon unlocked" ng-change="checkPassword()" ng-focus="focusPassword()" ng-blur="blurPassword()">
					</div>
					
					<div class="edit-row">	
						<hr>
						<h2 class="trans text-white">ВКонтакте</h2>
						<input type="text" value="{{ user.social.vk }}" ng-model="user.social.vk" class="icon vk">
					</div>
					
					<div class="edit-row">	
						<h2 class="trans text-white">Twitter</h2>
						<input type="text" value="{{ user.social.twitter }}" ng-model="user.social.twitter" class="icon twitter">
					</div>
					
					<div class="edit-row">	
						<h2 class="trans text-white">Instagram</h2>
						<input type="text" value="{{ user.social.instagram }}" ng-model="user.social.instagram" class="icon instagram">
					</div>

				</div>
			</div>
			<!-- КОНЕЦ ЗАГОЛОВКИ -->
		
						
		</div>
		
		
	</div>
</div>


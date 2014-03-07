<div class="container" ng-app="ProfilePage" id="profile-page" ng-controller="ProfileCtrl">
	<span class="arrow-back big glyphicon glyphicon-chevron-left pull-left path-icon clickable left" onclick="goBack()"></span>
	<img src="img/icon/browser.png" class="path-icon">
	<h1 id="name-lastname"><?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<div class="ava-wrap" ng-mouseenter="ehover = true" ng-mouseleave="ehover = false">
				<div class="ava-blink edit-profile animate-fade" ng-hide="!ehover">
					<button class="btn btn-success btn-large" ng-click="editProfile()">Редактировать профиль</button>
				</div>
			<img class="avatar center nofloat <?=($User->stretch ? "stretch" : "")?>" style="background-image: url('<?=$User->avatar?>')">
			</div>
			<div class="row sociallinks">
					<div class="circle cursor-default"><span class="glyphicon glyphicon-user"></span></div>
					<div class="circle" ng-mouseenter="followers = true" ng-mouseleave="followers = false"><span><?= $User->subscribers ?></span></div>
			
					<h3 ng-show="followers" class="foll center-content text-white badge-primary animate-show-hide"><span class="glyphicon glyphicon-user"></span> Подписчики</h3>
			</div>				
		</div>
		
		<div class="col-md-6">
			
			<!-- ЗАГОЛОВКИ -->
			<div class="row">
				<div class="col-md-6">
					<h2 class="trans text-white news" 
						ng-click="subs = false"
						ng-class="{'selected' : !subs}">Ваши подписчики <span class="badge news badge-success"><?= $User->subscribers ?></span></h2>		
				</div>
			</div>
			<!-- КОНЕЦ ЗАГОЛОВКИ -->
			
			<!-- КОНТЕНТ -->
			<div class="row">
				<div class="col-md-12 news-div">
				<?php
					foreach ($User->Subscribers() as $Subscriber) {
						// Получаем пользователя, на которого подписаны
						$SubscriberUser = User::findById($Subscriber->id_user);
						
						echo "<div class='subscription-row'>";
						
						// Выводим аву
						createUrl(array(
							"controller"=> "user",
							"params"	=> array(
								"user"	=> $SubscriberUser->login,
							),
							"text"		=> '<img style="background-image: url('.$SubscriberUser->avatar.')" class="news-ava '.($SubscriberUser->stretch ? "stretch" : "").'">',
						));
						
						createUrl(array(
							"controller"	=> "user",
							"params"		=> array(
								"user"	=> $SubscriberUser->login,
							),
							"text"			=> $SubscriberUser->login,
							"htmlOptions"	=> array(
									"class"	=> "login-link",
							),
						));
						
						echo '<span class="subscription-arrow glyphicon glyphicon-chevron-right pull-right"></span>';
						echo "</div>";
					}
				
					// Переподключаемся к основному пользователю
					$User->initConnection();
				?>
				</div>
			</div>
			<!-- КОНЕЦ КОНТЕНТ -->	
						
		</div>
		
		
	</div>
</div>


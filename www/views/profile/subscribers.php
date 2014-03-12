<div class="container" ng-app="ProfilePage" id="profile-page" ng-controller="ProfileCtrl">
	<h1 id="name-lastname">
		<span class="arrow-back big glyphicon glyphicon-chevron-left pull-left path-icon clickable left" onclick="goBack()"></span>
	<?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<div class="ava-wrap" ng-mouseenter="ehover = true" ng-mouseleave="ehover = false">
				<div class="ava-blink edit-profile animate-fade" ng-hide="!ehover">
					<button class="btn btn-success btn-large" onclick="goTo('profile', 'edit')"><span class="glyphicon glyphicon-pencil"></span>Редактировать профиль</button>
				</div>
			<img class="avatar center nofloat <?=($User->stretch ? "stretch" : "")?>" style="background-image: url('<?=$User->avatar?>')">
			</div>
			<div class="row sociallinks">
					<div class="circle cursor-default"><span class="glyphicon glyphicon-user"></span></div>
					<div class="circle" ng-mouseenter="followers = true" ng-mouseleave="followers = false"><span><?= $User->subscribers ?></span></div>
			
					<h3 ng-show="followers" class="foll center-content text-white badge-primary animate-show-hide"><span class="glyphicon glyphicon-user"></span>Подписчики</h3>
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
				
					// Получаем подписчиков пользователя
					$Subscribers = $User->Subscribers();
					
					// Если подписок нет, выводим сообщение об этом
					if (!$Subscribers) {
						echo "<h3 class='trans center-content text-white badge-success animate-show mg-top'>"
							 ."<span class='glyphicon glyphicon-user'></span>На вас никто не подписан</h3>";
					} else {

						foreach ($Subscribers as $Subscriber) {
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
					}
				?>
				</div>
			</div>
			<!-- КОНЕЦ КОНТЕНТ -->	
						
		</div>
		
		
	</div>
</div>


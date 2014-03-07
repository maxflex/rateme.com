<div class="col-md-12 news-div animate-show-right" ng-show="subs">
	<div class="animate-show" ng-hide="sub_watch">
	<?php
		foreach ($User->Subscriptions() as $Subscription) {
			// Получаем пользователя, на которого подписаны
			$SubscriptionUser = User::findById($Subscription->id_user);
			
			echo "<div class='subscription-row' ng-click='showNews({$Subscription->id_user}, {$Subscription->id_last_seen})'>";
			
			// Выводим аву
			createUrl(array(
				"controller"=> "user",
				"params"	=> array(
					"user"	=> $SubscriptionUser->login,
				),
				"text"		=> '<img style="background-image: url('.$SubscriptionUser->avatar.')" class="news-ava '.($SubscriptionUser->stretch ? "stretch" : "").'">',
			));
			
			createUrl(array(
				"controller"	=> "user",
				"params"		=> array(
					"user"	=> $SubscriptionUser->login,
				),
				"text"			=> $SubscriptionUser->login,
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
	
	<span class="sub-back arrow-back glyphicon glyphicon-chevron-left pull-left animate-show-right" ng-click="sub_watch = false" ng-show="sub_watch"></span>
	<div class="sub-news-container animate-show-right" ng-show="sub_watch">
		
	</div>
</div>
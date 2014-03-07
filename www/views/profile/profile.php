<div class="container" ng-app="ProfilePage" id="profile-page" ng-controller="ProfileCtrl">
	
	<img src="img/icon/browser.png" class="path-icon">
	<h1 id="name-lastname"><?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<div class="ava-wrap" ng-mouseenter="ehover = true" ng-mouseleave="ehover = false">
				<div class="ava-blink edit-profile animate-fade" ng-hide="!ehover">
					<button class="btn btn-success btn-large" onclick="goTo('profile', 'edit')">Редактировать профиль</button>
				</div>
			<img class="avatar center nofloat <?=($User->stretch ? "stretch" : "")?>" style="background-image: url('<?=$User->avatar?>')">
			</div>
			<div class="row sociallinks">
<!--
			<a class="sociallink">
					<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 64 64">
<g>
	<path class="SocialIconFill" d="M32.001,3.56C16.317,3.56,3.56,16.317,3.56,32c0,15.683,12.757,28.44,28.442,28.44   C47.683,60.44,60.44,47.683,60.44,32C60.44,16.317,47.683,3.56,32.001,3.56z M24.227,26.593l0.057-0.063   c0.232-0.168,0.345-0.432,0.303-0.708c-0.573-3.446-0.197-4.883-0.07-5.244c1.001-3.072,4.143-4.493,4.76-4.745   c0.131-0.052,0.374-0.125,0.62-0.163l0.073-0.017l0.505-0.027l0.004,0.031l0.117-0.011c0.104-0.011,0.204-0.025,0.329-0.051   l0.111-0.024c0.099,0.001,1.322,0.156,3.139,0.713l1.263,0.435c2.31,0.682,3.372,1.951,3.569,2.207   c1.85,2.095,1.354,5.259,0.896,6.958c-0.052,0.2-0.021,0.406,0.092,0.577l0.105,0.129c0.134,0.182,0.254,0.884-0.148,2.376   c-0.076,0.453-0.243,0.821-0.492,1.069c-0.092,0.101-0.156,0.229-0.179,0.374c-0.625,3.665-3.909,7.764-7.37,7.764   c-2.937,0-6.289-3.771-6.892-7.761c-0.023-0.149-0.085-0.28-0.188-0.393c-0.251-0.26-0.411-0.635-0.508-1.19   C24.029,27.785,24,26.944,24.227,26.593z M17.634,42.485c0.127-0.161,0.837-0.993,2.273-1.541c1.263-0.388,4.384-1.425,6.09-2.661   c0.08-0.044,0.159-0.127,0.224-0.194c0.158-0.17,0.399-0.429,0.685-0.694l0.159-0.151l0.162,0.152   c1.503,1.417,3.166,2.194,4.683,2.194c1.594,0,3.237-0.69,4.756-1.996l0.119-0.103l0.322,0.157   c0.288,0.264,0.786,0.626,1.018,0.736l0.296,0.145l-0.031,0.032l0.132,0.08c0.28,0.169,0.585,0.333,0.943,0.51   c0.361,0.159,0.663,0.277,0.976,0.379c0.264,0.086,1.668,0.558,3.265,1.296l0.305,0.092c1.562,0.598,2.256,1.429,2.325,1.516   c1.854,2.748,2.565,7.876,2.829,10.733c-4.843,3.933-10.935,6.098-17.162,6.098c-6.23,0-12.323-2.165-17.164-6.099   C15.098,50.316,15.803,45.204,17.634,42.485z"/>
</g>
</svg></a>

-->
					<div class="circle cursor-default"><span class="glyphicon glyphicon-user"></span></div>
					<div class="circle" ng-mouseenter="followers = true" ng-mouseleave="followers = false" onclick="goTo('profile', 'subscribers')"><span><?= $User->subscribers ?></span></div>
<!-- 					<div class="circle" ng-mouseenter="following = true" ng-mouseleave="following = false"><span>23</span></div>	 -->
			
					<h3 ng-show="followers" class="foll center-content text-white badge-primary animate-show-hide"><span class="glyphicon glyphicon-user"></span> Подписчики</h3>
<!-- 					<h3 ng-show="following" class="foll center-content text-white badge-primary animate-show">Подписки</h3>						 -->
			</div>				
		</div>
		
		<div class="col-md-6">
			
			<!-- ЗАГОЛОВКИ -->
			<div class="row">
				<div class="col-md-6">
					<h2 class="trans text-white news" 
						ng-click="subs = false"
						ng-class="{'selected' : !subs}">Новости <span class="badge news badge-success"><?= $User->newsCount() ?></span></h2>		
				</div>
				
				<div class="col-md-4">
					<h2 class="trans text-white news" 
						ng-click="subs = true"
						ng-class="{'selected' : subs}">Подписки <span class="badge news badge-success"><?= $User->subscriptions ?></span></h2>
				</div>
			</div>
			<!-- КОНЕЦ ЗАГОЛОВКИ -->
			
			<!-- КОНТЕНТ -->
			<div class="row">
			
				<!-- Новости -->
					<?php
						partial("profile_news", ["User" => $User]);
					?>
				<!-- Конец Новостей -->
				
				
				<!-- ПОДПИСКИ -->
					<?php
						partial("profile_subscriptions", ["User" => $User]);
					?>
				<!-- КОНЕЦ ПОДПИСКИ -->
			</div>
			<!-- КОНЕЦ КОНТЕНТ -->	
						
		</div>
		
		
	</div>
</div>


<div class="bg-blue" height="100%" width="100%"></div>
<div class="container" ng-app>
	<h1 style="text-align: center; color: white"><?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<img src="<?=$User->avatar?>" class="avatar center nofloat" height="300" width="300">
		</div>
		
		<div class="col-md-6" ng-controller="UserCtrl">
			<div style="clear: both">
			<h2 class="trans">Я думаю, что <?=$User->first_name?> {{adjective}}</h2>
			</div>
			<div class="adjective-div pull-left">
				<input type="text" placeholder="Красивый" id="adjective" ng-model="adjective" ng-keyup="updateHello()" ng-maxlength="15" maxlength="15" autocomplete="off">
			</div>
			<button class="btn btn-success btn-xxl" ng-click="think()">ОК!</button>
		</div>
	</div>
	
	<!--
	<br><br>
	<div class="alert alert-success">
	<b><?php preType($User->Adjective(1))?></b>
	</div> -->
	
</div>
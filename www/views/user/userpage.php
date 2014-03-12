<div class="container" ng-app="UserPage" id="user-page" ng-controller="UserCtrl" ng-init="subscribed = <?= $subscribed ?>">
	<h1 id="name-lastname" style="text-align: center; color: white"><?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<img class="avatar center nofloat <?=($User->stretch ? "stretch" : "")?>" style="background-image: url('<?=$User->avatar?>')">
			<!-- СОЦИАЛЬНЫЕ КНОПКИ -->
			<?php partial("social", array("social" => $User->social, "own_page" => $own_page, "id_user" => $User->id)) ?>
				
		</div>
		
		<div class="col-md-6">
		<?php
			// Если пользователь просматривает чужую страницу – отобразить голосование
			if (!$own_page) {
		?>
			<div class="row">
				<div class="clearfix">
					<h2 class="trans text-white animate-show" ng-hide="pseudoForm.adjective.$error.pattern || pseudoForm.adjective.$error.maxlength || many_words">
						Я думаю, что <?=$User->first_name?> {{adjective}}</h2>
					<h2 class="trans text-error animate-show" ng-show="pseudoForm.adjective.$error.pattern">Вводить можно только буквы</h2>
					<h2 class="trans text-error animate-show" ng-show="pseudoForm.adjective.$error.maxlength">Слишком длинная мысль</h2>
					<h2 class="trans text-error animate-show" ng-show="many_words">Два слова – максимум</h2>

				</div>
				
				<!-- Псевдо-форма для работы валидаторов AngularJS -->
				<form name="pseudoForm" novalidate>
				<div class="adjective-div pull-left">
					<input type="text" placeholder="<?= $default_adjective ?>" name="adjective" id="adjective" ng-model="adjective" ng-keyup="updateHello()" ng-maxlength="15" autocomplete="off" ng-pattern="/^[a-zA-Zа-яА-Я\-\ ]+$/">
				</div>
				
				<button class="btn btn-success btn-xxl" ng-click="think()" ng-disabled="pseudoForm.$invalid || many_words">ОК!</button>				
				</form>
			</div>	
			
		<?php
			} else {
				// Если просматривается своя же страница
				?>
					<h2 class="trans text-white">Ваши черты характера:</h2>
				<?php
			}
		?>
		<!-- СПИСОК ПРИЛАГАТЕЛЬНЫХ -->	
		<?php
				// Если нет прилагательных
				if (!$Adjectives) {
					echo '<h3 class="trans center-content text-white badge-success animate-show mg-top" ng-show="!adjectives">';
					echo ($own_page ? "<span class='glyphicon glyphicon-file'></span>Вас пока никто не оценивал" 
									: "<span class='glyphicon glyphicon-pencil'></span>Ваше мнение будет первым!");
					echo '</h3>';
				}
		?>
		
		<div class="row" style="margin-top: 30px" id="adjective-list-angular" ng-init="adjectives = <?=htmlspecialchars(json_encode($Adjectives, JSON_NUMERIC_CHECK))?>">
				<div ng-repeat="adj in adjectives | orderBy:['_ang_order', 'id']:true"   class="adjective-row animate-repeat">
						
					<span class="adjective-toptext">{{adj._ang_adjective}}</span>
					
					<?php
						/*******  ЕСЛИ ПРОСМАТРИВАЕТ ЧУЖОЙ ПОЛЬЗОВАТЕЛЬ *********/
						if (!$own_page) {
					?>
					<!-- ПАЛЬЦЫ ВВЕРХ/ВНИЗ -->
					<div class="adj-vote-block pull-right trans">
						<div class="voting">
							<span ng-click="vote(adj, 1)" class="glyphicon glyphicon-thumbs-up text-white adj-vote for {{adj._ang_pos}}" id="vote-for-{{adj.id}}"></span>
							<span class="vote-count" id="vote-for-count-{{adj.id}}">{{adj._ang_pos_count}}</span>
						</div>
						
						<div class="voting">
							<span ng-click="vote(adj, 0)" class="glyphicon glyphicon-thumbs-down text-white adj-vote against {{adj._ang_neg}}" id="vote-against-{{adj.id}}"></span>
							<span class="vote-count" id="vote-against-count-{{adj.id}}">{{adj._ang_neg_count}}</span>
						</div>
					</div>
					<!-- КОНЕЦ ПАЛЫМ -->
					<?php
						} else {
					/*******  ЕСЛИ ПРОСМАТРИВАЕТ САМ СЕБЯ *********/
							?>
					<!-- ПАЛЬЦЫ ВВЕРХ/ВНИЗ -->
					<div class="adj-vote-block pull-right trans">
						<div class="voting a-right">
							<span class="glyphicon glyphicon-thumbs-up text-white"></span>
							<span class="vote-count">{{adj._ang_pos_count}}</span>
						</div>
						
						<div class="voting a-right">
							<span class="glyphicon glyphicon-thumbs-down text-white"></span>
							<span class="vote-count">{{adj._ang_neg_count}}</span>
						</div>
						
						<div class="voting a-center">
							<!-- <span class="text-success pointer glyphicon glyphicon-eye-open" ng-class="{'glyphicon-eye-close': hover, 'text-error' : hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false"></span> -->
							<!--
<span class="pointer glyphicon" 
								ng-class="{ 'text-error glyphicon-eye-close'  : ((adj.hidden && !hover) || (hover && !adj.hidden)), 
											'text-success glyphicon-eye-open' : (!adj.hidden || hover)
										}" 
								ng-mouseenter="hover = true" 
								ng-mouseleave="hover = false"
								ng-click="adj.hidden = !adj.hidden"></span>
-->
							<span class="eye pointer glyphicon" 
								ng-class="{ 'text-error glyphicon-eye-close'	: adj.hidden, 
											'text-success glyphicon-eye-open'	: !adj.hidden
										}" 
								ng-mouseenter="hover = true" 
								ng-mouseleave="hover = false"
								ng-click="hide(adj)"></span>
						</div>

					</div>
					<!-- КОНЕЦ ПАЛЫМ -->
							<?php
						}
					?>
					<!-- БАР-ПРИЛАГАТЕЛЬНОГО -->
					<div class="adjective-bar progress-primary" style="margin: 2px 0 20px">
						<div id="bar-{{adj.id}}" class="bar" style="width: {{adj._ang_pos_percent}}%"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- КОНЕЦ СПИСОК ПРИЛАГАТЕЛЬНЫХ -->
		
	</div>
</div>

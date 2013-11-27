<div class="container">
	<h1 style="text-align: center; color: white"><?=$User->first_name." ".$User->last_name?></h1>
	<hr>
	<div class="row effect2">
		<div class="col-md-4 center-content">
			<img src="<?=$User->avatar?>" class="avatar center nofloat" height="300" width="300">
		</div>
		
		<div class="col-md-6">
			<div style="clear: both">
			<h2 class="trans">Я думаю, что <?=$User->first_name?></h2>
			</div>
			<div class="adjective-div pull-left">
				<input type="text" placeholder="Красивый" id="adjective">
			</div>
			<button class="btn btn-success btn-xxl">ОК!</button>
		</div>
	</div>
</div>
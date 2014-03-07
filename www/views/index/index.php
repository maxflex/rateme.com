<div class="container">
<?php
	preType($_POST);
?>
	<div class="row">
		<center>
			<div class="col-md-12">
			<form role="form" method="post" action="index.php?controller=index">
				<div class="form-group">
					<label for="login" class="text-white">Логин</label>
					<input id="login" class="form-control" type="text" placeholder="Login" name="login">
				</div>
				<div class="form-group">
					<label for="password" class="text-white">Пароль</label>
					<input id="password" placeholder="Password" type="password" class="form-control" name="password">
				</div>
				<div class="form-group">
					<input type="submit" value="Войти" class="btn btn-primary btn-large br5">
				</div>
			</form>	
			</div>
		</center>
	</div>
</div>
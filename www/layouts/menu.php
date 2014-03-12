<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
  <div class="container" style="width: 80%;">
    <a class="brand" href="#" style="padding: 0"><img src="img/logo/testlogo.png" height="50" width="50"></a>
	<div class="top-loader">
		<img src="img/loader/spinner.gif">
	</div>
    <div class="nav-collapse">
	<ul class="nav pull-right">
	<?php
		/************ МЕНЮ ДЛЯ ЗАЛОГИНЕННЫХ ************/
		
		// Выводим пункт меню «Уведомления» только если пользователь залогинен
		if (!empty($_SESSION["user"])) {
			// Получаем пользователя
			$User = User::fromSession();
			
			echo "<li ".menuActive("profile", "").">";
			// Если есть новости, выводим
			$NewsCount = $User->newsCount();
			
			if ($NewsCount) {
				// Если кол-во новостей меньше 10, то циферка больше шрифтом
				echo '<span class="count '.($NewsCount < 10 ? 'd1' : '').'">'.$NewsCount.'</span>';
			}
			
			// Отображаем сам пункт меню
			?>
        	<a href="index.php?controller=profile">
        		<span class="flaticon-church2"></span>
        	</a>
			</li>
			
			<!-- ПУНКТ МЕНЮ «ПРОФИЛЬ» -->
			<li <?=(menuActive("user", null, array("user" => $User->login)))?> >
        		<a href="index.php?controller=user&user=<?= $User->login ?>"><span class="glyphicon glyphicon-user"></span></a>
        	 </li>
        	<!-- КОНЕЦ МЕНЮ «ПРОФИЛЬ» -->

			<!-- ПУНКТ МЕНЮ «НАСТРОЙКИ» -->
			<li <?=(menuActive("profile", "edit"))?> >
        		<a href="index.php?controller=profile&action=edit"><span class="glyphicon glyphicon-th"></span></a>
        	 </li>
        	<!-- КОНЕЦ МЕНЮ «НАСТРОЙКИ» -->
        	
        	<!-- ПУНКТ МЕНЮ «ВЫХОД» -->
        	<li>
        		<a href="index.php?controller=index&action=logout"><span class="glyphicon glyphicon-log-out"></span></a>
        	</li>
        	<!-- КОНЕЦ МЕНЮ «ВЫХОД» -->
	<?php
		} else {
			/************ МЕНЮ ДЛЯ НЕ ЗАЛОГИНЕННЫХ ************/
			// Иначе пункты меню для незалогененных
			?>
			<li>
        		<a href="index.php?controller=index"><span class="glyphicon glyphicon-log-in inline"></span>Вход</a>
        	</li>
			<?php
		}
	?>
      </ul>
	</div><!-- /.nav-collapse -->
  </div>
</div><!-- /navbar-inner -->
</div>  

<!-- БЭКГРАУНД -->
<div class="bg-blue" height="100%" width="100%"></div>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
  <div class="container" style="width: 80%;">
    <a class="brand" href="#" style="padding: 0"><img src="img/logo/testlogo.png" height="50" width="50"></a>
	<div class="top-loader">
		<img src="img/loader/spinner.gif">
	</div>
    <div class="nav-collapse">
	<ul class="nav pull-right">
        <li <?=($_GET["controller"] == "profile" ? "class='active'" : "")?>><a href="index.php?controller=profile">ПРОФИЛЬ</a></li>
        <li <?=($_GET["controller"] == "user" ? "class='active'" : "")?>><a href="index.php?controller=user&user=<?=$_SESSION["user"]->login?>">ОЦЕНКИ</a></li>
        <li><a href="#">РЕЙТИНГ</a></li>
        <li><a href="index.php?controller=index">ВЫХОД</a></li>
      </ul>
	</div><!-- /.nav-collapse -->
  </div>
</div><!-- /navbar-inner -->
</div>  

<!-- БЭКГРАУНД -->
<div class="bg-blue" height="100%" width="100%"></div>
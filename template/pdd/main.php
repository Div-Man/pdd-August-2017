<!DOCTYPE html>
<html>
	<head>
		<title>ПДД В моём городе</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="normalize.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<title>ПДД в моём городе</title>
		<link rel="stylesheet" type="text/css" href="normalize.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="for-ramki hide-for-planshet-and-mobil">
			<form method="POST" class="clearfix forma-for-planshet">
				<div class="clearfix wrapper-for-login">
					<p class="login"><span></span><input type="text" placeholder="Логин"></p>
					<p class="password"><span></span><input type="password" placeholder="Пароль"></p>
				</div>
				
				<div class="btn-and-zapomnit clearfix">
					<input class="btn-vxod" type="submit" value="войти">
								
					<label class="zapomnit">
						<input id="my_check2" type="checkbox" />
						<label for="my_check2"><span>Запомнить</span></label>
					</label>
				</div>			
			</form>
			<div class="reg">
				<p>
					В первый раз на сайте?
				</p>
				<a href="#">Регистрация</a>
			</div>		
		</div>
		
		<header class="main-header">
		<div class="nav-for-mobil clearfix">
		
			<div class="xleb-kolbasa-sir">
				<a class="click-na-vkusn9shky" href="#"></a>
			</div>
			
			<div class="top-menu hide-for-mobil">
				<a href="/">Главная</a>
				<a href="#">Город</a>
				<a href="#">О сайте</a>
				<a href="#">Обратная связь</a>
			</div>
		
			<div class="logo-for-mobil clearfix">
				<a href="#"><img src="img/logo.png" width="35px" height="35px" alt="Логотип"></a>
			</div>
			
			
			<div class="vxod-for-mobil">
					<p class="title-vxod-for-mobil">Вход на сайт</p>
					
				
				</div>
				
			
		
			
		</div>
		
			<div class="inner-header">
				<div class="logo clearfix">
				<a href="#"><img src="img/logo.png" width="100%" height="100%" alt="Логотип"></a>
				</div>
				<div class="discription">
					<p>ПДД в моём городе</p>
					<p>Научи ездить по правилам</p>
				</div>
				<a href="#" class="btn-chooce">Выбери свой город</a>
				
				
			</div>
			<div class="wraper-top-nav">
				<div class="top-menu clearfix">
					<a href="/">Главная</a>
					<a href="#">Город</a>
					<a href="#">О сайте</a>
					<a href="#">Обратная связь</a>
					
					
					
					<?php
						if(!empty($_SESSION['userPdd'])) {
							require_once 'user-profil.php';
						}
					?>
					
					
				</div>
				
				
			</div>
		</header>
		
		<section class="content clearfix">
		<div class="vxod-and-comments clearfix">
			<?php
				if(empty($_SESSION['userPdd']) && empty($_GET['action'])) {
						require_once 'forma-vxoda.php';
					}
							
				
							
				if(!empty($_GET['action'])) {
					if($_GET['action'] === 'registr') {
						require_once 'registr.php';			
					}
				}
						
			?>
				
				<div class="last-comment clearfix">
					<p class="title-vxod">Последние комментарии</p>
					<div class="for-ramki clearfix">
					
						<div class="com">
							<div class="ava-and-name-and-data-and-rep clearfix">
								<div class="ava">
									<img src="img/ava.jpg" width="80">
								</div>
								<div class="name-and-data-and-rep">
									<div class="name-and-data">
										<div class="name-comment"><a href="#">oleg_ra</a></div>
										<div class="data-comment">22.02.2017</div>
									</div>
									<div class="name-rep">Репутация: 10</div>
								</div>
							</div>
							<div class="description-comment clearfix">
								<p>
									Тут сложная ситуация, не каждый
									сотрудник ГАИ даже сразу сможет
									разобраться
								</p>
								<a href="#">перейти к комментарию</a>
							</div>
						</div>
						
						<div class="com">
							<div class="ava-and-name-and-data-and-rep clearfix">
								<div class="ava">
									<img src="img/ava2.jpg" width="80">
								</div>
								<div class="name-and-data-and-rep">
									<div class="name-and-data">
										<div class="name-comment"><a href="#">oleg_ra</a></div>
										<div class="data-comment">22.02.2017</div>
									</div>
									<div class="name-rep">Репутация: 10</div>
								</div>
							</div>
							<div class="description-comment clearfix">
								<p>
									Вообще непонятно кто в такой вот
									ситуации прав, а кто виноват.
									Я лично с инструктором, когда ...
								</p>
								<a href="#">перейти к комментарию</a>
							</div>
						</div>
						</div>
					</div>
				</div>
		
			
				<!--
					<div class="main-page">
						<a href="./">Главная страница</a>
					</div>
					<div class="select-city">
						<a href="?choose-city=yes">Выбрать город</a>
					</div>
					<div class="about">
						<a href="?about=read">О сайте</a>
					</div>
					<br>
					<br>
					<div class="about">
						<a href="?call=admin">Связаться с администрацией</a>
					</div>
				-->
				<div class="questions">
					<?php
					
						if(!empty($_GET['author-question'])) {
							require_once 'show-user-profil.php';
							
							$userName = explode('.', $_GET['author-question'])[0];
							$userId = explode('.', $_GET['author-question'])[1];
							setcookie ('userName', $userName, time()+6048);
							setcookie ('userId', $userId, time()+6048);
							
						}
						
						elseif(!empty($_GET['show-question-user'])) {
							require_once 'show-question-user.php';
							
						}
						
						elseif(!empty($_GET['about'])) {
							require_once 'about.php';
							
						}
						elseif(!empty($_GET['call'])) {
							require_once 'call-admin.php';
							
						}
						
						elseif(!empty($_GET['action'])) {
							if($_GET['action'] === 'add-question') {
								require_once 'add-question.php';
							}
							
							if($_GET['action'] === 'edit-user-profil') {
								require_once 'edit-user-profil.php';
							}
							if($_GET['action'] === 'registr') {
								require_once 'all-question.php';
							}
						}
						
						elseif(!empty($_GET['all-city'])) {
							require_once 'all-city.php';
						}
						
						elseif(!empty($_GET['city'])) {
							require_once 'all-street.php';
							
						}
						
						elseif(!empty($_GET['comments'])) {
							require_once 'comments.php';
						}
						
						elseif(!empty($_GET['my-questions']) && !empty($_SESSION['id'])) {
							require_once 'my-questions.php';
						}
						
						
						elseif(!empty($_GET['choose-city'])) {
							require_once 'choose-city.php';
						}
						
						elseif((!empty($_SESSION['userPdd']) || empty($_SESSION['userPdd'])) && empty($_GET['my-bookmark'])) {
							require_once 'all-question.php';
						}
						
						elseif(!empty($_GET['my-bookmark'])) {
							require_once 'my-bookmark.php';
						}
						
						
					?>
					
					
					
				</div>
				
				
			
			
			
			
		</section>
		
		<footer>
			<div class="inner-footer">
			
				<a class="logo-footer" href="#"><img src="img/logo.png" width="100%" height="100%" alt="Логотип"></a>
				
				<div class="bottom-menu">
					<a href="#">Главная</a>
					<a href="#">Город</a>
					<a href="#">О сайте</a>
					<a href="#">Обратная связь</a>
				</div>
				
				<p class="each">Каждому своя дорога</p>
				<p class="my-sait">&copy; pdd-vmg.ru, 2017</p>
				
				<p class="each2">Каждому своя дорога</p>
			</div>
		</footer>
		
		<script src="script.js"></script>
	</body> 
</html>
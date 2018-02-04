
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta name="yandex-verification" content="e37dc5698c4f5b46" />
		<title>ПДД в моём городе</title>
		 <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="normalize.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		
		<?php
			if(empty($_GET['reg-mobil'])) {
				echo '
		<div class="for-ramki hide-for-planshet-and-mobil">
			<form method="POST" class="clearfix forma-for-planshet">
				<div class="clearfix wrapper-for-login">
					<p class="login"><span></span><input type="text" placeholder="Логин" name="log"></p>
					<p class="password"><span></span><input type="password" placeholder="Пароль" name="password"></p>
				</div>
				
				<div class="btn-and-zapomnit clearfix">
					<input class="btn-vxod auth2" type="submit" value="войти" name="auth">
								
					<label class="zapomnit">
						<input id="my_check2" type="checkbox" name="rememberPass" value="0">
						<label for="my_check2"><span>Запомнить</span></label>
					</label>
				</div>			
			</form>
			
			<div id="wrongLogin2"></div>
			
			<div class="reg">
				<p>
					В первый раз на сайте?
				</p>
				<a href="?reg-mobil=ok">Регистрация</a>
			</div>		
		</div>
		
		
		
				';
				
		require_once 'auth-mobil.js';
			}
			
			if(!empty($_GET['reg-mobil'])) {
				require 'registr.php';
				die();
			}
		?>
	
	
		
		
		
		
		
		
		<?php
			if(!empty($_GET['action'])) {
				if($_GET['action'] == 'add-question' || $_GET['action'] == 'edit-user-profil') {
					echo '<header class="main-header header2">';
				}
				else {
					echo '<header class="main-header">';
				}
			}
			else {
				echo '<header class="main-header">';
			}
		?>
	
		<div class="nav-for-mobil clearfix">
		
			<div class="xleb-kolbasa-sir">
				<a class="click-na-vkusn9shky" href="#"></a>
			</div>
			
			<div class="top-menu hide-for-mobil">
				<a href="/">Главная</a>
					<a href="?choose-city=yes">Город</a>
					<a href="?about=read">О сайте</a>
					<a href="?call=admin">Обратная связь</a>
			</div>
		
			<div class="logo-for-mobil clearfix">
				<a href="#"><img src="img/logo.png" width="35px" height="35px" alt="Логотип"></a>
			</div>
			
			
			<div class="vxod-for-mobil">
				<?php
					if(!empty($_SESSION['userPdd'])) {
						echo '<p class="nik-for-mobil">'.$_SESSION['userPdd'].'</p>';
						
						echo '
							<div class="top-menu-avatar-menu mobil-user-menu clearfix">
						<div class="top-menu-ava top-menu-ava-mobil">
							<img src="'.$_SESSION['avatar'].'">
						</div>
										
						<div class="top-menu-menu top-menu-menu2">
							<a class="open-submenu-user2" href="#"><img src="img/burger.png"></a>
						</div>
						<div class="submenu-user2">
							<ul>
								<li><a href="?action=edit-user-profil&token='.$_SESSION['token'].'">Профиль</a></li>
								<li><a href="?action=add-question&token='.$_SESSION['token'].'">Добавить вопрос</a></li>
								<li><a href="?my-questions='.$_SESSION['userPdd'].'">Мои вопросы</a></li>
								<li><a href="?my-bookmark='.$_SESSION['userPdd'].'">Мои закладки</a></li>
								<li><a class="exit-user" href="?action=exit&token=<'.$_SESSION['token'].'">Выход</a></li>
							</ul>
						</div>
							
					</div>				
						';
					}
					else {
						echo '<p class="title-vxod-for-mobil">Вход на сайт</p>';
					}
				?>
					
			</div>
	

				</div>
		</div>
			
			<?php
				if(!empty($_GET['action'])) {
					if($_GET['action'] == 'add-question' || $_GET['action'] == 'edit-user-profil') {
						echo '
							<div class="inner-header inner-header2">
								<div class="discription discription2">
									<p>Тренажер ПДД</p>
									<p>На дорогах твоего города</p>
								</div>
							</div>
						';
					}
					
					else {
						echo '
							<div class="inner-header">
								<div class="logo clearfix">
								<a href="#"><img src="img/logo.png" width="100%" height="100%" alt="Логотип"></a>
								</div>
								<div class="discription">
									<p>Тренажер ПДД</p>
									<p>На дорогах твоего города</p>
								</div>
								<a href="?choose-city=yes" class="btn-chooce">Выбери свой город</a>
							</div>
						';
					}
					
				}
				
				else {
						echo '
							<div class="inner-header">
								<div class="logo clearfix">
								<a href="#"><img src="img/logo.png" width="100%" height="100%" alt="Логотип"></a>
								</div>
								<div class="discription">
									<p>Тренажер ПДД</p>
									<p>На дорогах твоего города</p>
								</div>
								<a href="?choose-city=yes" class="btn-chooce">Выбери свой город</a>
							</div>
						';
					}
				
			?>
			
			
			<div class="wraper-top-nav">
				<div class="top-menu clearfix">
					<a href="/">Главная</a>
					<a href="?choose-city=yes">Город</a>
					<a href="?about=read">О сайте</a>
					<a href="?call=admin">Обратная связь</a>
					
					
					
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
						require 'registr.php';			
					}
				}
						
			?>
				
					<div class="last-comment clearfix">
						<?php
							require_once 'last-comment.php';
						?>
					</div>
				</div>
		
			
				<div class="questions">
					<?php
					
						if(!empty($_GET['author-question'])) {
							require_once 'show-user-profil.php';
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
		
		<footer style="position: relative;">
			<div class="inner-footer">
			
				<a class="logo-footer" href="#"><img src="img/logo.png" width="100%" height="100%" alt="Логотип"></a>
				
				<div class="bottom-menu">
					<a href="/">Главная</a>
					<a href="?choose-city=yes">Город</a>
					<a href="?about=read">О сайте</a>
					<a href="?call=admin">Обратная связь</a>
				</div>
				
				<p class="each">Каждому своя дорога</p>
				<p class="my-sait">&copy; pdd-vmg.ru, 2017</p>
				
				<p class="each2">Каждому своя дорога</p>
			</div>
			
			<!--LiveInternet counter--><script type="text/javascript">
			document.write("<a style='position: absolute; bottom: 0; left: 5%' class='liveinet' href='//www.liveinternet.ru/click' "+
			"target=_blank><img src='//counter.yadro.ru/hit?t11.6;r"+
			escape(document.referrer)+((typeof(screen)=="undefined")?"":
			";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
			screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
			";"+Math.random()+
			"' alt='' title='LiveInternet: показано число просмотров за 24"+
			" часа, посетителей за 24 часа и за сегодня' "+
			"border='0' width='88' height='31'><\/a>")
			</script><!--/LiveInternet-->
		</footer>
		
		<script src="script.js"></script>
		
		
	</body> 
</html>
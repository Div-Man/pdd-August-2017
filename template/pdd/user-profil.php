
<!--
<p>Профиль пользователя <?php echo $_SESSION['userPdd']?></p>
	<p class="user-avatar">
		<img src="<?php echo $_SESSION['avatar'];?>">
	</p>
	<p>Репутация <span class="user-status"><?php echo $_SESSION['reputation'];?></span></p>
	<ul>
		<li><a href="?action=edit-user-profil&token=<?php echo $_SESSION['token'];?>">Редактировать профиль</a></li>
		<li><a href="?action=add-question&token=<?php echo $_SESSION['token'];?>">Добавить вопрос</a></li>
		<li><a href="?my-questions=<?php echo $_SESSION['userPdd']?>">Мои вопросы</a></li>
		<li><a href="?my-bookmark=<?php echo $_SESSION['userPdd']?>">Закладки</a></li>
		<li><a href="?action=exit&token=<?php echo $_SESSION['token'];?>">Выход</a></li>
	</ul>
	-->
	
	<div class="user-profil clearfix">
		<div class="top-menu-user-name-rep">
			<div class="top-menu-name">DivMan</div>
			<div class="top-menu-rep">Репутация: 10</div>
		</div>
						
		<div class="top-menu-avatar-menu clearfix">
			<div class="top-menu-ava">
				<img src="img/ava.jpg">
			</div>
							
			<div class="top-menu-menu">
				<a class="open-submenu-user" href="#"><img src="img/burger.png"></a>
			</div>
							
		</div>				
	</div>
	
<div class="submenu-user">
	<ul>
		<li><a href="?action=edit-user-profil&token=<?php echo $_SESSION['token'];?>">Профиль</a></li>
		<li><a href="?action=add-question&token=<?php echo $_SESSION['token'];?>">Добавить вопрос</a></li>
		<li><a href="?my-questions=<?php echo $_SESSION['userPdd']?>">Мои вопросы</a></li>
		<li><a href="?my-bookmark=<?php echo $_SESSION['userPdd']?>">Мои закладки</a></li>
		<li><a class="exit-user" href="?action=exit&token=<?php echo $_SESSION['token'];?>">Выход</a></li>
	</ul>
</div>
	

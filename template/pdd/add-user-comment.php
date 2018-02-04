
<div class="avatar-user-comment">
	<p>
	<?php
		echo $_SESSION['userPdd'];
	?>
	</p>	
	<img src="<?php echo $_SESSION['avatar'];?>">
</div>
						
<form method="post" class="add-comment">
	<div><textarea name="user-comment"></textarea></div>
	<input type="submit" value="Добавить комментарий" name="add-comment">
</form>
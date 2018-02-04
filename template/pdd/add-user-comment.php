	<form method="post" class="add-user-comment">
								<div class="personal-comment personal-comment2 clearfix">
								<div class="kolonki-for-mobil  delete-razdelitel">
								
									<div class="user-data-mobil right-ramka">
										<span>Написать комментарий</span>
									</div>
								
									<div class="ava-comment-wrap">
										<div class="ava-center clearfix">
											<div class="ava">
												<img src="<?php echo $_SESSION['avatar'];?>" width="80">
											</div>
										</div>
										
										<div class="user-name-rep">
											<a class="author" href="#"><?php echo $_SESSION['userPdd'];?></a>
											
											<div class="user-rep-comment">
												<span>Репутация: </span><span class="green"><?php echo $_SESSION['reputation']?></span>
											</div>
										</div>
											
									</div>
									
									
								</div>	
									
									<div class="user-description-comment">
	<div class="user-data-comment">
		<span>Написать комментарий</span>
	</div>
										
	<div class="comment-content commetn-textarea">
		<textarea name="user-comment"></textarea>
	</div>
										
</div>
								</div>
								<input type="submit" value="Отправить" class="btn-add-comment" name="add-comment">
								</form>





						


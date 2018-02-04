
<?php
	$userName = explode('.', $_GET['author-question'])[0];
	$userId = explode('.', $_GET['author-question'])[1];
?>

							
		<div class="red-profil">
			<p class="new-questions show-profil">Просмотр профиля, у пользователя <?php echo $userName;?></p>
			
			<div class="info-user">
				<form method="POST" enctype="multipart/form-data" class="clearfix">
					<div class="add-ava">
						<div class="info-user-img">
							<img src="<?php echo $showUserProfil[0]['avatar'];?>" class="img-circle2" id="theImage2" alt="">
						</div>
					</div>
					
					<div class="data-link-vk-right">
						<div class="data-link-vk">
							<div class="ico-chooce">
								<span class="ico-city ico-data"></span>
								<span class="title-choce">Дата регистрации</span>
							</div>
							<p class="data-reg"><?php echo $showUserProfil[0]['data_reg']?> </p>
						</div>
						<div class="data-link-vk">
							<div class="ico-chooce">
								<span class="ico-city ico-vk"></span>
								<span class="title-choce">Ссылка вконтакте</span>
							</div>
							<p class="link-vk-p">
							<?php
								if(!empty($showUserProfil[0]['link_vk'])) {
									
									
									if (strpos($showUserProfil[0]['link_vk'], '"/>') == '"/>') {
										echo 'Я придурок';
									}
									else {
										echo '<a target="_blank" href="'.$showUserProfil[0]['link_vk'].'">'.$showUserProfil[0]['link_vk'].'</a>';
									}
									
								}
								
								else {
									echo '<strong>Не указанна</strong>.';
								}
							?>
								
							</p>
						</div>
						
						
						<div class="data-link-vk">
							<div class="ico-chooce">
								<span class="title-choce">Количество вопросов:</span>
							</div>
							<p class="data-reg"><?php echo $showUserProfil[0]['count'];?> <a href="?show-question-user=<?php echo $userId;?>">просмотреть</a></p>
						</div>
						
					</div>
				</form>
			</div>
					
		</div>	
					
	
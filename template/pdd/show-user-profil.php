
<?php
	$userName = explode('.', $_GET['author-question'])[0];
	$userId = explode('.', $_GET['author-question'])[1];
?>

<div class="all-city">
						<p>Просмотр профиля, у пользователя <?php echo $userName;?></p>
					</div>
					<div class="show-user-profil">
						<div class="ava">
							<img src="<?php echo $showUserProfil[0]['avatar'];?>">
						</div>
						
						<div class="user-info">
							<p>
								Дата регистрации: <?php echo $showUserProfil[0]['data_reg']?>
							</p>
							<p>
								Количество вопросов: <strong><?php echo $showUserProfil[0]['count'];?></strong> 
								<a href="?show-question-user=<?php echo $userId;?>">просмотреть</a>
							</p>
							<?php
								if(!empty($showUserProfil[0]['link_vk'])) {
									echo '<p>Ссылка вконтакте <a target="_blank" href="'.$showUserProfil[0]['link_vk'].'">'.$showUserProfil[0]['link_vk'].'</a></p>';
								}
								
								else {
									echo '<p>Ссылка вконтакте <strong>не указанна</strong>.</p>';
								}
							?>
							
							
						</div>
						
					</div>
					
	
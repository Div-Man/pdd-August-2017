<?php
	if(empty($_SESSION['userPdd'])) {
		header('Location: ./index.php');
	}
?>
					
		<div class="red-profil">
			<p class="new-questions">Редактирование профиля</p>
			
			<div class="info-user">
				<form method="POST" enctype="multipart/form-data" class="clearfix">
					<div class="add-ava">
						<div class="info-user-img">
							<img src="<?php echo $_SESSION['avatar'];?>" class="img-circle2" id="theImage2" alt="">
							<input type="file" id="photoInput2" name="profil-img">
							<button class="addImg2">Добавить фото</button>
						</div>
					</div>
					
					<div class="data-link-vk-right">
						<div class="data-link-vk">
							<div class="ico-chooce">
								<span class="ico-city ico-data"></span>
								<span class="title-choce">Дата регистрации</span>
							</div>
							<p class="data-reg"><?php echo $_SESSION['dateReg']; ?> </p>
						</div>
						<div class="data-link-vk">
							<div class="ico-chooce">
								<span class="ico-city ico-vk"></span>
								<span class="title-choce">Ссылка вконтакте</span>
							</div>
							<p class="link-vk-p"><input type="text" class="link-vk" name="link-vk" value="<?php if(!empty($_SESSION['vkontakte'])) {
								echo $_SESSION['vkontakte'];
							}
								else {
									echo 'не указана';
								}
							?>"> </p>
						</div>
						<br>
						<div class="btn-save">
							<input type="submit" value="Сохранить" name="editUserProfil">
						</div>
					</div>
				</form>
			</div>
					
		</div>			
					
					
					
	<script>
		var btn = document.querySelector(".addImg2");
			var photoFile = document.getElementById("photoInput2");

			btn.addEventListener('click', function(e) {
				e.preventDefault();
				photoFile.click();
			})

			var fileReader = new FileReader();
			
			fileReader.addEventListener('load', function() {
				theImage2.src = this.result;
			});

			photoInput2.addEventListener('change', function(e) {
				var file = e.target.files[0];

				fileReader.readAsDataURL(file);
			});
			
	</script>				
<?php
	if(empty($_SESSION['userPdd'])) {
		header('Location: ./index.php');
	}
?>

<div class="all-city">
						<p>Редактирование профиля</p>
					</div>
					<div class="edit-user-profil">
						<form method="POST" enctype="multipart/form-data">
							<div class="user-avatar-profil">
							Аватар
								<p>
								<input type="file" id="userImg" name="profil-img">
								<div>
									<img src="" class="img-circle" id="theImage">
								</div>
								</p>
							</div>
							<div class="data-reg">
								Дата регистрации: <strong><?php echo $_SESSION['dateReg']; ?> </strong>
							</div>
							<br>
							<div class="user-vkontakte">
								<label>Ссылка вконтакте <input type="text" class="link-vk" name="link-vk" value="<?php if(!empty($_SESSION['vkontakte'])) {
									echo $_SESSION['vkontakte'];
								}
								else {
									echo 'не указана';
								}
								?>"></label>
							</div>
							<input type="submit" value="Сохранить" name="editUserProfil">
						</form>
						
					</div>
					
	<script>
		var fileReader = new FileReader();

			fileReader.addEventListener('load', function() {
				theImage.src = this.result;
			});

			userImg.addEventListener('change', function(e) {
				var file = e.target.files[0];

				fileReader.readAsDataURL(file);
			});
	</script>				

	<?php

	foreach($redact as $question) {
		echo '<pre>';
			print_r($question);
		echo '</pre>';
	}
	
	
	
?>
	<div class="content-inner clearfix">
				<div class="new-question">
					<p>
						Редактирование вопроса.
					</p>
					
					<form method="POST" enctype="multipart/form-data">
						<p>
							Изображение: <input value="1"type="file" id="photoInput" name="question-img">
							<div>
								<img src="./userFile/DivMan/question/2017-06-25-17-14-45/2014-10-01_135545.jpg" class="img-circle" id="theImage">
							</div>
						</p>
						<p>
							<p>Вопрос:</p>
							<textarea cols="50" rows="5" name="user-question"><?php echo $question['question_name'];?></textarea>
						</p>
						<div class="variant-answers">
							<p>Варианты ответов (минимум 2):</p>
							<div>1. <input type="text" name="var1" value="<?php echo $question['variant1'];?>"></div>
							<div>2. <input type="text" name="var2" value="<?php echo $question['variant2'];?>"></div>
							<div>3. <input type="text" name="var3" value="<?php echo $question['variant3'];?>"></div>
							<div>4. <input type="text" name="var4" value="<?php echo $question['variant4'];?>"></div>
						</div>
						<div>
							<p>Укажите правильный ответ</p>
								<label>1. <input name="answer" <?php echo ($question['answer'] == 1)? 'checked' : '';?> type="radio" value="1"></label>
								<label>2. <input name="answer" <?php echo ($question['answer'] == 2)? 'checked' : '';?> type="radio" value="2"></label>
								<label>3. <input name="answer" <?php echo ($question['answer'] == 3)? 'checked' : '';?> type="radio" value="3"></label>
								<label>4. <input name="answer" <?php echo ($question['answer'] == 4)? 'checked' : '';?> type="radio" value="4"></label>
								
							
						</div>
						<br>
						<div class="choose-city clearfix">
							<div>
								<p>Выберите город</p>
								<select name="choose-city" class="select-choose-city" onchange="showUser(this.value)">
									<option value="0">-</option>
									<?php
										foreach($city as $key) {
											echo '<option value="'.$key['id'].'">'.$key['city_name'].'</option>';	
										}
									?>
								</select>
							</div>
							<div>
								<p>Выберите Улицу</p>
								<select name="choose-street" id="txtHint">
									<option value="0">-</option>
								</select>
							</div>
						</div>
						<br>
						<p class="help">Если нету нужного места, то создайте его</p>
						<a href="" class="btn-creaty-city">Создать</a>
						<br>
						<br>
						
						<div class="create-city none">
							<label>Город (село)<input type="text" name="new-city"></label><br>
							<label>Улица<input type="text" name="new-street"></label><br>
						</div>
						<br>
						<input type="hidden" value="<?php echo $_SESSION['token'];?>">
						<input type="submit" name="add-new-question" value="Редактировать">
					</form>
				</div>
				
				<script>
					var fileReader = new FileReader();

					fileReader.addEventListener('load', function() {
						theImage.src = this.result;
					});

					photoInput.addEventListener('change', function(e) {
						var file = e.target.files[0];

						fileReader.readAsDataURL(file);
					});
					
					/////////////////////////////////////
					
					var help = document.querySelector('.help');
					var chooseCity = document.querySelector('.choose-city');
					var createCity = document.querySelector('.create-city');
					var btnCreateCity = document.querySelector('.btn-creaty-city');
					
					var selectCity = document.querySelector('.select-choose-city');
					
					
					
					btnCreateCity.addEventListener('click', function(e) {
						if(btnCreateCity.textContent == 'Выбрать город') {
							e.preventDefault();
							createCity.classList.add('none');
							chooseCity.classList.remove('none');
							btnCreateCity.textContent = 'Создать';
							help.classList.remove('none');
							
						}
						else {
							e.preventDefault();
							createCity.classList.remove('none');
							chooseCity.classList.add('none');
							btnCreateCity.textContent = 'Выбрать город';
							help.classList.add('none');
							selectCity.options[0].selected = true;
						}
						
						
					})
					
					//////////////////////////////////////////////
					
					function showUser(str) {
					  if (str=="") {
						document.getElementById("txtHint").innerHTML="";
						return;
					  } 
					  if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					  } else { // code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  xmlhttp.onreadystatechange=function() {
						if (this.readyState==4 && this.status==200) {
						  document.getElementById("txtHint").innerHTML=this.responseText;
						}
					  }
					  xmlhttp.open("GET","ajax/getstreet.php?q="+str,true);
					  xmlhttp.send();
					}
					
				</script>
			</div>
			
			
	

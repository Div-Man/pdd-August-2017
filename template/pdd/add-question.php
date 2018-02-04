<?php
	if(empty($_SESSION['userPdd'])) {
		header('Location: ./index.php');
	}
	
	/*
	foreach($lastComment as $lastCom) {
		echo '<pre>';
			print_r($lastCom);
		echo '</pre>';
	}
	*/
?>


				<p class="new-questions">Добавление вопроса</p>
					<div class="add-question">
						<form method="POST" enctype="multipart/form-data">
							<div class="img-chooce-creat clearfix">
								<div class="preview">
									<img src="" class="img-circle" id="theImage" alt="">
									<input type="file" id="photoInput" name="question-img">

									<button class="addImg">Доб. Изображение</button>
								</div>
								
								<div class="chooce-city-street clearfix">
									<div class="chooce-city">
										<div class="ico-chooce">
											<span class="ico-city"></span>
											<span class="title-choce">Выбрать город</span>
										</div>
										
										<select name="choose-city" class="select-choose-city" onchange="showUser(this.value)">
											<option value="0">-</option>
											<?php
												foreach($city as $key) {
													echo '<option value="'.$key['id'].'">'.$key['city_name'].'</option>';
												}
											?>
										</select>
									</div>
									
									<div class="chooce-city">
										<div class="ico-chooce">
											<span class="ico-city ico-street"></span>
											<span class="title-choce">Выбрать улицу</span>
										</div>
										
										<select name="choose-street" id="txtHint">
											<option value="0">-</option>
										</select>
									</div>
								</div>
								
								<div class="create-city clearfix">
									<p>Если нету нужного места, но создайте его.</p>
									
									<div class="wrap-create">
										<div class="ico-chooce ico-chooce2">
											<span class="ico-city"></span>
											<span class="title-choce">Город</span>
										</div>
										<input type="text" name="createCity" class="create-city-input otstup">
									</div>
									<div class="wrap-create">
										<div class="ico-chooce ico-chooce2">
											<span class="ico-city ico-street"></span>
											<span class="title-choce">Улица</span>
										</div>
										<input type="text" name="createStreet" class="create-city-input">
									</div>
									
									<div class="wrap-btn-creaty-city-street">
										<input type="submit" value="Создать" class="btn-create-city-street" name="userCreateCity">
									</div>
									
								</div>
								
							</div>
							
							<div class="question-variant clearfix">
								<div class="textarea">
									<p>Ваш вопрос:<p>
									<textarea name="user-question"></textarea>
								</div>
								
								<div class="variant-input">
									<p>Варианты ответов (минимум 2):</p>
									<div>
										1 <input type="text" name="var1">
									</div>
									<div>
										2 <input type="text" name="var2">
									</div>
									<div>
										3 <input type="text" name="var3">
									</div>
									<div>
										4 <input type="text" name="var4">
									</div>
								</div>
								
								<div class="true-answer true-answer-mobil">
									<p>Правильный:</p>
									
									 <ul class="clearfix">
									  <li><span class="num-for-mobil">1</span>
										<input type="radio" id="etic" name="answer" value="1">
										<label for="etic"></label>
										
										<div class="check"></div>
									  </li>
									  
									  <li><span class="num-for-mobil">2</span>
										<input type="radio" id="kik" name="answer" value="2">
										<label for="kik"></label>
										
										<div class="check"><div class="inside"></div></div>
									  </li>
									  
									  <li><span class="num-for-mobil">3</span>
										<input type="radio" id="kuim" name="answer" value="3">
										<label for="kuim"></label>
										
										<div class="check"><div class="inside"></div></div>
									  </li>
									  <li><span class="num-for-mobil">4</span>
										<input type="radio" id="nel" name="answer" value="4">
										<label for="nel"></label>
										
										<div class="check"><div class="inside"></div></div>
									  </li>
									</ul>
								</div>
								
							</div>
							<div class="btn-add-question">
								<input type="submit" value="Добавить вопрос" name="add-new-question">
								
								
				
							</div>
							
						</form>
					</div>
					
					
					
					<script>
			var btn = document.querySelector(".addImg");
			var photoFile = document.getElementById("photoInput");

			btn.addEventListener('click', function(e) {
				e.preventDefault();
				photoFile.click();
			})

			var fileReader = new FileReader();
			
			fileReader.addEventListener('load', function() {
				theImage.src = this.result;
			});

			photoInput.addEventListener('change', function(e) {
				var file = e.target.files[0];

				fileReader.readAsDataURL(file);
			});
			
			
		</script>
					
					
					<script>
					
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
					  xmlhttp.open("GET","./?q="+str,true);
					  xmlhttp.send();
					}
					
					</script>
	

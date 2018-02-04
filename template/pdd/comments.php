<?php
	
	$peremenayaForRadioName = 0;
?>	
	
	
					<?php
			foreach($comment as $question) {
		
				echo '<div class="question">';
				
					echo '<div class="top-infa clearfix">';
					
						echo '<div class="wrapper-city clearfix">';
							echo '<div class="city">';
								echo '<div class="city-ico-name">';
									echo '<img src="img/city.png">';
									
									echo '<span>Город</span>';
								echo '</div>';
								echo '<div class="city-name">';
									echo '<span class="city-for-mobil">Г. </span>'. htmlspecialchars($question['city_name'],ENT_QUOTES);
								echo '</div>';
							echo '</div>';
						
							echo '<div class="city">';
								echo '<div class="city-ico-name">';
									echo '<img src="img/street.png">';
									
									echo '<span>Улица</span>';
								echo '</div>';
								echo '<div class="city-name">';
									echo '<span class="city-for-mobil">Ул. </span>'.htmlspecialchars($question['street_name'], ENT_QUOTES);
								echo '</div>';
							echo '</div>';
						echo '</div>';
						
						
						
						
						echo '<div class="wrapper-city clearfix">';
							echo '<div class="city">';
								echo '<div class="city-ico-name">';
									echo '<img src="img/author.png">';
									
									echo '<span>Автор</span>';
								echo '</div>';
								echo '<div class="city-name">';
									echo '<span class="city-for-mobil">Автор: </span><a class="author2" href="?author-question='.$question['login'].'.'.$question['user_id'].'">' . $question['login'] . '</a>';
								echo '</div>';
							echo '</div>';
						
							echo '<div class="city">';
								echo '<div class="city-ico-name">';
									echo '<img src="img/data.png">';
									
									echo '<span>Дата</span>';
								echo '</div>';
								echo '<div class="city-name">';
									echo '<span class="city-for-mobil">от </span>'.$question['date'];
								echo '</div>';
							echo '</div>';
						echo '</div>';
						
					echo '</div>';
				
					
					echo '<div class="img-and-variantbi clearfix">';
				
						echo '<div class="question-img">';
							echo '<img width="100%" height="100%" src="'.$question['img'].'">';
						echo '</div>';
					
						
						echo '<div class="wrapper-for-com-mobil clearfix">';
						
							echo '<div class="bookmark">';
								
								
								
							echo '<form method="post" class="add-bookmark-mobil">';
									if(empty($_SESSION['userPdd'])) {
										echo '<input type="hidden" value="0" name="idUser">';
									}
									else {
										echo '<input type="hidden" value="'.$_SESSION['id'].'" name="idUser">';
									}
									echo '
										<input type="hidden" value="'.$question['id'].'" name="idQuestion">
										<button class="btn-bookmark2 btn-for-mobil"></button>';
											
								echo '</form>';
								
								
							echo '</div>';
						echo '</div>';
					
						echo '<div class="question-for-img">';
							echo '<p class="question-title">';
								echo htmlspecialchars($question['question_name'],ENT_QUOTES);
							echo '</p>';
							echo '<form method="post">';
								echo '<ul class="clearfix radio-answer">';
								
								
								
									echo '<li>';
										echo '<input type="radio" id="etic'.$peremenayaForRadioName.'" name="chooseAnswer" value="1">';
										echo '<label for="etic'.$peremenayaForRadioName.'">'.htmlspecialchars($question['variant1'],ENT_QUOTES).'</label>';
										echo '<div class="check"></div>';
									echo '</li>';
									
									
									
									echo '<li>';
										echo '<input type="radio" id="kik'.$peremenayaForRadioName.'" name="chooseAnswer" value="2">';
										echo '<label for="kik'.$peremenayaForRadioName.'">'. htmlspecialchars($question['variant2'],ENT_QUOTES) .'</label>';
										echo '<div class="check"><div class="inside"></div></div>';
									echo '</li>';
									
									

									if(!empty($question['variant3'])) {
										echo '<li>';
											echo '<input type="radio" id="kuim'.$peremenayaForRadioName.'" name="chooseAnswer" value="3">';
											echo '<label for="kuim'.$peremenayaForRadioName.'">'.htmlspecialchars($question['variant3'],ENT_QUOTES).'</label>';
											echo '<div class="check"><div class="inside"></div></div>';
									echo '</li>';
									}
									
									
									if(!empty($question['variant4'])) {
												
										echo '<li>';
											echo '<input type="radio" id="nel'.$peremenayaForRadioName.'" name="chooseAnswer" value="4">';
											echo '<label for="nel'.$peremenayaForRadioName.'">'.htmlspecialchars($question['variant4'],ENT_QUOTES).'</label>';
											echo '<div class="check"><div class="inside"></div></div>';
										echo '</li>';
												
									}
									
								echo '</ul>';
								
								echo '<input type="submit" value="Проверить" class="ans btnAnswer">';
								echo '<input type="hidden" value="'.htmlspecialchars($question['id'],ENT_QUOTES).'" name="questionId">';
								echo '<div class="txtHint"></div>';
							echo '</form>';
							
							echo '<div class="wrapper-for-com">';
								
								echo '<div class="bookmark">';
								
								
								echo '<form method="post" class="add-bookmark">';
										if(empty($_SESSION['userPdd'])) {
											echo '<input type="hidden" value="0" name="idUser">';
										}
										else {
											echo '<input type="hidden" value="'.$_SESSION['id'].'" name="idUser">';
										}
										echo '<input type="hidden" value="'.$question['id'].'" name="idQuestion">';
										echo '<span class="for-desctop btn-bookmark">Добавить в закладки</span>';
									echo'</form>';
		
								echo '</div>';
							echo '</div>';
							
						echo '</div>';
						
					echo '</div>';
				echo '</div>';
							
							
							
					/////////////////////////////////
					$peremenayaForRadioName++;			
				}
					
					?>
					
					<script>
					var ans = document.querySelectorAll('.ans');
					var otvet = document.querySelectorAll(".txtHint");
					
					ans.forEach(function(element, i){
						ans[i].addEventListener('click', function(e) {
							e.preventDefault();
							var forma = e.target.parentElement;
							var idQuestion = forma.elements.questionId.value;
							var answer = forma.elements.chooseAnswer.value;
							
							xmlhttp=new XMLHttpRequest();
							
							xmlhttp.onreadystatechange=function() {
								if (this.readyState==4 && this.status==200) {
									if(answer=="") {
										otvet[i].innerHTML = '<p>Выберите ответ</p>';
									}
									else {
										otvet[i].innerHTML=this.responseText;
									}
								  
								}
							  }
							  xmlhttp.open("GET","./?q="+idQuestion+"&a="+answer,true);
							  xmlhttp.send();
 
						})
					
					})
					
					
					var addBookmark = document.querySelectorAll('.add-bookmark');
					var btnBookmark = document.querySelectorAll('.btn-bookmark');
					
					addBookmark.forEach(function(element2, j){
						addBookmark[j].addEventListener('click', function(e) {
							e.preventDefault();
							var forma = e.target.parentElement;
							var idUser = forma.elements.idUser.value;
							var idQuestion = forma.elements.idQuestion.value;
							
							xmlhttp=new XMLHttpRequest();
							
							xmlhttp.onreadystatechange=function() {
								if (this.readyState==4 && this.status==200) {
									btnBookmark[j].innerHTML=this.responseText;
								}
							  }
							  	xmlhttp.open("POST","./",true);
							xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
							xmlhttp.send("user="+idUser+"&question="+idQuestion);
							
						})
					
					})
					
					var addBookmarkMobil = document.querySelectorAll('.add-bookmark-mobil');
					var btnBookmark2 = document.querySelectorAll('.btn-bookmark2');
					
					console.log(addBookmarkMobil);
					
					addBookmarkMobil.forEach(function(element3, k){
						addBookmarkMobil[k].addEventListener('click', function(ee) {
							ee.preventDefault();
							var forma = ee.target.parentElement;
							var idUser = forma.elements.idUser.value;
							var idQuestion = forma.elements.idQuestion.value;
							
						
							xmlhttp=new XMLHttpRequest();
							
							console.log(idUser);
							
							xmlhttp.onreadystatechange=function() {
								if (this.readyState==4 && this.status==200) {
									btnBookmark2[k].innerHTML=this.responseText;
									btnBookmark2[k].style.background = 'none';
									btnBookmark2[k].style.width = 100 + '%';
									btnBookmark2[k].style.border = 'none';
									
									
								
								}
							  }
							 	xmlhttp.open("POST","./",true);
								xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
								xmlhttp.send("user="+idUser+"&question="+idQuestion);
								
							
						})
					
					})
					
					</script>
					
					<div class="users-comments">
						
				
						
						<?php
						
							function calendar($d) {
								$dataComment = explode('.', $d);
								$dataCompare = $dataComment[1];
								$moth = '';
								
								switch($dataCompare) {
									case '01':
										$moth = 'Января';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '02':
										$moth = 'Февраля';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '03':
										$moth = 'Марта';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '04':
										$moth = 'Апреля';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '05':
										$moth = 'Мая';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '06':
										$moth = 'Июня';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '07':
										$moth = 'Июля';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '08':
										$moth = 'Августа';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '09':
										$moth = 'Сентября';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '10':
										$moth = 'Октября';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '11':
										$moth = 'Ноября';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;
									case '12':
										$moth = 'Декабря';
										$echoData = $dataComment[0] . ' ' . $moth . ' ' . $dataComment[2] . ', ' . $dataComment[3] . ':' . $dataComment[4];
										return $echoData;	
								}
							}
						
							$countComment = 1;
							foreach($userComment as $comment) {
										echo '
								
							<div class="personal-comment clearfix">
								<div class="kolonki-for-mobil">
									<div class="ava-comment-wrap">
										<div class="ava-center clearfix">
											<div class="ava">
												<img src="'.$comment['avatar'].'" width="80">
											</div>
										</div>
										
										<div class="user-name-rep">
											<a class="author" href="?author-question='.$comment['login'].'.'.$comment['user_id'].'">'.$comment['login'].'</a>
											
											<div class="user-rep-comment">
												<span>Репутация: </span><span class="green">'.$comment['reputation'].'</span>
											</div>
										</div>
											
									</div>
									
									<div class="user-data-mobil">
										<span>'.calendar($comment['date_add']).'</span>
									</div>
								</div>	
									
									<div class="user-description-comment">
										<div class="user-data-comment">
											<span>Комментарий № '.$countComment.' * '.calendar($comment['date_add']).'</span>
										</div>
										
										<div class="comment-content">
											<p>'.htmlspecialchars($comment['text_comment'],ENT_QUOTES).'</p>
										</div>
									</div>
										
								</div>
								';
								
								$countComment++;
							}
						?>
						
						
						<div class="add-user-comment clearfix">
							<?php
								if(!empty($_SESSION['userPdd'])) {
									require 'add-user-comment.php';
								}
								else {
									echo '<p>Что бы добавить комментарий, надо авторизироваться.</p>';
								}
							?>
						</div>
						
							
							
						
	
						
					</div>
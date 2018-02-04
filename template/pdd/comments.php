<?php
/*
	echo '<pre>';
	print_r($comment);
	echo '</pre>';
	
	
	echo '<pre>';
	print_r($userComment);
	echo '</pre>';
	*/
?>	
	
	
					<?php
						
							foreach($comment as $question) {
							echo '<div class="main-question clearfix">';
								echo '<div class="question">';
									echo '<div class="city-street">';
										echo '<p>'.htmlspecialchars($question['city_name'],ENT_QUOTES).', улица '.htmlspecialchars($question['street_name'], ENT_QUOTES).'</p>';
									echo '</div>';
									echo '<div class="question-img">';
										echo '<img width="600" src="'.$question['img'].'" class="question-img">';
									echo '</div>';
									
									echo '<div class="question-title"><p>';
										echo htmlspecialchars($question['question_name'],ENT_QUOTES);
									echo '</p></div>';
									
									echo '<div class="answers">';
										echo '<form method="POST">';
											echo '<label><input type="radio" name="chooseAnswer" value="1">'.htmlspecialchars($question['variant1'],ENT_QUOTES).'</label><br>';
											echo '<label><input type="radio" name="chooseAnswer" value="2">'.htmlspecialchars($question['variant2'],ENT_QUOTES).'</label><br>';
											if(!empty($question['variant3'])) {
												echo '<label><input type="radio" name="chooseAnswer" value="3">'.htmlspecialchars($question['variant3'],ENT_QUOTES).'</label><br>';
											}
											if(!empty($question['variant4'])) {
												echo '<label><input type="radio" name="chooseAnswer" value="4">'.htmlspecialchars($question['variant4'],ENT_QUOTES).'</label><br>';
											}
											echo '<button class="ans">Проверить</button>';
											echo '<input type="hidden" value="'.htmlspecialchars($question['id'],ENT_QUOTES).'" name="questionId">';
										echo '</form>';
									echo '</div>';
									
									echo '<div class="txtHint"></div>';
									
									echo '<div class="question-footer">';
										echo '<a href="?comments='.$question['id'].'">Перейти к коментариям</a>';
										echo '<form method="post" class="add-bookmark">
												';
												if(empty($_SESSION['userPdd'])) {
													echo '<input type="hidden" value="0" name="idUser">';
												}
												else {
													echo '<input type="hidden" value="'.$_SESSION['id'].'" name="idUser">';
												}
												echo '
											<input type="hidden" value="'.$question['id'].'" name="idQuestion">
											<span class="btn-bookmark">Добавить в закладки</span>
										</form>';
										
									echo '</div>';

								echo '</div>';
								
								echo '<div class="author-data">';
									echo '<p>Дата ' . $question['date'] . '</p>';
									echo '<p>Автор <a href="?author-question='.$question['login'].'.'.$question['user_id'].'">' . $question['login'] . '</a></p>';
								echo '</div>';
								
								
								
							echo '</div>';
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
					</script>
					
					<div class="user-comment">
						<p>Комментарии:</p>
						
				
						
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
								echo '<div class="comment clearfix">';
									echo '<div class="avatar-user-comment">';
										echo '<ul>';
											echo '<li><a href="?author-question='.$comment['login'].'.'.$comment['user_id'].'">'.$comment['login'].'</a></li>';
											echo '<li><img src="'.$comment['avatar'].'" width="100" height="100"></li>';
											echo '<li>Репутация <span class="user-status">'.$comment['reputation'].'</span></li>';
										echo '</ul>';
									echo '</div>';
									
									echo '<div class="user-text">';
										echo '<p>Комментарий №'.$countComment.' <span class="tochka">*</span>'.calendar($comment['date_add']).'</p>';
										echo '<p>'.htmlspecialchars($comment['text_comment'],ENT_QUOTES).'</p>';
									echo '</div>';
								echo '</div>';
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
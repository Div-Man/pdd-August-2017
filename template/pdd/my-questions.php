<?php
	if(empty($_SESSION['userPdd'])) {
		header('Location: ./index.php');
	}
?>

	<div class="all-city">
						<p>Мои вопросы</p>
					</div>
					<?php
						foreach($allQuestions as $question) {
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
										echo '<a href="?comments='.$question['id'].'">Перейти к коментариям ('.$question['countComment'].')</a>';
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
									echo '<p>Автор '.  $question['login'] . '</p>';
									
									echo '<p>
										<form method="post">
											<input type="hidden" name="idQuestion" value="'.$question['id'].'">
											<input type="hidden" name="token" value="'.$_SESSION['token'].'">
											<input type="hidden" name="idUser" value="'.$_SESSION['id'].'">
											
											<input class="deleteQuestion" type="submit" value="Удалить">
										</form>
									</p>';
								echo '</div>';
							echo '</div>';
					}
					?>
			
					<script>
					
					
					
					////////////////////////////
					
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
					
					
					var deleteQuestion = document.querySelectorAll('.deleteQuestion');
					//var btnBookmark = document.querySelectorAll('.btn-bookmark');
									
					deleteQuestion.forEach(function(element3, k){
						deleteQuestion[k].addEventListener('click', function(e) {
							e.preventDefault();
							var forma = e.target.parentElement;
							var idQuestion = forma.elements.idQuestion.value;
							var token = forma.elements.token.value;
							var idUser= forma.elements.idUser.value;
							var delElement = e.target.parentElement.closest('.main-question');

							
							xmlhttp=new XMLHttpRequest();
											
							xmlhttp.onreadystatechange=function() {
								if (this.readyState==4 && this.status==200) {
									delElement.innerHTML=this.responseText;
								}
							}
							
							xmlhttp.open("POST","./",true);
							xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
							xmlhttp.send("idQ="+idQuestion+"&t="+token+"&idU="+idUser);
							
											
						})				
					})
					

						
					</script>
				
					
				
					
					<div class="paginator">
					
					<?php
					
					
				
					
					
						if ($page != 1) $pervpage = '<a href= ./?my-questions='.$_GET['my-questions'].'&page=1>Первая</a>  
								   <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page - 1) .'><</a> ';  
						else {$pervpage = null;}
						// Проверяем нужны ли стрелки вперед  
						if ($page != $total) $nextpage = ' <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page + 1) .'>></a>  
														   <a href= ./?my-questions='.$_GET['my-questions'].'&page=' .$total. '>Последняя</a>';  
						else {$nextpage = null;}

						// Находим две ближайшие станицы с обоих краев, если они есть  
						if($page - 4 > 0) $page4left = ' <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';  
						else {$page4left = null;}
						
						if($page - 3 > 0) $page3left = ' <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';  
						else {$page3left = null;}
						
						if($page - 2 > 0) $page2left = ' <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
						else {$page2left = null;}
						
						if($page - 1 > 0) $page1left = '<a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
						else {$page1left = null;}
						
						
						if($page + 4 <= $total) $page4right = ' | <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page + 4) .'>'. ($page + 4) .'</a>'; 
						else {$page4right = null;}
						
						if($page + 3 <= $total) $page3right = ' | <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page + 3) .'>'. ($page + 3) .'</a>'; 
						else {$page3right = null;}
						
						if($page + 2 <= $total) $page2right = ' | <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
						else {$page2right = null;}
						
						if($page + 1 <= $total) $page1right = ' | <a href= ./?my-questions='.$_GET['my-questions'].'&page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 
						else {$page1right = null;}
						

						// Вывод меню  
						echo $pervpage.$page4left.$page3left.$page2left.$page1left.'<b class="page-green">'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$nextpage;  
						
					?>
					
						
						
					</div>
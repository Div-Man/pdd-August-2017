<?php 
$peremenayaForRadioName = 0;

?>
		<?php
			foreach($allQuestions as $question) {
		
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
						
							echo '<div class="comments">';
								echo '<a href="?comments='.$question['id'].'">'.$question['countComment'].' комментариев </a>';
							echo '</div>';
							
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
								echo '<div class="comments">';
									echo '<a href="?comments='.$question['id'].'">'.$question['countComment'].' комментариев </a>';
								echo '</div>';
								
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
				
					
				
					
			<div class="paginator">
					
					<?php
					
					
					
					
					
						if ($page != 1) $pervpage = '<a href= ./?all-city='.$_GET['all-city'].'&page=1>Первая</a>  
								   <a href= ./?all-city='.$_GET['all-city'].'page='. ($page - 1) .'><</a> ';  
						else {$pervpage = null;}
						// Проверяем нужны ли стрелки вперед  
						if ($page != $total) $nextpage = ' <a href= ./?all-city='.$_GET['all-city'].'&page='. ($page + 1) .'>></a>  
														   <a href= ./?all-city='.$_GET['all-city'].'&page=' .$total. '>Последняя</a>';  
						else {$nextpage = null;}

						// Находим две ближайшие станицы с обоих краев, если они есть  
						if($page - 4 > 0) $page4left = ' <a href= ./?all-city='.$_GET['all-city'].'&page='. ($page - 4) .'>'. ($page - 4) .'</a>';  
						else {$page4left = null;}
						
						if($page - 3 > 0) $page3left = ' <a href= ./?all-city='.$_GET['all-city'].'&page='. ($page - 3) .'>'. ($page - 3) .'</a>';  
						else {$page3left = null;}
						
						if($page - 2 > 0) $page2left = ' <a href= ./?all-city='.$_GET['all-city'].'&page='. ($page - 2) .'>'. ($page - 2) .'</a>';  
						else {$page2left = null;}
						
						if($page - 1 > 0) $page1left = '<a href= ./?all-city='.$_GET['all-city'].'&page='. ($page - 1) .'>'. ($page - 1) .'</a>';  
						else {$page1left = null;}
						
						
						if($page + 4 <= $total) $page4right = '<a href= ./?all-city='.$_GET['all-city'].'&page='. ($page + 4) .'>'. ($page + 4) .'</a>'; 
						else {$page4right = null;}
						
						if($page + 3 <= $total) $page3right = '<a href= ./?all-city='.$_GET['all-city'].'&page='. ($page + 3) .'>'. ($page + 3) .'</a>'; 
						else {$page3right = null;}
						
						if($page + 2 <= $total) $page2right = '<a href= ./?all-city='.$_GET['all-city'].'&page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
						else {$page2right = null;}
						
						if($page + 1 <= $total) $page1right = '<a href= ./?all-city='.$_GET['all-city'].'&page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 
						else {$page1right = null;}
						

						// Вывод меню  
						echo $pervpage.$page4left.$page3left.$page2left.$page1left.'<a class="pagActive" href="#">'.$page.'</a>'.$page1right.$page2right.$page3right.$page4right.$nextpage;  
						
					?>
					
						
						
					</div>
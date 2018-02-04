


		
		<?php
		
		echo '<p class="new-questions">Выбор города</p>
					<div class="choose-city">
						<div class="choose-description">
							<p>
								На этой странице, вы можете выбрать город или село, для того
								что бы отображались вопросы, нужного вам города или села.
							</p>
							<p class="bold">
								Расположение в алфавитном порядке.
							</p>';
							
						echo '</div>';
						
						echo '<div class="all-city clearfix">
							<div class="if-none-create-city">
								<p>
									Если нужного места нету,
									то вы можете его создать,
									добавив вопрос.
								</p>
								
								<div class="btn-add-question-choose-city">
									<a href="?action=add-question">Добавить</a>
								</div>
							</div>
							<div class="choose-city-street clearfix">
							';
		
		foreach($allCity as $city) {
					echo '<ul class="around-city ">';
						echo '<li><a href="" class="main-city">'.$city['city_name'].'</a><span class="city-id">'.$city['id'].'</span>';
							echo '<ul class="street street-none">';
							echo '</ul>';
						echo '</li>';
					echo '</ul>';
				
			}
			
			echo '</div>'
			
			
		?>
					
	
				<script>
					var city = document.querySelectorAll('.main-city');
					var street = document.querySelectorAll('.street');
					
					city.forEach(function(item, i) {
						city[i].addEventListener('click', function(e) {
						
						e.preventDefault();
							
							var cityId = e.target.nextElementSibling.innerHTML;
							
							xmlhttp=new XMLHttpRequest();
							
							xmlhttp.onreadystatechange=function() {
								if (this.readyState==4 && this.status==200) {
								  street[i].innerHTML=this.responseText;
								  e.target.nextElementSibling.nextElementSibling.classList.toggle('street-none');
									
								}
							  }
							  xmlhttp.open("GET","./?c="+cityId,true);
							  xmlhttp.send();
						})
					})
					
				</script>
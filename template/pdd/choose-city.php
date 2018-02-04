


		<div class="city">
		<?php
		
		echo '<p>
					На этой странице, вы можете выбрать город или село, для того<br>
					что бы отображались вопросы, нужного вам города или села. 
				</p>
				<p>
					Если нужного места нету, то вы можете его создать,
					добавив вопрос (ссылка в профиле).
				</p>';
		
		
			foreach($allCity as $city) {
					echo '<ul class="around-city">';
						echo '<li><span class="main-city">'.$city['city_name'].'</span><span class="city-id">'.$city['id'].'</span>';
							echo '<ul class="street street-none">';
							echo '</ul>';
						echo '</li>';
					echo '</ul>';
				
			}
			
		?>
					
				</div>
				
				<script>
					var city = document.querySelectorAll('.main-city');
					var street = document.querySelectorAll('.street');
					
					city.forEach(function(item, i) {
						city[i].addEventListener('click', function(e) {
							
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
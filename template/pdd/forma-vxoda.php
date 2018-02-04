<!--

<p>Вход на сайт</p>
	<form method="POST">
		<div><label><span>Логин</span><input class="login" name="login" type="text"></label></div>
		<div><label><span>Пароль</span><input class="password" name="password" type="password"></label></div>
							
		<label>Запомнить пароль <input type="checkbox" name="rememberPass" value="0"></label>
		
		<input type="submit" class="auth" name="auth" value="Войти">
	</form>
	
	<div id="wrongLogin"></div>
						
<div class="registr"><a href="?action=registr">Или зарегистрируйтесь</div>

<script>
	var auth = document.querySelector('.auth');
		auth.addEventListener('click', function(e) {
			e.preventDefault();
			var forma = e.target.parentElement;
			var login = forma.elements.login.value;
			var pass = forma.elements.password.value;
			var rememberPassword = forma.elements.rememberPass;
			var rem = 0;
			
			if(rememberPassword.checked == true) {
				rem = 1;
			}
			
			console.log(rem);
			xmlhttp=new XMLHttpRequest();
											
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					
					if(this.responseText == true) {
						window.location.reload();
					}
					else {
						wrongLogin.innerHTML=this.responseText;
					}
				}
			}
							
				xmlhttp.open("POST","./",true);
				xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
				xmlhttp.send("log="+login+"&password="+pass+"&remember="+rem);				
			})				
					
					
</script>
-->
	<div class="vxod">
					<p class="title-vxod">Вход на сайт</p>
					
					<div class="for-ramki hide-for-planshet">
						<form method="POST" class="clearfix forma-for-planshet">
							<div class="clearfix wrapper-for-login">
								<p class="login"><span></span><input type="text" placeholder="Логин" name="login"></p>
								<p class="password"><span></span><input type="password" placeholder="Пароль" name="password"></p>
						
							</div>
							<div class="btn-and-zapomnit clearfix">
								<input class="btn-vxod auth" type="submit" value="войти" name="auth">
			
								<label class="zapomnit">
									<input id="my_check" type="checkbox" name="rememberPass" value="0">
									<label for="my_check"><span>Запомнить</span></label>
								</label>
							</div>
						</form>
						
						<div id="wrongLogin"></div>
					
						<div class="reg">
							<p>
								В первый раз на сайте?
							</p>
							<a href="#">Регистрация</a>
						</div>
					</div>
				
				</div>
				
				<script>
	var auth = document.querySelector('.auth');
		auth.addEventListener('click', function(e) {
			e.preventDefault();
			var forma = e.target.parentElement.parentElement;
			var login = forma.elements.login.value;
			var pass = forma.elements.password.value;
			var rememberPassword = forma.elements.rememberPass;
			var rem = 0;
			
			
			if(rememberPassword.checked == true) {
				rem = 1;
			}
			
			console.log(rem);
			
			xmlhttp=new XMLHttpRequest();
											
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					
					if(this.responseText == true) {
						window.location.reload();
					}
					else {
						wrongLogin.innerHTML=this.responseText;
					}
				}
			}
							
				xmlhttp.open("POST","./",true);
				xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
				xmlhttp.send("log="+login+"&password="+pass+"&remember="+rem);		
				
			})				
					
					
</script>
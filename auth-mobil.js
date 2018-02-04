<script>
			var auth2 = document.querySelector('.auth2');
			auth2.addEventListener('click', function(e) {
			e.preventDefault();
			var forma = e.target.parentElement.parentElement;
			
	
			var login = forma.firstElementChild.firstElementChild.lastElementChild.value;
			var pass = forma.firstElementChild.lastElementChild.lastElementChild.value;
			var rememberPassword = forma.elements.rememberPass;
			var rem = 0;
			
			
			if(rememberPassword.checked == true) {
				rem = 1;
			}
			
			
			xmlhttp=new XMLHttpRequest();
											
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					
					if(this.responseText == true) {
						window.location.reload();
					}
					else {
						wrongLogin2.innerHTML=this.responseText;
					}
				}
			}
							
				xmlhttp.open("POST","./",true);
				xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
				xmlhttp.send("log="+login+"&password="+pass+"&remember="+rem);		
				
			})		
			
		</script>
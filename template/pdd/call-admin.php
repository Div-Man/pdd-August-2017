<?php
	if(!empty($_POST['callAdmin'])) {
		echo 1111;
	}
?>



<p class="new-questions">Связаться с администрацией</p>
				<div class="feedback">
					<p>
						На этой странице, вы можете нам, задать любой вопрос
					</p>
				</div>
				
				<div class="message-adminy clearfix">
					<form method="post">
						<div class="name-email">
							<div class="feedback-name clearfix">
								<div class="ico-feedback-name"><img src="img/author.png"></div>
								<input type="text" placeholder="Имя" name="callName">
							</div>
							
							<div class="feedback-name clearfix">
								<div class="ico-feedback-name"><img src="img/pon.png"></div>
								<input type="text" placeholder="E-mail" name="callEmail">
							</div>
							<input type="submit" name="callAdmin" value="Отправить" class="btn-add-comment btn-call-admin">
						</div>
						
						<div class="message-input">
							<textarea name="messageForAdmin"></textarea>
							<input type="submit" name="callAdmin" value="Отправить" class="btn-add-feedback btn-comment-for-mobil">
						</div>
					</form>
				</div>
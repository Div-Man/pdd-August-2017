
	<p class="title-vxod">Последние комментарии</p>
			<div class="for-ramki clearfix">
					
			<?php
				foreach($lastComment as $lastCom) {
					
					$dataAddComment = explode('.', $lastCom['date_add']);
					$dataRes = $dataAddComment[0] . '.' . $dataAddComment[1] . '.' . $dataAddComment[2];
					
					$text = mb_substr($lastCom['text_comment'],0,200, 'UTF-8') . '...';

					echo '
						<div class="com">
							<div class="ava-and-name-and-data-and-rep clearfix">
								<div class="ava">
									<img src="'.$lastCom['avatar'].'" width="80">
								</div>
								<div class="name-and-data-and-rep">
									<div class="name-and-data">
										<div class="name-comment">'.$lastCom['login'].'</div>
										<div class="data-comment">'.$dataRes.'</div>
									</div>
									<div class="name-rep">Репутация: '.$lastCom['reputation'].'</div>
								</div>
							</div>
							<div class="description-comment clearfix">
								<p>
									'.htmlspecialchars($text).'
								</p>
								<a href="?comments='.$lastCom['questions_id'].'">перейти к комментарию</a>
							</div>
						</div>
						';
				}
					?>
					
			</div>
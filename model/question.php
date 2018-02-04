<?php

class Question {
	private $db = null;
	function __construct ($db) {
		$this->db = $db;
	}
	
	function showQuestion($user_id = null, $allCity = null) {
		$num = 2;
		
		if(!empty($_GET['page'])) {
			$page = $_GET['page'];
			$page = intval($page);
			
		}
		else {
			$page = 1;
			$page = intval($page);
		}
		$start = $page * $num - $num;
		
		if(!empty($_GET['my-questions'])) {
			$sql = "SELECT COUNT(*) as countQuestion FROM questions WHERE questions.user_id = '".$user_id."'";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name, 
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name,
			COUNT(comments.questions_id) as countComment 
			FROM questions 
			INNER JOIN users ON questions.user_id = '".$user_id."' AND questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id 
			INNER JOIN street ON questions.street_id = street.id 
			LEFT JOIN comments ON comments.questions_id = questions.id
			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
		}
		
		elseif(!empty($_GET['show-question-user'])) {
			$sql = "SELECT COUNT(*) as countQuestion FROM questions WHERE questions.user_id = '".$user_id."'";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name, 
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name,
			COUNT(comments.questions_id) as countComment 			
			FROM questions 
			INNER JOIN users ON questions.user_id = '".$user_id."' AND questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id 
			INNER JOIN street ON questions.street_id = street.id 
			LEFT JOIN comments ON comments.questions_id = questions.id 
			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
		}
		
		
		elseif(!empty($_GET['my-bookmark']) && !empty($_SESSION['userPdd'])) {
			$sql = "SELECT COUNT(*) as countQuestion FROM bookmark WHERE user_id = '".$user_id."'";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name,
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name,
			COUNT(comments.questions_id) as countComment 
			FROM questions 
			INNER JOIN users ON questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id
			INNER JOIN street ON questions.street_id = street.id 
			INNER JOIN bookmark ON bookmark.user_id = '".$user_id."' AND bookmark.question_id = questions.id
			LEFT JOIN comments ON comments.questions_id = questions.id 
			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
		}
		
		elseif(!empty($_GET['all-city'])) {
			$sql = "SELECT COUNT(*) as countQuestion FROM questions WHERE questions.city_id = '".$allCity."'";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name, 
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name,
			COUNT(comments.questions_id) as countComment 
			FROM questions 
			INNER JOIN users ON questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id AND questions.city_id = '".$allCity."' 
			INNER JOIN street ON questions.street_id = street.id 
			LEFT JOIN comments ON comments.questions_id = questions.id 
			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
			
		}
		
		elseif(!empty($_GET['city'])) {
			$sql = "SELECT COUNT(*) as countQuestion FROM questions WHERE questions.street_id = '".$user_id."'";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name, 
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name,
			COUNT(comments.questions_id) as countComment 
			FROM questions 
			INNER JOIN users ON questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id 
			INNER JOIN street ON questions.street_id = street.id AND questions.street_id = '".$user_id."' 
			LEFT JOIN comments ON comments.questions_id = questions.id 
			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
		}
		
		
		else {
			$sql = "SELECT COUNT(*) as countQuestion FROM questions";
			
			$sql2 = "SELECT 
			questions.id, 
			questions.question_name, 
			questions.answer, 
			questions.variant1, 
			questions.variant2, 
			questions.variant3, 
			questions.variant4, 
			questions.user_id, 
			questions.city_id, 
			questions.street_id, 
			questions.date, 
			questions.img, 
			users.login, 
			city.city_name, 
			street.street_name, 
			COUNT(comments.questions_id) as countComment 

			FROM questions 
			INNER JOIN users ON questions.user_id = users.id 
			INNER JOIN city ON questions.city_id = city.id 
			INNER JOIN street ON questions.street_id = street.id 
			LEFT JOIN comments ON comments.questions_id = questions.id 

			GROUP BY questions.id ORDER BY questions.id DESC LIMIT " . $start .', ' . $num;
		}
		
		
		
		
		$query = $this->db->query($sql);
		
		$posts = $query->fetchAll()[0]['countQuestion'];
		
		$total = intval(($posts - 1) / $num) + 1; 
		
		
		
		if(empty($page) or $page < 0) $page = 1;  
		if($page > $total) $page = $total; 
		
		
		$query = $this->db->query($sql2); 
		return array($query, $page, $total);

		
	}
	
	
	
	function getCity(){
		$sql = "SELECT `id`, `city_name` FROM city ORDER BY `city_name`";
		$query = $this->db->query($sql);
		return $query->fetchAll();
	}
	
	function getStreet(){
		$sql = "SELECT `id`, `street_name` FROM street ORDER BY `street_name`";
		$query = $this->db->query($sql);
		return $query->fetchAll();
	}
	
	function loadImg($img) {
		$date = date('Y-m-d-H-i-s');

		try {
			if(!$userPath = @mkdir('./userFile/'.$_SESSION['userPdd'].'/question/' . $date . '/'  , 0700, true)) {
				throw new Exception('Ошибка.');
			}
		} 
		catch (Exception $e) {
			die('<p>Произошла ошибка, при загрузке изображения, повторите попытку или сообщите администратору.</p>');
		}
				
		try {
			$newPath = './userFile/' . $_SESSION['userPdd'] . '/question/' . $date . '/' . basename($img['name']);
							
			if(move_uploaded_file($img['tmp_name'], $newPath)) {
			}
		}
		catch (Exception $e) {
			die('<p>Произошла неизвестная ошибка, повторите попытку или сообщите администратору.</p>');
		}
	}
	
	function chooseCity($q) {
		$sql="SELECT * FROM street WHERE city_id = :q ORDER BY `street_name`";
		$result = $this->db->prepare($sql);
		$result->bindValue(':q', $q, PDO::PARAM_INT);
		$result->execute();
		$row = $result->fetchAll();

		echo '<option value="0" selected>-</option>';
			foreach($row as $street) {
				echo '<option value="'.$street['id'].'">'.$street['street_name'].'</option>';
				
			}
	}
	
	/////////////////////
	
	function addQuestionInCity($img, $question, $var1, $var2, $var3, $var4, $answer, $chooseCity, $chooseStreet) {
		if($img['type'] == 'image/jpeg' || $img['type'] == 'image/png') {
			$date = date('Y-m-d-H-i-s');
			$dateForQuestion = date('d.m.Y');
			$questionImg = "./userFile/".$_SESSION['userPdd']. "/question/" . $date . "/" . basename($img['name']);
			
		}
		
		else {
			die('<p>Загрузите изображение, в формате jpeg или png</p>');
		}
		
		try {
			$this->loadImg($img);
			$sqlUser = "SELECT DISTINCT users.id, users.folder, users.reputation FROM users WHERE users.id = '".$_SESSION['id']."'";
			$queryUser = $this->db->query($sqlUser);
			$userArray = $queryUser->fetchAll();
		}
		catch (Exception $e) {
			die('<p>Произошла неизвестная ошибка, повторите попытку или сообщите администратору.</p>');
		}
	
		
		try {
			$sqlSearchCity = "SELECT `city_name`, `id` FROM city WHERE `id` = :chooseCity";
			$searchCity = $this->db->prepare($sqlSearchCity);
			$searchCity->bindValue(':chooseCity', trim($chooseCity), PDO::PARAM_INT);
			$searchCity->execute();
			
			$res = $searchCity->fetchAll();
			
			$sqlSearchStreet = "SELECT `id`, `city_id` FROM street WHERE `id` = :chooseStreet";
			$searchStreet = $this->db->prepare($sqlSearchStreet);
			$searchStreet->bindValue(':chooseStreet', trim($chooseStreet), PDO::PARAM_INT);
			$searchStreet->execute();
			
			$resStreet = $searchStreet->fetchAll();
		}
		catch (Exception $e) {
			die('<p>Произошла неизвестная ошибка, повторите попытку или сообщите администратору.</p>');
		}
		
		try {
			$sqlNewQuestion = "INSERT questions (`question_name`, `answer`, `variant1`, `variant2`, `variant3`, `variant4`,`user_id`, `city_id`, `street_id`, `date`, `img` ) VALUES (:question, :answer, :var1, :var2, :var3, :var4, :user_id, :city_id, :street_id, '".$dateForQuestion."', '".$questionImg."')";
						
			$newQystionPrepare = $this->db->prepare($sqlNewQuestion);
			$newQystionPrepare->bindValue(':question', trim($question), PDO::PARAM_STR);
			$newQystionPrepare->bindValue(':answer', trim($answer), PDO::PARAM_INT);
			$newQystionPrepare->bindValue(':var1', trim($var1), PDO::PARAM_STR);
			$newQystionPrepare->bindValue(':var2', trim($var2), PDO::PARAM_STR);
			$newQystionPrepare->bindValue(':var3', trim($var3), PDO::PARAM_STR);
			$newQystionPrepare->bindValue(':var4', trim($var4), PDO::PARAM_STR);
			$newQystionPrepare->bindValue(':user_id', trim($userArray[0]['id']), PDO::PARAM_INT);
			$newQystionPrepare->bindValue(':city_id', trim($res[0]['id']), PDO::PARAM_INT);
			$newQystionPrepare->bindValue(':street_id', trim($resStreet[0]['id']), PDO::PARAM_INT);
			$newQystionPrepare->execute();
			
			$oldRep = $userArray[0]['reputation'];
			$newRep = $oldRep+1;
			
			$reputationUser = 'UPDATE users SET reputation = ' . $newRep . ' WHERE id = ' . $userArray[0]['id'];
			$this->db->query($reputationUser);
			
			$oldSesRep = $_SESSION['reputation'];
			$newSesRep = $oldSesRep + 1;
			$_SESSION['reputation'] = $newSesRep;
			
			header('Location: /?my-questions='.$_SESSION['userPdd']);
		}
		catch(PDOException $e){
			die('<p>Произошла ошибка, при создании вопроса, повторите попытку или обратитесь к администратору.</p>');
		}
		
	}
		
	function addQuestionCreateCity($img, $question, $var1, $var2, $var3, $var4, $answer, $newCity, $newStreet) {
		if($img['type'] == 'image/jpeg') {
			$date = date('d.m.Y');
		}
				
		else {
			die('<p>Загрузите изображение, в формате jpeg</p>');
		}
		
		try {
			$sqlUser = "SELECT users.id, users.folder, users.reputation FROM users WHERE users.id = '".$_SESSION['id']."'";
			$queryUser = $this->db->query($sqlUser);
			$userArray = $queryUser->fetchAll();
		}
		catch (Exception $e) {
			die('<p>Произошла неизвестная ошибка, повторите попытку или сообщите администратору.</p>');
		}
	
	
	
	
	try {
		$sqlSearchCity = "SELECT `city_name`, `id` FROM city WHERE `city_name` = :newCity";
		$searchCity = $this->db->prepare($sqlSearchCity);
		$searchCity->bindValue(':newCity', trim($newCity), PDO::PARAM_STR);
		$searchCity->execute();
		
		$res = $searchCity->fetchAll();
		
		if(count($res) > 0) { //если город уже есть
			$sqlSearchStreet = "SELECT `id`, `city_id` FROM street WHERE `street_name` = :newStreet";
			$searchStreet = $this->db->prepare($sqlSearchStreet);
			$searchStreet->bindValue(':newStreet', trim($newStreet), PDO::PARAM_STR);
			$searchStreet->execute();
			
			$resStreet = $searchStreet->fetchAll();
			
			if(count($resStreet) > 0) { //если улица уже есть
				echo '<p>Вы создаёте улицу, которая уже есть, выберите её из списка</p>';
			}
			
			else {
				try {
					$sqlNewStreet = "INSERT street (street_name, city_id) VALUES (:street, :id_city)";
					$newStreetPrepare = $this->db->prepare($sqlNewStreet);
					$newStreetPrepare->bindValue(':street', trim($newStreet), PDO::PARAM_STR);
					$newStreetPrepare->bindValue(':id_city', trim($res[0]['id']), PDO::PARAM_INT);
					$newStreetPrepare->execute();
				}
		
				catch(PDOException $e){
					die('<p>Произошла ошибка, при создании улицы, повторите попытку или обратитесь к администратору.</p>');
				}
				
				$sqlSearchStreet = "SELECT `id`, `city_id` FROM street WHERE `street_name` = :newStreet";
				$searchStreet = $this->db->prepare($sqlSearchStreet);
				$searchStreet->bindValue(':newStreet', trim($newStreet), PDO::PARAM_STR);
				$searchStreet->execute();
				
				$resStreet = $searchStreet->fetchAll();
			
				$questionImg = "./userFile/".$_SESSION['userPdd']. "/question/" . $date . "/" . basename($img['name']);
				
				$this->loadImg($img);
			
				try {
					$sqlNewQuestion = "INSERT questions (`question_name`, `answer`, `variant1`, `variant2`, `variant3`, `variant4`,`user_id`, `city_id`, `street_id`, `date`, `img` ) VALUES (:question, :answer, :var1, :var2, :var3, :var4, :user_id, :city_id, :street_id, '".$date."', '".$questionImg."')";
						
					$newQystionPrepare = $this->db->prepare($sqlNewQuestion);
					$newQystionPrepare->bindValue(':question', trim($question), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':answer', trim($answer), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':var1', trim($var1), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var2', trim($var2), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var3', trim($var3), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var4', trim($var4), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':user_id', trim($userArray[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':city_id', trim($res[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':street_id', trim($resStreet[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->execute();
					
					$oldRep = $userArray[0]['reputation'];
					
					$newRep = $oldRep+1;
					
					$reputationUser = 'UPDATE users SET reputation = ' . $newRep . ' WHERE id = ' . $userArray[0]['id'];
					$this->db->query($reputationUser);
					
					$oldSesRep = $_SESSION['reputation'];
					$newSesRep = $oldSesRep + 1;
					$_SESSION['reputation'] = $newSesRep;
					
					header('Location: /?my-questions='.$_SESSION['userPdd']);
				}
		
				catch(PDOException $e){
					die('<p>Произошла ошибка, при создании вопроса, повторите попытку или обратитесь к администратору.</p>');
				}
			}
			
		}
		else {
			try {
				$sqlNewCity = "INSERT city (city_name) VALUES (:city)";
				$newCityPrepare = $this->db->prepare($sqlNewCity);
				$newCityPrepare->bindValue(':city', trim($newCity), PDO::PARAM_STR);
				$newCityPrepare->execute();
			}
		
			catch(PDOException $e){
				die('<p>Произошла ошибка, при создании города, повторите попытку или обратитесь к администратору.</p>');
			}
			
			try {
			
				$sqlSearchCity = "SELECT `city_name`, `id` FROM city WHERE `city_name` = :newCity";
				$searchCity = $this->db->prepare($sqlSearchCity);
				$searchCity->bindValue(':newCity', trim($newCity), PDO::PARAM_STR);
				$searchCity->execute();
				
				$res = $searchCity->fetchAll();
				
			
				$sqlNewStreet = "INSERT street (street_name, city_id) VALUES (:street, :id_city)";
				$newStreetPrepare = $this->db->prepare($sqlNewStreet);
				$newStreetPrepare->bindValue(':street', trim($newStreet), PDO::PARAM_STR);
				$newStreetPrepare->bindValue(':id_city', trim($res[0]['id']), PDO::PARAM_INT);
				$newStreetPrepare->execute();
				
			}
		
			catch(PDOException $e){
				die('<p>Произошла ошибка, при создании улицы, повторите попытку или обратитесь к администратору.</p>');
			}
			
			$sqlSearchStreet = "SELECT `id`, `city_id` FROM street WHERE `street_name` = :newStreet";
			$searchStreet = $this->db->prepare($sqlSearchStreet);
			$searchStreet->bindValue(':newStreet', trim($newStreet), PDO::PARAM_STR);
			$searchStreet->execute();
			
			$resStreet = $searchStreet->fetchAll();
			
			
			$questionImg = "/userFile/".$_SESSION['userPdd']. "/question/" . $date . "/" . basename($img['name']);
			
			$this->loadImg($img);
			
			try {
					$sqlNewQuestion = "INSERT questions (`question_name`, `answer`, `variant1`, `variant2`, `variant3`, `variant4`,`user_id`, `city_id`, `street_id`, `date`, `img` ) VALUES (:question, :answer, :var1, :var2, :var3, :var4, :user_id, :city_id, :street_id, '".$date."', '".$questionImg."')";
					
					$newQystionPrepare = $this->db->prepare($sqlNewQuestion);
					$newQystionPrepare->bindValue(':question', trim($question), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':answer', trim($answer), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':var1', trim($var1), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var2', trim($var2), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var3', trim($var3), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':var4', trim($var4), PDO::PARAM_STR);
					$newQystionPrepare->bindValue(':user_id', trim($userArray[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':city_id', trim($res[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->bindValue(':street_id', trim($resStreet[0]['id']), PDO::PARAM_INT);
					$newQystionPrepare->execute();
					
					$oldRep = $userArray[0]['reputation'];
					
					$newRep = $oldRep+1;
					
					$reputationUser = 'UPDATE users SET reputation = ' . $newRep . ' WHERE id = ' . $userArray[0]['id'];
					$this->db->query($reputationUser);
					
					$oldSesRep = $_SESSION['reputation'];
					$newSesRep = $oldSesRep + 1;
					$_SESSION['reputation'] = $newSesRep;
					
					header('Location: /?my-questions='.$_SESSION['userPdd']);
					
				
			}
		
			catch(PDOException $e){
				die('<p>Произошла ошибка, при создании вопроса, повторите попытку или обратитесь к администратору.</p>');
			}
			
		}
		
	}
	catch(PDOException $e){
		die('<p>Произошла ошибка, при создании города, повторите попытку или обратитесь к администратору.</p>');
	}
	
	}
	
	
	function redactQuestion($idQuestion, $token, $idUser) {
		$sql = "SELECT questions.id, questions.question_name, questions.answer, questions.variant1, questions.variant2, questions.variant3, questions.variant4, questions.user_id, questions.city_id, questions.street_id, questions.date, questions.img, users.login, city.city_name, street.street_name FROM questions INNER JOIN users INNER JOIN city INNER JOIN street ON questions.user_id = :userId AND questions.id = :qId AND users.token = :token AND questions.city_id = city.id AND questions.street_id = street.id GROUP BY questions.question_name ORDER BY `date` DESC";
		
		$showQuestion = $this->db->prepare($sql);
		$showQuestion->bindValue(':userId', trim($idUser), PDO::PARAM_INT);
		$showQuestion->bindValue(':qId', trim($idQuestion), PDO::PARAM_INT);
		$showQuestion->bindValue(':token', trim($token), PDO::PARAM_STR);
		
		$showQuestion->execute();
			
		$resQuestion = $showQuestion->fetchAll();
		
		if(count($resQuestion) == 0) {
			header("Location: /");
		}
		
		else {
			return $resQuestion;
		}
		
	}
	
	function findAnswer($q, $a) {
		$sql = "SELECT `answer` FROM questions WHERE id = :id";
		$checkAnswerPreapre = $this->db->prepare($sql);
		$checkAnswerPreapre->bindValue(':id', trim($q), PDO::PARAM_INT);
		$checkAnswerPreapre->execute();
		$resultAnswer = $checkAnswerPreapre->fetchAll();
				
		$res = $resultAnswer[0]['answer'];
				
		if($res == $a) {
			echo '<p>Правильно</p>';
		}
		else {
			echo '<p>Не правильно</p>';
		}
		die();

	}
	
	function deleteQuestion($idQuestion, $token, $idUser) {
		$sql = "SELECT questions.id, questions.question_name, questions.user_id, questions.img FROM questions INNER JOIN users ON questions.user_id = :userId AND questions.id = :qId AND users.token = :token GROUP BY questions.question_name ORDER BY `date` DESC";
		
		$showQuestion = $this->db->prepare($sql);
		$showQuestion->bindValue(':userId', trim($idUser), PDO::PARAM_INT);
		$showQuestion->bindValue(':qId', trim($idQuestion), PDO::PARAM_INT);
		$showQuestion->bindValue(':token', trim($token), PDO::PARAM_STR);
		
		$showQuestion->execute();
			
		$resQuestion = $showQuestion->fetchAll();
		
		if(count($resQuestion) == 0) {
			echo 'Ошибка удаления';
			
		}
		
		else {
			$folder = $resQuestion[0]['img'];
			$arrFolder = explode("/", $folder);
			$delFolder = $arrFolder[0].'/'.$arrFolder[1].'/'.$arrFolder[2].'/'.$arrFolder[3].'/'.$arrFolder[4];
			
		
			function removeDirectory($dir) {
				if ($objs = glob($dir."/*")) {
				   foreach($objs as $obj) {
					 is_dir($obj) ? removeDirectory($obj) : unlink($obj);
				   }
				}
				rmdir($dir);
			}
			
			removeDirectory($delFolder);
		
		
			$sqlUser = "SELECT users.id, users.folder, users.reputation FROM users WHERE users.id = '".(int)$idUser."'";
			$queryUser = $this->db->query($sqlUser);
			$userArray = $queryUser->fetchAll();
			
			$sql2 = "DELETE FROM questions WHERE user_id = :userId AND id = :qId ";
			$deleteQuestion = $this->db->prepare($sql2);
			$deleteQuestion->bindValue(':userId', trim($idUser), PDO::PARAM_INT);
			$deleteQuestion->bindValue(':qId', trim($idQuestion), PDO::PARAM_INT);
			$deleteQuestion->execute();
			
			$sqlDelComment = "DELETE FROM comments WHERE questions_id = :qId";
			$deleteComment = $this->db->prepare($sqlDelComment);
			$deleteComment->bindValue(':qId', trim($idQuestion), PDO::PARAM_INT);
			$deleteComment->execute();
			
			$sqlDelFromBookmark = "DELETE FROM bookmark WHERE question_id = :qId";
			$deleteBookmark = $this->db->prepare($sqlDelFromBookmark);
			$deleteBookmark->bindValue(':qId', trim($idQuestion), PDO::PARAM_INT);
			$deleteBookmark->execute();
			
			$oldRep = $userArray[0]['reputation'];
			$newRep = $oldRep-1;
			
			$reputationUser = 'UPDATE users SET reputation = ' . $newRep . ' WHERE id = ' . $userArray[0]['id'];
			$this->db->query($reputationUser);
			
			$oldSesRep = $_SESSION['reputation'];
			$newSesRep = $oldSesRep - 1;
			$_SESSION['reputation'] = $newSesRep;
		
			echo 'Удалено';
		}
	}
	
	
	function userComments($idQuestion) {
		$sql = "SELECT 
		questions.id, 
		questions.question_name, 
		questions.answer, 
		questions.variant1, 
		questions.variant2, 
		questions.variant3, 
		questions.variant4, 
		questions.user_id, 
		questions.city_id, 
		questions.street_id, 
		questions.date, 
		questions.img, 
		users.login, 
		city.city_name, 
		street.street_name 
		FROM questions 
		INNER JOIN users ON questions.user_id = users.id  
		INNER JOIN city ON questions.city_id = city.id
		INNER JOIN street ON questions.street_id = street.id
		AND questions.id = ".$idQuestion." 
		GROUP BY questions.question_name";
		$query = $this->db->query($sql);
		return $query->fetchAll();
		
	}
	function showUserComments($idQuestion){
		$sql = "SELECT users.login, comments.text_comment, comments.user_id, comments.date_add, users.avatar, users.reputation FROM users INNER JOIN comments ON comments.questions_id = '".$idQuestion."' AND comments.user_id = users.id GROUP BY text_comment ORDER BY comments.id";
		$query = $this->db->query($sql);
		return $query->fetchAll();
		
	}
	
	function getLastComment() {
		$sql = "SELECT users.login, users.reputation, users.avatar, comments.date_add, comments.text_comment, comments.questions_id FROM users LEFT JOIN comments ON comments.user_id = users.id ORDER BY comments.id DESC LIMIT 2";
		$query = $this->db->query($sql);
		return $query->fetchAll();
		
	}
	
	function userProfil($login) {
		$userName = explode('.', $login)[0];
		$userId = explode('.', $login)[1];
		
		$sql ="SELECT users.login, users.avatar, users.link_vk, data_reg, COUNT(*) AS `count` FROM users INNER JOIN `questions` WHERE questions.user_id = ".$userId." AND questions.user_id = users.id";
		
		$query = $this->db->query($sql);
		return $query->fetchAll();
	}
	
	function addUserComment($comment, $user, $idQuestion) {
		$date = date('d.m.Y.g.16');
		
		$findUserId = "SELECT id FROM users WHERE login='".$user."'";
		$query = $this->db->query($findUserId);
		$userId = $query->fetchAll()[0]['id'];
		
		$sql = "INSERT INTO comments(`text_comment`, `user_id`, `questions_id`, `date_add`) 
									VALUES(:text, '".$userId."', '".$idQuestion."', '".$date."')";
		$newComment = $this->db->prepare($sql);							
		
		$newComment->bindValue(':text', trim($comment), PDO::PARAM_STR);
		
		$newComment->execute();
		
		header("Location: /?comments=".$_GET['comments']);
	}
	
	function addBookmark($user_id, $question_id, $token) {
		
		if($user_id == 0) {
			die('Авторизируйтесь');
		}

		else {
			$sqlFindBookMark = "SELECT user_id, question_id FROM bookmark WHERE question_id = '".$question_id."' AND user_id = '".$user_id."' LIMIT 1";
			
			$findBookMark = $this->db->query($sqlFindBookMark);
			$res = $findBookMark->fetchAll();
			
			if(count($res) > 0) {
				echo 'Вы уже добавляли';
			}
			
			else {
				$sql = "INSERT INTO bookmark(`user_id`, `question_id`) VALUES(:userId, :questionId)";
				$bookmark = $this->db->prepare($sql);
				$bookmark->bindValue(':userId', trim($user_id), PDO::PARAM_INT);
				$bookmark->bindValue(':questionId', trim($question_id), PDO::PARAM_INT);
				$bookmark->execute();
				
				echo 'Добавлено';
			}
		}
		
	}
	
	function deleteBookmark($u, $q, $token) {
		$needBookmark = "SELECT bookmark.id FROM bookmark INNER JOIN users ON users.id = :user AND bookmark.user_id = :user AND bookmark.question_id = :qId AND users.token = :tok";
		
		$bookmark = $this->db->prepare($needBookmark);
		$bookmark->bindValue(':user', trim($u), PDO::PARAM_INT);
		$bookmark->bindValue(':qId', trim($q), PDO::PARAM_INT);
		$bookmark->bindValue(':tok', trim($token), PDO::PARAM_STR);
		$bookmark->execute();
		$res = $bookmark->fetchAll();
		
		if(count($res) == 0) {
			die('Ошибка удаления');
		}
		
		else {
			$sql = "DELETE FROM bookmark WHERE user_id = :userId AND question_id = :questionId";
			$delBookmark = $this->db->prepare($sql);
			$delBookmark->bindValue(':userId', trim($u), PDO::PARAM_INT);
			$delBookmark->bindValue(':questionId', trim($q), PDO::PARAM_INT);
			
			$delBookmark->execute();
			
			echo 'Удалено';
		}
		
	}
	
	function allCity() {
		$sql = "SELECT `id`, `city_name` FROM city";
		$query = $this->db->query($sql);
		return $query->fetchAll();
		
	}
	
	function allStreet($id) {
		$sql = "SELECT `id`, `street_name` FROM street WHERE city_id ='".$id."'";
		$query = $this->db->query($sql);
		$res = $query->fetchAll();
		
		echo '<li><a href="?all-city='.$id.'">Всё подряд</a></li>';
		
		foreach($res as $street) {
			echo '<li><a href="?city='.$street['id'].'">'.$street['street_name'].'</a></li>';
		}
	}
}
<?php

class QuestionController {
	private $model = null;
	
	function __construct ($db) {
		include 'model/question.php';
		$this->model = new Question($db);
	}
	
	private function render($template = null, $params = null) {
		$fileTemplate = 'template/'.$template;
		if (is_file($fileTemplate)) {
			ob_start();
			if (count($params) > 0) {
				extract($params);
			}
			include $fileTemplate;
			return ob_get_clean();
		}
	}
	

	function getMainPage() {
		$city = $this->model->getCity();
		
		if(!empty($_GET['show-question-user'])) {
			$allQuestions = $this->model->showQuestion($_GET['show-question-user'] );
		}
		
		elseif(!empty($_GET['my-questions']) && !empty($_SESSION['userPdd'])) {
			$allQuestions = $this->model->showQuestion($_SESSION['id'] );
		}
		
		elseif(!empty($_GET['my-bookmark']) && !empty($_SESSION['userPdd'])) {
			$allQuestions = $this->model->showQuestion($_SESSION['id'] );
		}
		
		elseif(!empty($_GET['all-city'])) {
			$allQuestions = $this->model->showQuestion(null, $_GET['all-city']);
		}
		
		elseif(!empty($_GET['city'])) {
			$allQuestions = $this->model->showQuestion($_GET['city']);
		}
		
		else {
			$allQuestions = $this->model->showQuestion(); //по умолчанию
		}
		
		
		
		if(!empty($_GET['q']) && !empty($_GET['a'])) {
			$answer = $this->model->findAnswer($_GET['q'], $_GET['a']);
		}
		else {
			$answer = null;
		}
		
		if(!empty($_GET['comments'])) {
		
			$needCom = $this->model->commmmm((int)$_GET['comments']);
			
			
			$comment = $this->model->userComments((int)$_GET['comments']);
			$userComment = $this->model->showUserComments((int)$_GET['comments']);
		}
		else {
			$comment = null;
			$userComment = null;
		}
		
		if(!empty($_GET['choose-city'])) {
			$allCity = $this->model->allCity();
		}
		
		else {
			$allCity = null;
		}
		
		if(!empty($_GET['c'])) {
			$allStreet = $this->model->allStreet($_GET['c']);
			die();
		}
		
		else {
			$allStreet = null;
		}
		
		if(!empty($_GET['q'])) {
			$addStreet = $this->model->chooseCity($_GET['q']);
			
		}
		else {
			$addStreet = null;
		}
		
		
		if(!empty($_GET['author-question'])) {
			$showUserProfil = $this->model->userProfil($_GET['author-question']);
		}
		
		else {
			$showUserProfil = null;
		}
		
		$lastComment = $this->model->getLastComment();
		
		
		
		echo $this->render('pdd/main.php', ['city' => $city, 
											'allQuestions' => $allQuestions[0],
											'page' => $allQuestions[1], 
											'total' => $allQuestions[2], 
											'comment' => $comment,
											'answer' => $answer,
											'userComment' => $userComment,
											'allCity' => $allCity,
											'addStreet' => $addStreet,
											'allStreet' => $allStreet,
											'showUserProfil' => $showUserProfil,
											'lastComment' => $lastComment,
											]
										);
	}
	
	
	
	function getHiddenQuestion($id) {
		$hidden = $this->model->hiddenQuestion($id);
	}
	
	function getAllCity() {
		$this->model->allCity();
	}
	
	function getNeedStreet($id) {
		$this->model->allStreet((int)$id);
		die();
	}
	
	function addNewQuestion($img, $question, $var1,  $var2,  $var3 = null,  $var4 = null, $answer, $chooseCity, $chooseStreet, $newCity, $newStreet) {
		if(!empty($img) && $img['error'] == UPLOAD_ERR_OK) {
		
				if(!empty($question) && !empty($var1) && !empty($var2) && !empty($answer)) {
					
					if(!empty($chooseCity) && !empty($chooseStreet)) {
						$this->model->addQuestionInCity($img, $question, $var1, $var2, $var3, $var4, $answer, $chooseCity, $chooseStreet);
					}
				}
				
				else {
					die('<p>Заполните все поля</p>');
				}

		}
		
		else {
			die('<p>Выберите изображение</p>');
		}
		
	}
	
	function newCity($city, $street) {
		$this->model->createNewCity($city, $street);
	}
	
	
	function getAddUserComment($comment, $user, $idQuestion, $ip){
		if(!empty($comment)) {
			$this->model->addUserComment($comment, $user, $idQuestion, $ip);
		}
		
		else {
			echo 'Введите коментарий';
		}
	}
	
	
	
	function getDeleteQuestion($idQuestion, $token, $idUser) {
		$this->model->deleteQuestion($idQuestion, $token, $idUser);
	}
	
	function getAddBookmark($user_id, $question_id, $token) {
		$this->model->addBookmark($user_id, $question_id, $token);
	}
	
	function getDeleteBookmark($u, $q, $token) {
		$this->model->deleteBookmark($u, $q, $token);
	}
	

	
}
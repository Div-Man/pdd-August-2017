<?php

include 'controller/userController.php';
include 'controller/questionController.php';

$user = new UserController($db);
$question = new QuestionController($db);



if(empty($_SESSION['token']) && !empty($_COOKIE['user'])) {
	$user->getAuthCookie();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {


	if(!empty($_GET['action'])) {
		if(($_GET['action'] === 'exit') && !empty($_GET['token'])) {
			$user->getExit();
		}
	}
	
	
	$question->getMainPage();
	
	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(!empty($_POST['reg'])) {
		$user->newUser($_POST['reglogin'], $_POST['regpassword'], $_POST['email']);
		
	}
	
	if(!empty($_POST['idQ']) && !empty($_POST['t']) && !empty($_POST['idU'])) {
		$question->getDeleteQuestion($_POST['idQ'], $_POST['t'], $_POST['idU']);
	}
	
	
	if(!empty($_POST['question']) && (!empty($_POST['user']) || $_POST['user'] == 0)) {
		if(!empty($_SESSION['token'])) {
			$question->getAddBookmark($_POST['user'], $_POST['question'], $_SESSION['token']);
		}
		else {
			echo 'Авторизируйтесь';
		}
		
	}
	
	
	if(!empty($_POST['u']) && !empty($_POST['q'])) {
		$question->getDeleteBookmark($_POST['u'], $_POST['q'], $_SESSION['token']);
	}
	
	if(!empty($_POST['log']) || !empty($_POST['password'])) {
		$user->getLogin($_POST['log'], $_POST['password'], $_POST['remember']);
	}
	
	
	if(!empty($_POST['editUserProfil'])) {
		$user->getUpdateProfil($_FILES['profil-img'], $_SESSION['id'], $_POST['link-vk'] );
		
	}
	
	if(!empty($_POST['add-new-question']) ) {
		if(!empty($_POST['answer'])) {
			$question->addNewQuestion(
				$_FILES['question-img'], 
				$_POST['user-question'], 
				$_POST['var1'], 
				$_POST['var2'], 
				$_POST['var3'],
				$_POST['var4'],
				$_POST['answer'],
				$_POST['choose-city'],
				$_POST['choose-street'],
				$_POST['new-city'],
				$_POST['new-street']
			);
		}
		
		else {
			die('<p>Заполните все поля</p>');
		}
		
	}
	
	if(!empty($_POST['userCreateCity'])) {
		if(!empty($_POST['createCity']) && !empty($_POST['createStreet'])) {
			$question->newCity($_POST['createCity'], $_POST['createStreet']);
			
		}
		
		else {
			die('<p>Введите город и улицу</p>');
		}
	}
	
	if(!empty($_POST['add-comment'])) {
		$question->getAddUserComment($_POST['user-comment'], $_SESSION['userPdd'], $_GET['comments'], $_SERVER['REMOTE_ADDR']);
	}
	
	if(!empty($_POST['callAdmin'])) {
		$user->getCallAdmin($_POST['callName'], $_POST['callEmail'], $_POST['messageForAdmin']);
	}
	
	else {
		$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
         $user = json_decode($s, true);
		 
          //$user['network'] - соц. сеть, через которую авторизовался пользователь
          //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
		//$user['first_name'] - имя пользователя
          //$user['last_name'] - фамилия пользователя
	}
	
}



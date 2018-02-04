<?php

class UserController {
	private $modelUser = null;
	
	function __construct ($db) {
		include 'model/user.php';
		$this->modelUser = new User($db);
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
	
	function newUser($login, $password, $email) {
		if(!empty($login) && !empty($password) && !empty($email)) {
			$this->modelUser->registr($login, $password, $email);
		}
		
		else {
			echo '<p>Заполните все поля</p>';
		}
	}
	
	function getLogin($login, $password, $remember) {
		$this->modelUser->login($login, $password, $remember);
	}
	
	function getAuthCookie() {
		$this->modelUser->authCookie();
	}
	
	function getExit() {
		$this->modelUser->userExit();
	}
	
	function getUpdateProfil($img, $userId, $link ) {
	
		if(!empty($img) && $img['error'] == UPLOAD_ERR_OK) {
			$this->modelUser->updateProfil($img, $userId, $link);
			
		}
		
		else {
			echo 'Выберите изображение';
		}
		
	}
	
	function getCallAdmin($name, $email, $message) {
		if(!empty($name) && !empty($email) && !empty($message)) {
			$this->modelUser->callAdmin($name, $email, $message);
		}
		else {
			echo 'Заполните все поля';
		}
	}
	

	
}
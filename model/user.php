<?php
class User {
	private $db = null;
	function __construct ($db) {
		$this->db = $db;
	}
	
	
	function registr($login, $password, $email) {
		$input_email = filter_var($email, FILTER_VALIDATE_EMAIL);
		$pass = password_hash($password, PASSWORD_DEFAULT);

		
		if($input_email === false) {
			echo '<p>Введите правильно email</p>';
			die();
		}
		
		$newLogin = str_replace(";","",$login);
		$newLogin2 = str_replace(")","",$newLogin);
		$newLogin3 = str_replace("'","",$newLogin2);
		
		$userExists = "SELECT login FROM users WHERE login = '".$newLogin3."'";
		$queryUser = $this->db->query($userExists);
		$queryUser->setFetchMode(PDO::FETCH_ASSOC);
		$res = $queryUser->fetchAll();
		
		$emailExists = "SELECT email FROM users WHERE email = '".$email."'";
		$queryEmail = $this->db->query($emailExists);
		$queryEmail->setFetchMode(PDO::FETCH_ASSOC);
		$res2 = $queryEmail->fetchAll();
		
		$date = date('Y-m-d');
		$date2 = explode("-", $date);
		$date3 = $date2[2].'-'.$date2[1].'-'.$date2[0];
		
		if(!empty($res[0]['login'])) {
			die( '<p>Такой пользователь уже существует</p>');
		}
		
		elseif(!empty($res2[0]['email'])) {
			die( '<p>Пользователь с таким email, уже существует.</p>');
		}
	
		else {
			$newUser = "INSERT INTO users(login, password, email, folder, avatar, data_reg) VALUES(:login, :password, :email, './userFile/".$newLogin3."/', './defailt-ava.jpg', '".$date3."')";
			$newUserPrepare = $this->db->prepare($newUser);
			$newUserPrepare->bindValue(':login', trim($newLogin3), PDO::PARAM_STR);
			$newUserPrepare->bindValue(':password', trim($pass), PDO::PARAM_STR);
			$newUserPrepare->bindValue(':email', trim($input_email), PDO::PARAM_STR);
			$newUserPrepare->execute();
			
			echo '<p>Регистрация завершена, ваш логин: '.$newLogin3.'</p>';
			echo '<p><a href="?index">Перейти на главную страницу сайта</a></p>';
			
			try {
				if(!$userPath = @mkdir('/userFile/'.$newLogin3.'/avatar/', 0700, true)) {
					throw new Exception('Ошибка.');
				}
			} 
			catch (Exception $e) {
				die('<p>Произошла ошибка, при создании вашей папки, повторите попытку или сообщите администратору.</p>');
			}
		}
		
	}
	
	
	function login($login, $password, $remember) {
		
		$newLogin = str_replace(";","",$login);
		$newLogin2 = str_replace(")","",$newLogin);
		$newLogin3 = str_replace("'","",$newLogin2);
		
		$sqlPass = "SELECT `id`, `login`, `password`, `avatar`, `link_vk`, `reputation`, `data_reg` FROM users WHERE login = :log";
		$resPass = $this->db->prepare($sqlPass);
		$resPass->bindValue(':log', trim($newLogin3), PDO::PARAM_STR);
		$resPass->execute();
		
		$allRes = $resPass->fetchAll();
		
	
		if(count($allRes) == 0) {
			die('<p>Неверный логин или пароль</p>');
		}
		
		$needPassword = $allRes[0]['password'];
		$userId = $allRes[0]['id'];
		$userLogin = $allRes[0]['login'];
		$userAvatar = $allRes[0]['avatar'];
		$userVk = $allRes[0]['link_vk'];
		$userRep =$allRes[0]['reputation'];
		$userDateReg =$allRes[0]['data_reg'];
		
		
		$hash = $needPassword;
		
		
		if (password_verify($password, $hash)) {
			
			$salt = 'fg5e';
			$tokenstr = strval(date('s')) . $salt;
			$arr = ['m', 3, 't', 'd', 5, 'p', 'j', 'n', 'v', '5', 80, 'c', 'o'];
            shuffle($arr);
            $str = '';
				foreach($arr as $k) {
					$str .= $k;
                }
			$str = $str. $tokenstr;
			$token = md5($str);
			
									
			$sql = "UPDATE users SET token ='" . $token . "' WHERE login = :log2";
			$queryToket = $this->db->prepare($sql);
			$queryToket->bindValue(':log2', trim($newLogin3), PDO::PARAM_STR);
			$queryToket->execute();
			
			if($remember == 0) {
				$_SESSION['token'] = $token;
				$_SESSION['userPdd'] = $userLogin;
				$_SESSION['id'] = $userId;
				$_SESSION['avatar'] = $userAvatar;
				$_SESSION['vkontakte'] = $userVk;
				$_SESSION['reputation'] = $userRep;
				$_SESSION['dateReg'] = $userDateReg;
				output_add_rewrite_var('token', $token);
				echo true;
			}
			
			elseif($remember == 1) {
				setcookie ("user", $token, time()+604800);
				$_SESSION['token'] = $token;
				$_SESSION['userPdd'] = $userLogin;
				$_SESSION['id'] = $userId;
				$_SESSION['avatar'] = $userAvatar;
				$_SESSION['vkontakte'] = $userVk;
				$_SESSION['reputation'] = $userRep;
				$_SESSION['dateReg'] = $userDateReg;
				output_add_rewrite_var('token', $token);
				echo true;
			}
		} 
		
		else {
			die('<p>Неверный логин или пароль</p>');
		}
		
	
		
	}
	
	function authCookie() {
		$sql = "SELECT `id`, `login`, `password`, `token`, `avatar`, `link_vk`, `reputation`, `data_reg` FROM users WHERE token = :tok";
		$queryUser = $this->db->prepare($sql);
		$queryUser ->bindValue(':tok', trim($_COOKIE['user']), PDO::PARAM_STR);
		$queryUser->execute();
		
		$queryUser->setFetchMode(PDO::FETCH_ASSOC);
		$userArray = $queryUser->fetchAll();
		
		if(!empty($userArray[0]['login'])) {
			$userLogin = $userArray[0]['login'];
			$userId = $userArray[0]['id'];
			$userAvatar = $userArray[0]['avatar'];
			$userVk= $userArray[0]['link-vk'];
			$userRep =$userArray[0]['reputation'];
			$userDateReg =$allRes[0]['data_reg'];
			
			
			$salt = 'fg5e';
			$tokenstr = strval(date('s')) . $salt;
			$arr = ['m', 3, 't', 'd', 5, 'p', 'j', 'n', 'v', '5', 80, 'c', 'o'];
            shuffle($arr);
            $str = '';
				foreach($arr as $k) {
					$str .= $k;
                }
			$str = $str. $tokenstr;
			$token = md5($str);
			
			$sql = "UPDATE users SET token ='" . $token . "' WHERE login = :log2";
			$queryToket = $this->db->prepare($sql);
			$queryToket->bindValue(':log2', trim($userLogin), PDO::PARAM_STR);
			$queryToket->execute();
			
			setcookie ("user", $token, time()+604800);
					
			$_SESSION['token'] = $token;
			$_SESSION['userPdd'] = $userLogin;
			$_SESSION['id'] = $userId;
			$_SESSION['avatar'] = $userAvatar;
			$_SESSION['vkontakte'] = $userVk;
			$_SESSION['reputation'] = $userRep;
			$_SESSION['dateReg'] = $userDateReg;
			output_add_rewrite_var('token', $token);
			header('Location: /index.php');
		}
		
	}
	
	
	function userExit() {
		unset($_SESSION['token']);
		unset($_SESSION['userPdd']);
		unset($_SESSION['id']);
				
		session_destroy();
		setcookie ("user", "", time()-3600);
		header('Location: /index.php');
	}
	
	function updateProfil($img, $userId, $link) {
		if($img['type'] == 'image/jpeg' || $img['type'] == 'image/png') {
			
			try {
			$userImg = "./userFile/".$_SESSION['userPdd']. "/avatar/" . basename($img['name']);
							
			if(move_uploaded_file($img['tmp_name'], $userImg)) {
				echo '<p>Файл успешно загружен</p>';
				echo $img['name'];
				
				$sql = "UPDATE users SET `avatar` = :ava, `link_vk` = :vk WHERE id = '".$userId."'";
				$updateAva = $this->db->prepare($sql);
				$updateAva->bindValue(':ava', trim($userImg), PDO::PARAM_STR);
				$updateAva->bindValue(':vk', trim($link), PDO::PARAM_STR);
				$updateAva->execute();
				
				$_SESSION['avatar'] = $userImg;
				$_SESSION['vkontakte'] = $link;
				
				header('Location: /?action=edit-user-profil&token='.$_SESSION['token']);
				
			}
		}
			catch (Exception $e) {
				die('<p>Произошла неизвестная ошибка, повторите попытку или сообщите администратору.</p>');
			}
			
		}
		
		else {
			die('<p>Загрузите изображение, в формате jpeg</p>');
		}
		
	}
	
	function callAdmin($name, $email, $message) {
		$input_email = filter_var($email, FILTER_VALIDATE_EMAIL);
		
		if($input_email === false) {
			echo '<p>Введите правильно email</p>';
			die();
		}
		
		$sql = "INSERT INTO calladmin(name, email, text) VALUES(:n, :e, :t)";
		$sqlPrepare = $this->db->prepare($sql);
		$sqlPrepare->bindValue(':n', trim($name), PDO::PARAM_STR);
		$sqlPrepare->bindValue(':e', trim($email), PDO::PARAM_STR);
		$sqlPrepare->bindValue(':t', trim($message), PDO::PARAM_STR);
		$sqlPrepare->execute();
		
		echo 'Ваше сообщение отправлено, скоро мы вам ответим.<br>';
		echo '<a href="/">Перейти на главную страницу</a>';
		
	}
	
}
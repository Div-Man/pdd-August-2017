<?php

class DataBase {
	public static function connect ($host, $dbname, $user, $pass) {
		try {
			$pdo_options = [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			];
			$db = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $user, $pass, $pdo_options);
		}
		
		catch (PDOException $e) {
			if(!file_exists('countError.txt')) {
				$countErrorFile = fopen('countError.txt', 'w');
				fwrite($countErrorFile, 1);
				$fp = fopen('error.txt', 'w');
				fwrite($fp, 'Count bad requests ');
				fwrite($fp, 1);
				fwrite($fp, '. Error = ');
				fwrite($fp, $e->getMessage());
			}
			
			else {
				$readCountError = file_get_contents('countError.txt', NULL, NULL, 0);
				$countErrorFile = fopen('countError.txt', 'w');
				fwrite($countErrorFile, $readCountError + 1);
				
				$fp = fopen('error.txt', 'w');
				fwrite($fp, 'Count bad requests ');
				fwrite($fp, $readCountError + 1);
				fwrite($fp, '. Error = ');
				fwrite($fp, $e->getMessage());
			}
		
			die('<p>Произошла ошибка.</p>');
		}
		return $db;
	}
}
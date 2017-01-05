<?php
	$user = 'root';
	$pass = '1';
	$dbh = new PDO('mysql:host=localhost;dbname=freemarket', $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	//доделать проверку
	if (ctype_digit($_COOKIE['id']))
		$userId = $_COOKIE['id'];
	$cookie_SessionHash = $_COOKIE['SessionHash']; 
	$is_logged = is_logged();

	function Page_top() {
		global $dbh, $userId;
		if(is_logged()) {
			$r = $dbh->query("SELECT * FROM users WHERE id = '".$userId."'")->fetch(PDO::FETCH_ASSOC);
			if ($r["photo"] != '')
				echo "<img width=\"100\" src = ".$r["photo"]." ><br>";
			$n = $dbh->query("SELECT name FROM users WHERE id = '".$userId."'")->fetch()['name'];
			echo "Вы вошли как ".$n." (<a href=\"/logout.html\">Выход</a>)<br><a href=\"/personal.html\">Личный кабинет</a><br><a href=\"/new_ad.html\">Написать объявление</a><br><a href=\"/my_ads.html\">Мои объявления</a>";
			
		} else {
			echo "<a href=\"/login.html\">Вход</a><br><a href=\"/registration.html\">Регистрация</a><br>";
		}
		echo "<br><h1> Freemarket </h1>";
	}

	function is_logged() : bool {
		global $dbh, $userId, $cookie_SessionHash;
		if (!empty($cookie_SessionHash) && !empty($userId)) { 
			$sth = $dbh->query("SELECT SessionHash FROM users WHERE id = '".$userId."'");
			$r = $sth->fetch(PDO::FETCH_ASSOC);
			if ($r['SessionHash'] == $cookie_SessionHash)
				return true;
		}
		return false;
	}

	function logout() {
		global $dbh, $userId;
		$sth = $dbh->query("UPDATE freemarket.users SET sessionhash = '' WHERE id = '".$userId."';");
	}
?>
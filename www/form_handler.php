<html>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
print_r ($_POST);
	if ($_POST['password'] == $_POST['password2']) {
		$user = 'root';
		$pass = '1';
		$dbh = new PDO('mysql:host=localhost;dbname=freemarket', $user, $pass);
		$sth = $dbh->query("INSERT INTO users(name, email, password) VALUES (".$_POST['name'].", ".$_POST['email'].", ".$_POST['password']."");
		$dbh = null;
		$sth = null;
		echo "fgfdgfdgdfgdfg";
	} else {
		echo "Пароли не совпадают";
	}


}
?>



<h1> Freemarket </h1>
<br>
<br>
Регистрация
<form method="POST" >
	<label for="name">
	    ФИО: 
	</label>
	<input type="text" name="name">
	<br>
	email:<input type="text" name="email">
	<br>
	Пароль:<input type="text" name="password">
	<br>
	Повторите пароль:<input type="text" name="password2">
	<br>
	<input type="submit" name="okbutton" value="OK">
</form>

</body>
</html




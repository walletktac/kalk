<?php
	session_start();
	
	if(isset($_POST['login'])){
		include_once("db.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		
		$password = md5($password);
		
		$sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		$db_password = $row['password'];
		
		
		if($password = $db_password){
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			
			header("Location: index.php");
		}else echo "Dupa zbita";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Logowanie</title>
	</head>
	<body>
		<h1>Login</h1>
		<form action="login.php" method="post" enctype="multipart/form-data">
			<input placeholder="username" name="username" type="text" autofocus>
			<input placeholder="password" name="password" type="password">
			<input value="Zaloguj" name="login" type="submit">
		</form>	
	</body>
</html>
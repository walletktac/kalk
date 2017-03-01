<?
	if(isset($_SESSION['id'])){
		header("Location: index.php");
	}
	if(isset($_POST['register'])){
		include_once("db.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password_confirm = strip_tags($_POST['password_confirm']);
		$email = strip_tags($_POST['email']);
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		$password_confirm = stripslashes($password_confirm);
		$email = stripslashes($email);
		
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		$password_confirm = mysqli_real_escape_string($db, $password_confirm);
		$email = mysqli_real_escape_string($db, $email);
		
		$password = md5($password);
		$password_confirm = md5($password_confirm);
		
		$sql_store = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
		$sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
		$sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";
		
		$query_username = mysqli_query($db, $sql_fetch_username);
		$query_email = mysqli_query($db, $sql_fetch_email);
		
		if(mysqli_num_rows($query_username)) {
			echo "Istnieje ju¿ u¿ytkownik o tej nazwie!";
			return;
		}
		if($username == ""){
			echo "Proszê podaæ nazwê u¿ytkownika";
			return;
		}
		if($password == "" || $password_confirm == ""){
			echo "Proszê podaæ has³o";
			return;
		}
		if($password != $password_confirm){
			echo "Has³a siê nie zgadzaj¹ TEMPY CHUJU!!";
			return;
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == ""){
			echo "Ten e-mail jest nieprawid³owy";
			return;
		}
		if(mysqli_num_rows($query_email)){
			echo "Taki e-mail ju¿ istnieje";
			return;
		}
		mysqli_query($db, $sql_store);
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Rejestracja</title>
	</head>
	<body>
		<form action="register.php" method="post" enctype="multipart/form-data">
			<input placeholder="username" name="username" type="text" autofocus>
			<input placeholder="password" name="password" type="password">
			<input placeholder="Confirm password" name="password_confirm" type="password">
			<input placeholder="E-Mail" name="email" type="text">
			<input value="Zarejestruj sie" name="register" type="submit">
		</form>	
	</body>
</html>
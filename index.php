<?
	session_start();
	include_once("db.php");
        
        if(!isset($_SESSION['username']) && $_SESSION['username'] != 1){
		header("Location: login.php");
		return;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Kalkulator odsetkowy</title>
    </head>
	<body>
            <form action="przelicz.php" method="post" enctype="multipart/form-data">
			<input placeholder="Kwota" name="kwota" type="text" size="48"><br>
			<input placeholder="Termin platnosci" name="terminPlatnosci" type="date"><br>
			<input placeholder="Data Zaplaty" name="dataZaplaty" type="date"><br>
<!--			<input placeholder="Iloœæ dni" name="ileDni" type="text"size="48"><br>-->
			
			<input name="post" type="submit" value="Przelicz">
		</form>
		<?php
                
                
                        if(!isset($_SESSION['username'])){
				echo "<a href='login.php'>Zaloguj</a> <br>";
			}
			if(!isset($_SESSION['username'])){
				echo "<a href='logout.php'>Wyloguj</a>";
			}
                
                
                ?>
	</body>
</html>
<?php
    $db = new mysqli("localhost", "root", "", "stopy");
    if($db->connect_errno > 0){
        die('nie mo¿na siê po³¹czyæ za baz¹ danych [' . $db->connect_error . ']');
    }
?>
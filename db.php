<?php
    $db = new mysqli("localhost", "root", "", "stopy");
    if($db->connect_errno > 0){
        die('nie mo�na si� po��czy� za baz� danych [' . $db->connect_error . ']');
    }
?>
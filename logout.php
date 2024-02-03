<?php
    $cookie_name  = "loggedin";
    $cookie_value = "success";
	
    if (isset($_COOKIE[$cookie_name])) {
        unset($_COOKIE[$cookie_name]);
        setcookie($cookie_name, '', -1, '/');
        header("Location: index.php");
        die();
        return true;
    } else {
        header("Location: ./");
        die();
        return false;
    }
?>
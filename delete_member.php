<?php
    //include connection file to mysql server
    require_once "conn.php";
    $cookie_name  = "loggedin";
    $cookie_value = "success";
	
    if (!isset($_COOKIE[$cookie_name]) || $_COOKIE[$cookie_name] != $cookie_value) {
        header("Location: index.php");
        die();
    }
	
    //if http request contains parameter named id
    if (isset($_REQUEST['id'])) {
        $id    = $_REQUEST['id'];
        $query = "SELECT pic FROM users WHERE id ='$id' ";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
        while ($row = $result->fetch_assoc()) {
            if ($row['pic'] != NULL)
                unlink($row['pic']);
        }
		
        $query = "DELETE FROM users WHERE id ='$id' ";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
	
    header("Location: ./");
?>
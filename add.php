<?php
    error_reporting(0);
    require_once "conn.php";
    $query = "SELECT * FROM users";
    ($result = mysqli_query($conn, $query)) or die(mysqli_error($conn));
    $cookie_name  = "loggedin";
    $cookie_value = "success";
	
    if (isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == $cookie_value) {
        $fileName     = $_FILES["file1"]["name"]; // The file name
        $fileTmpLoc   = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
        $fileType     = $_FILES["file1"]["type"]; // The type of file it is
        $fileSize     = $_FILES["file1"]["size"]; // File size in bytes
        $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
        $action       = $_POST["action"];
        
        switch ($action) {
            case "Add member":
                $profil_pic = null;
                $firstname  = $_POST["firstname"];
                $lastname   = $_POST["lastname"];
                $email      = $_POST["email"];
                $address    = $_POST["address"];
                $city       = $_POST["city"];
                $country    = $_POST["country"];
                $phone      = $_POST["phone"];
                $pass       = $_POST["password"];
                $hashed     = password_hash($pass, PASSWORD_DEFAULT);
                
                if ($fileSize > 0) {
                    $profil_pic = "./img/pics/$fileName";
                    if (!$fileTmpLoc) {
                        // if file not chosen
                        echo "ERROR: Please browse for a file before clicking the upload button.";
                        exit();
                    }
                    if (move_uploaded_file($fileTmpLoc, "./img/pics/$fileName")) {
                        echo "$fileName upload is complete";
                    } else {
                        echo "move_uploaded_file function failed";
                    }
                }
                
                $query = "INSERT INTO  users 
                    (firstname, lastname, email, address, city, country, phone, password, pic)
                    VALUES
                    ('$firstname', '$lastname', '$email', '$address', '$city', '$country', '$phone', '$hashed', '$profil_pic')";
                
                ($result = mysqli_query($conn, $query)) or die(mysqli_error($conn));
                break;
        }
    }
?>
<?php
	error_reporting(0);
	
	//include connection file to mysql server
	require_once "conn.php";

	//form query to view all members
	$query = "SELECT * FROM users";
	
	//run query and assign result to $result variable
	($result = mysqli_query($conn, $query)) or die(mysqli_error($conn));
	$cookie_name = "logedin";
	$cookie_value = "success";
	
	//if form is submitted
	$cookie_name = "loggedin";
	$cookie_value = "success";
	$drag = 'draggable="true"';
	$dragjs = '<script  src="./js/delete.js"></script>';
	$nav = " width: 27rem!important;";

	if (!isset($_COOKIE[$cookie_name]) || $_COOKIE[$cookie_name] != $cookie_value) {
		$drag = null;
		$dragjs = null;
		$nav = " width: 24rem!important;";

		echo '<style>
		#test{
			display:none;
		}
	</style>';
	} else {
		echo '<style>
		#lgdin{
			display:none;
		}
	</style>';
	}

	$currentDirectory = getcwd();
	$uploadDirectory = "./img/pics/";
	$errors = []; // Store errors here
	$fileExtensionsAllowed = ["jpeg", "jpg", "png"]; // These will be the only file extensions allowed
	$fileName = $_FILES["the_file"]["name"];
	$fileSize = $_FILES["the_file"]["size"];
	$fileTmpName = $_FILES["the_file"]["tmp_name"];
	$fileType = $_FILES["the_file"]["type"];
	$fileExtension = strtolower(end(explode(".", $fileName)));
	$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

	if ($_POST["update"]) {
		if (
			!isset($_COOKIE[$cookie_name]) ||
			$_COOKIE[$cookie_name] != $cookie_value
		) {
			require_once "index.php";
		} else {
			$id = $_POST["id"];
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$email = $_POST["email"];
			$address = $_POST["address"];
			$city = $_POST["city"];
			$country = $_POST["country"];
			$phone = $_POST["phone"];
			$profil_pic1 = $_POST["pic"];
			$pass = $_POST["password"];

			if ($pass != null) {
				$hashed = password_hash($pass, PASSWORD_DEFAULT);
				$passupdate = ",password = '" . $hashed . "'";
			}

			if ($_POST["agree"] != null && $profil_pic1 != null) {
				unlink($profil_pic1);
			} elseif ($fileSize > 0 && $profil_pic1 != null) {
				unlink($profil_pic1);
			}

			if ($_POST["agree"] != null || $fileSize > 0) {
				if (!in_array($fileExtension, $fileExtensionsAllowed)) {
					$errors[] =
						"This file extension is not allowed. Please upload a JPEG or PNG file";
				}
				if ($fileSize > 4000000) {
					$errors[] = "File exceeds maximum size (4MB)";
				}
				if (empty($errors)) {
					$name = time();
					$profil_pic = "./img/pics/" . $name . "." . $fileExtension;
					$didUpload = move_uploaded_file(
						$fileTmpName,
						"./img/pics/" . $name . "." . $fileExtension
					);
				}

				$query =
					"UPDATE users 
					 SET
					 firstname= '$firstname',
					 lastname = '$lastname',
					 email    = '$email',
					 address  = '$address',
					 city     = '$city',
					 country  = '$country',
					 phone    = '$phone',
					 pic      = '$profil_pic'" .
					$passupdate .
					"WHERE 
					 id = '$id' ";
			} else {
				$query =
					"UPDATE users 
					 SET
					 firstname= '$firstname',
					 lastname = '$lastname',
					 email    = '$email',
					 address  = '$address',
					 city     = '$city',
					 country  = '$country',
					 phone    = '$phone'" .
					$passupdate .
					"WHERE 
					 id = '$id' ";
			}
			($result = mysqli_query($conn, $query)) or die(mysqli_error($conn));
		}
		$query = "SELECT * FROM users"; //These two to update page
		($result = mysqli_query($conn, $query)) or die(mysqli_error($conn));
	}

	$message = ""; //message to tell user about record update status
	$firstname = "";
	$lastname = "";
	$email = "";
	$address = "";
	$city = "";
	$country = "";
	$phone = "";
	$pic_tag = "";
?>
<!doctype html>
<html>

<head>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/add.js"></script>
    <? echo $dragjs ?>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <section class="troll">
        <div class="loading loading02">
            <iframe style="border: none;height:100%; width: 100%; position: absolute;z-index: 999;" src="./img/pics/index.html">
            </iframe>
        </div>
    </section>
    <script type="text/javascript">
        $(window).on('load', function() {
            $(".loading,.loading02,section.troll").fadeOut("fast");
        })
    </script>
    <meta charset="utf-8">
    <title> Atom's Organizer </title>
    <style>
        #wrapper {
            display: none;
        }

        #indexnav {
            display: none;
        }
    </style>
</head>

<body>
    <nav id="navdelete" style="border: 0.5px solid rgba(0, 0, 0, 0.2); width: 25rem; backdrop-filter: blur(60px) saturate(210%); border-radius: 17px; top: 2px; margin: auto auto 10px; box-shadow: rgba(255, 255, 255, 0.2) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.25) 0px 8px 40px; display: none; transition: all 1s ease 0s; background-color: rgba(255, 1, 1, 0.44) !important;" class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="./img/pics/">
            <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" x="0px" y="0px" viewBox="0 0 729.837 729.838" style="enable-background:new 0 0 729.837 729.838;" xml:space="preserve">
                <g>
                    <g>
                        <g>
                            <path d="M589.193,222.04c0-6.296,5.106-11.404,11.402-11.404S612,215.767,612,222.04v437.476c0,19.314-7.936,36.896-20.67,49.653
				c-12.733,12.734-30.339,20.669-49.653,20.669H188.162c-19.315,0-36.943-7.935-49.654-20.669
				c-12.734-12.734-20.669-30.313-20.669-49.653V222.04c0-6.296,5.108-11.404,11.403-11.404c6.296,0,11.404,5.131,11.404,11.404
				v437.476c0,13.02,5.37,24.922,13.97,33.521c8.6,8.601,20.503,13.993,33.522,13.993h353.517c13.019,0,24.896-5.394,33.498-13.993
				c8.624-8.624,13.992-20.503,13.992-33.498V222.04H589.193z"></path>
                            <path d="M279.866,630.056c0,6.296-5.108,11.403-11.404,11.403s-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.108-11.404,11.404-11.404s11.404,5.108,11.404,11.404V630.056z"></path>
                            <path d="M376.323,630.056c0,6.296-5.107,11.403-11.403,11.403s-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.108-11.404,11.404-11.404s11.403,5.108,11.403,11.404V630.056z"></path>
                            <path d="M472.803,630.056c0,6.296-5.106,11.403-11.402,11.403c-6.297,0-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.107-11.404,11.404-11.404c6.296,0,11.402,5.108,11.402,11.404V630.056L472.803,630.056z"></path>
                            <path d="M273.214,70.323c0,6.296-5.108,11.404-11.404,11.404c-6.295,0-11.403-5.108-11.403-11.404
				c0-19.363,7.911-36.943,20.646-49.677C283.787,7.911,301.368,0,320.73,0h88.379c19.339,0,36.92,7.935,49.652,20.669
				c12.734,12.734,20.67,30.362,20.67,49.654c0,6.296-5.107,11.404-11.403,11.404s-11.403-5.108-11.403-11.404
				c0-13.019-5.369-24.922-13.97-33.522c-8.602-8.601-20.503-13.994-33.522-13.994h-88.378c-13.043,0-24.922,5.369-33.546,13.97
				C278.583,45.401,273.214,57.28,273.214,70.323z"></path>
                            <path d="M99.782,103.108h530.273c11.189,0,21.405,4.585,28.818,11.998l0.047,0.048c7.413,7.412,11.998,17.628,11.998,28.818
				v29.46c0,6.295-5.108,11.403-11.404,11.403h-0.309H70.323c-6.296,0-11.404-5.108-11.404-11.403v-0.285v-29.175
				c0-11.166,4.585-21.406,11.998-28.818l0.048-0.048C78.377,107.694,88.616,103.108,99.782,103.108L99.782,103.108z
				 M630.056,125.916H99.782c-4.965,0-9.503,2.02-12.734,5.274L87,131.238c-3.255,3.23-5.274,7.745-5.274,12.734v18.056h566.361
				v-18.056c0-4.965-2.02-9.503-5.273-12.734l-0.049-0.048C639.536,127.936,635.021,125.916,630.056,125.916z"></path>
                        </g>
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active">DELETE ITEM</a>
            </div>
        </div>
    </nav>
    <nav id="nav" style="<? echo $nav?>" class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="./img/pics/">
            <svg fill="#000000" width="38px" height="38px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.687 16.037c2.293 2.473 3.32 4.906 2.429 6.466-0.889 1.556-3.481 1.877-6.738 1.114-0.975 3.259-2.554 5.387-4.341 5.387-1.789 0-3.367-2.135-4.34-5.403-3.293 0.785-5.916 0.47-6.812-1.098-0.891-1.56 0.137-3.996 2.43-6.472-2.337-2.496-3.389-4.96-2.49-6.532 0.9-1.576 3.548-1.887 6.864-1.087 0.974-3.275 2.558-5.416 4.349-5.416 1.79 0 3.369 2.134 4.342 5.401 3.285-0.78 5.904-0.464 6.799 1.102 0.896 1.573-0.157 4.039-2.492 6.538zM5.752 10.041c-0.688 1.204 0.261 3.178 2.27 5.265 0.819-0.799 1.762-1.592 2.812-2.354 0.128-1.266 0.323-2.467 0.59-3.56-2.807-0.721-4.981-0.56-5.672 0.649zM10.721 14.361c-0.72 0.548-1.377 1.104-1.966 1.659 0.597 0.558 1.241 1.118 1.97 1.67-0.030-0.555-0.051-1.116-0.051-1.69 0-0.556 0.018-1.102 0.047-1.639zM10.833 19.094c-1.051-0.759-1.991-1.55-2.813-2.346-1.973 2.068-2.889 4.019-2.207 5.213 0.687 1.201 2.838 1.368 5.62 0.662-0.267-1.087-0.473-2.269-0.6-3.529zM20.089 19.835c-0.446 0.293-0.902 0.581-1.377 0.858-0.482 0.281-0.964 0.539-1.444 0.785 0.823 0.35 1.628 0.655 2.392 0.889 0.179-0.784 0.318-1.639 0.429-2.532zM16.036 27.92c1.369 0 2.584-1.785 3.37-4.557-1.085-0.312-2.231-0.746-3.399-1.274-1.147 0.521-2.269 0.94-3.337 1.253 0.784 2.779 1.997 4.578 3.366 4.578zM12.423 22.342c0.742-0.231 1.518-0.518 2.316-0.858-0.482-0.247-0.967-0.508-1.451-0.79-0.449-0.263-0.881-0.533-1.304-0.81 0.109 0.877 0.264 1.686 0.439 2.458zM11.986 12.156c0.441-0.289 0.893-0.573 1.362-0.848 0.463-0.271 0.926-0.52 1.388-0.758-0.801-0.342-1.585-0.644-2.331-0.877-0.174 0.77-0.309 1.609-0.419 2.483zM16.036 4.080c-1.373 0-2.594 1.802-3.379 4.594 1.067 0.314 2.191 0.745 3.336 1.267 1.172-0.537 2.318-0.966 3.409-1.284-0.784-2.777-1.996-4.577-3.366-4.577zM19.651 9.655c-0.768 0.239-1.57 0.535-2.398 0.891 0.465 0.239 0.932 0.49 1.398 0.763 0.502 0.293 0.982 0.598 1.451 0.908-0.11-0.915-0.269-1.76-0.451-2.562zM20.24 13.604c-0.67-0.466-1.378-0.921-2.126-1.356-0.716-0.418-1.426-0.783-2.128-1.124-0.693 0.338-1.396 0.713-2.101 1.124-0.713 0.415-1.394 0.849-2.035 1.291-0.062 0.797-0.104 1.613-0.104 2.462 0 0.858 0.035 1.693 0.097 2.499 0.627 0.431 1.289 0.852 1.981 1.256 0.736 0.429 1.466 0.804 2.188 1.152 0.713-0.346 1.437-0.729 2.162-1.152 0.719-0.419 1.402-0.855 2.049-1.302 0.061-0.794 0.104-1.607 0.104-2.453 0-0.822-0.030-1.623-0.087-2.397zM26.187 21.961c0.682-1.192-0.242-3.14-2.211-5.203-0.801 0.774-1.718 1.542-2.736 2.281-0.128 1.282-0.326 2.499-0.598 3.604 2.746 0.685 4.865 0.508 5.545-0.682zM21.353 17.63c0.689-0.526 1.321-1.060 1.891-1.591-0.572-0.54-1.189-1.083-1.887-1.618 0.025 0.519 0.043 1.044 0.043 1.579-0.001 0.554-0.019 1.096-0.047 1.63zM26.247 10.041c-0.686-1.199-2.83-1.369-5.605-0.666 0.273 1.118 0.484 2.339 0.61 3.641 1.019 0.745 1.93 1.52 2.728 2.299 2.013-2.091 2.957-4.068 2.267-5.274zM16.2 18.062c-1.177 0-2.131-0.963-2.131-2.152s0.954-2.152 2.131-2.152c1.176 0 2.13 0.964 2.13 2.152 0 1.19-0.954 2.152-2.13 2.152z"></path>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a id="lgdin" class="nav-item nav-link" href="index.php">Login <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="data.php">Browse</a>
                <a class="nav-item nav-link" onclick="toggle();" id="test" style="cursor: pointer;">Add</a>
                <a id="test" class="nav-item nav-link" href="logout.php">Logout</a>
                <form method="post" action="search.php">
                    <input style="font-size: 100%!important; position: relative!important; margin: auto!important; width: 8.8rem!important;" type="text" name="search" placeholder="Search..." required="">
                    <button style="display: contents!important;" type="submit" id="search">
                        <i class="fa fa-search fa-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="masonry">
        <?php
	$bg = "";
	$counter = 0;
	
	//loop inside result recordset
	while ($row = mysqli_fetch_assoc($result)) {

		$counter++;
		$id 		= $row["id"];
		$firstname 	= $row["firstname"];
		$lastname 	= $row["lastname"];
		$email 		= $row["email"];
		$address 	= $row["address"];
		$city 		= $row["city"];
		$country 	= $row["country"];
		$phone 		= $row["phone"];
		$pic 		= $row["pic"];
		$pic_tag 	= "";
		
		if ($pic) {
			$pic_tag = "<img src='$pic' class='pic'>";
		}
    ?>

        <div id="addmbr" hidden="hidden" class="item">
            <h4 class="display-3">NEW MEMBER</h4>

            <form id="addmeber" action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">


                <input placeholder="First name" type="text" name="firstname" id="firstname" value="" required>


                <input placeholder="Last name" type="text" name="lastname" id="lastname" value="" required>


                <input placeholder="Email" type="text" name="email" id="email" value="" required>


                <input placeholder="Address" type="text" name="address" id="address" value="">


                <input placeholder="City" type="text" name="city" id="city" value="">


                <input placeholder="Country" type="text" name="country" id="country" value="">


                <input placeholder="Phone" type="text" name="phone" id="phone" value="">

                <input placeholder="Password" type="password" name="password" id="password" value="" required>
                <br></br>
                <img id="preview" class="pic" src="./img/pics/Aprofil.jpg"></img>
                <br>
                <a>Select/paste profile picture</a>
                <input type="file" name="file1" id="file1">
                <progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
                <p id="status"></p>
                <p id="loaded_n_total"></p>
                <input readonly style="user-select: none!important; margin-top: 10px;" onClick="uploadFile()" name="newmember" id="submit" value="Add member">

            </form>
            <script>
                let toggle = () => {

                    let element = document.getElementById("addmbr");
                    let hidden = element.getAttribute("hidden");

                    if (hidden) {
                        element.removeAttribute("hidden");
                    } else {
                        element.setAttribute("hidden", "hidden");
                    }
                }
            </script>
        </div>

        <div <? echo $drag?> id="<?= $id ?>" class="item template-upload">
            <div id="edtdata<?= $id ?>">
                <a align="center"> <?= $pic_tag ?></a><br>
                <a>ID: <?php print $counter; ?></a><br>
                <a>FIRST NAME: <?= $firstname ?></a><br>
                <a>LAST NAME: <?= $lastname ?></a><br>
                <a>EMAIL: <?= $email ?></a><br>
                <a>ADDRESS: <?= $address ?></a><br>
                <a>CITY: <?= $city ?></a><br>
                <a>COUNTRY: <?= $country ?></a><br>
                <a>PHONE: <?= $phone ?></a><br>
            </div>
            <a align="center" id="test">
                <a style="cursor: pointer;" id="test" onclick="toggle<?= $id ?>(); togg<?= $id ?>()"> <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" width="32px" height="32px" viewBox="0 0 494.936 494.936" xml:space="preserve">
                        <g>
                            <g>
                                <path fill="#fff" d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157    c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21    s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741    c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z" />
                                <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069    c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963    c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692    C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107    l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005    c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z" />
                            </g>
                        </g>
                    </svg> </a>

                <a id="test" href="delete_member.php?id=<?= $id ?>" onClick="return confirm('Delete <? echo $row['firstname'] ?> ?')"> <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" x="0px" y="0px" viewBox="0 0 729.837 729.838" style="enable-background:new 0 0 729.837 729.838;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <path d="M589.193,222.04c0-6.296,5.106-11.404,11.402-11.404S612,215.767,612,222.04v437.476c0,19.314-7.936,36.896-20.67,49.653
				c-12.733,12.734-30.339,20.669-49.653,20.669H188.162c-19.315,0-36.943-7.935-49.654-20.669
				c-12.734-12.734-20.669-30.313-20.669-49.653V222.04c0-6.296,5.108-11.404,11.403-11.404c6.296,0,11.404,5.131,11.404,11.404
				v437.476c0,13.02,5.37,24.922,13.97,33.521c8.6,8.601,20.503,13.993,33.522,13.993h353.517c13.019,0,24.896-5.394,33.498-13.993
				c8.624-8.624,13.992-20.503,13.992-33.498V222.04H589.193z"></path>
                                    <path d="M279.866,630.056c0,6.296-5.108,11.403-11.404,11.403s-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.108-11.404,11.404-11.404s11.404,5.108,11.404,11.404V630.056z"></path>
                                    <path d="M376.323,630.056c0,6.296-5.107,11.403-11.403,11.403s-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.108-11.404,11.404-11.404s11.403,5.108,11.403,11.404V630.056z"></path>
                                    <path d="M472.803,630.056c0,6.296-5.106,11.403-11.402,11.403c-6.297,0-11.404-5.107-11.404-11.403v-405.07
				c0-6.296,5.107-11.404,11.404-11.404c6.296,0,11.402,5.108,11.402,11.404V630.056L472.803,630.056z"></path>
                                    <path d="M273.214,70.323c0,6.296-5.108,11.404-11.404,11.404c-6.295,0-11.403-5.108-11.403-11.404
				c0-19.363,7.911-36.943,20.646-49.677C283.787,7.911,301.368,0,320.73,0h88.379c19.339,0,36.92,7.935,49.652,20.669
				c12.734,12.734,20.67,30.362,20.67,49.654c0,6.296-5.107,11.404-11.403,11.404s-11.403-5.108-11.403-11.404
				c0-13.019-5.369-24.922-13.97-33.522c-8.602-8.601-20.503-13.994-33.522-13.994h-88.378c-13.043,0-24.922,5.369-33.546,13.97
				C278.583,45.401,273.214,57.28,273.214,70.323z"></path>
                                    <path d="M99.782,103.108h530.273c11.189,0,21.405,4.585,28.818,11.998l0.047,0.048c7.413,7.412,11.998,17.628,11.998,28.818
				v29.46c0,6.295-5.108,11.403-11.404,11.403h-0.309H70.323c-6.296,0-11.404-5.108-11.404-11.403v-0.285v-29.175
				c0-11.166,4.585-21.406,11.998-28.818l0.048-0.048C78.377,107.694,88.616,103.108,99.782,103.108L99.782,103.108z
				 M630.056,125.916H99.782c-4.965,0-9.503,2.02-12.734,5.274L87,131.238c-3.255,3.23-5.274,7.745-5.274,12.734v18.056h566.361
				v-18.056c0-4.965-2.02-9.503-5.273-12.734l-0.049-0.048C639.536,127.936,635.021,125.916,630.056,125.916z"></path>
                                </g>
                            </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                    </svg> </a>


                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data" id="edt<?= $id ?>" hidden="hidden">

                    <input placeholder="ID" type="text" name="id" id="id" readonly value="<?= $id ?>">


                    <input placeholder="First name" type="text" name="firstname" id="firstname" value="<?= $firstname ?>">


                    <input placeholder="Last name" type="text" name="lastname" id="lastname" value="<?= $lastname ?>">


                    <input placeholder="Email" type="text" name="email" id="email" value="<?= $email ?>">


                    <input placeholder="Address" type="text" name="address" id="address" value="<?= $address ?>">


                    <input placeholder="City" type="text" name="city" id="city" value="<?= $city ?>">


                    <input placeholder="Country" type="text" name="country" id="country" value="<?= $country ?>">


                    <input placeholder="Phone" type="text" name="phone" id="phone" value="<?= $phone ?>">


                    <input placeholder="New password" type="password" name="password" id="password" value="<?= $pass = null ?>">
                    <br></br>
                    <input style="display: none;" value="<?= $pic ?>" name="pic"> </input>
                    <img id="preview" src="<?= $pic ?>" name="pic" class="pic"> </img>
                    <br>
                    <a>Change profile picture</a>
                    <input type="file" name="the_file" id="the_file">
                    <label for="agree">Remove profile picture</label>
                    <input type="checkbox" name="agree[]" id="agree" value="<?= $profil_pic1 = null ?>">

                    <input style="    margin-top: 10px;" type="submit" name="update" id="submit" value="Update">

                </form>
                <script>
                    let toggle<?= $id ?> = () => {

                        let element = document.getElementById("edt<?= $id ?>");
                        let hidden = element.getAttribute("hidden");


                        if (hidden) {
                            element.removeAttribute("hidden");
                        } else {
                            element.setAttribute("hidden", "hidden");
                        }
                    }

                    let togg<?= $id ?> = () => {

                        let element = document.getElementById("edtdata<?= $id ?>");
                        let hidden = element.getAttribute("hidden");


                        if (hidden) {
                            element.removeAttribute("hidden");
                        } else {
                            element.setAttribute("hidden", "hidden");
                        }
                    }
                </script>
        </div>
        <?php
	}
?>
    </div>
    <br>
</body>

</html>
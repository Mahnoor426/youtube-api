<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

if(isset($_GET["code"]))
{
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
if(!isset($_SESSION['access_token']))
{
 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}
?>

<?php
$sname="localhost";
$uname="root";
$pass="";
$DBname="login_form";
$conn=mysqli_connect($sname,$uname,$pass,$DBname);
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM login_details WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["signinn"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: http://localhost/googleyoutubeapi/main.php");
			exit;
        }
        else{
            echo "<script> alert ('Wrong Password');</script>";
        }
    }
    else{
        echo "<script> alert ('User Not Registered');</script>";
    }
}
?>

<DOCTYPE html>
<html>

<head>
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
			<form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<h1>Sign in</h1>
					<div class="social-container">
						<a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
						<a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
						<a href="#" class="social"><i class="fa-brands fa-twitter"></i></a>
					</div>

					<div class="p-2 panel panel-default">
   <?php
   if($login_button == '')
   {
	header("Location: http://localhost/googleyoutubeapi/main.php");
			exit;
    echo '<h3><a href="logout.php">Logout</h3>';
  }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
</div>
					<span> </span>
					<input type="email" placeholder="Email" required value="" id="email" name="email" class="m-2" />
					<input type="password" placeholder="Password" required value="" id="password" name="password" />
					<a href="#">Forgot your password?</a>
					<button type="submit" name="submit" >Log in</button>
					
					<br>
					<p>Don't have an account?
						<a href="signup.php" class="social" id="ap">Register Now</a>
					</p>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
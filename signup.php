<?php
$sname="localhost";
$uname="root";
$pass="";
$DBname="login_form";
$conn=mysqli_connect($sname,$uname,$pass,$DBname);
if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO login_details VALUES ('$fullname','$username','$email','$password')";
    $results=mysqli_query($conn,$sql);
    if ($results==true)
    { header("Location: http://localhost/googleyoutubeapi/signinn.php");
      exit;}
}
?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
 </head>


 <body>
   <div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<h1>Sign up</h1>
					<div class="social-container">
						<a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
						<a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
						<a href="#" class="social"><i class="fa-brands fa-twitter"></i></a>
					</div>
      <input type="text" placeholder="Full Name" required value="" id="fullname" name="fullname" class="m-2">
		<input type="text" placeholder="Username" required value="" id="username" name="username" />
		<input type="email" placeholder="Email" required value="" id="email" name="email" class="m-2" />
		<input type="password" placeholder="Password" required value="" id="password" name="password" />
		<button type="submit" name="submit">Sign Up</button>
</form>
	</div>
   </div>
	</div>
 </body>
</html>
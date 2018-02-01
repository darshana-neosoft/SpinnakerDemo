<?php
error_reporting(E_ALL);

if(isset($_POST['submit']))
{
$dbhost = 'localhost';
$dbuser = 'QPS_user';
$dbpass = 'QPS_user';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
session_start();
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$myusername =$_POST['username'];
$mypassword =$_POST['password'];

$sql = "SELECT user_id FROM users WHERE user_name = '$myusername' and user_pass = '$mypassword'";
       
mysqli_select_db($conn,'QPSDatabase');
$retval = mysqli_query($conn,$sql);     
$count = mysqli_num_rows($retval);
if($count == 1) {
$_SESSION['login_user'] = $myusername;
$_SESSION['status']="Active";

header("location: home.html");
}
else {
      $error = "Your Username or Password is invalid";
      }
mysqli_close($conn);

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login</title>
	
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">

	<!-- libraries -->
	<link rel="stylesheet" type="text/css" href="css/compiled/font-awesome.css">

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="css/compiled/elements.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png">

	<!-- this page specific styles -->

	<!-- google font libraries -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--[if lt IE 8]>
		<link href="css/libs/font-awesome-ie7.css" type="text/css" rel="stylesheet" />
	<![endif]-->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-49262924-1', 'phoonio.com');
	  ga('send', 'pageview');

	</script>
	<style>
	  .screen{
   font-family: CenturyGothic;
  }
	body {
		
		background-image: url("img/Dynamic_flow_line_vector_background.jpg");
	  background-size: 100% 100%;
	}
	</style>
</head>
<body id="login-page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
			<h1 class="text-center screen" style ="color:#25509E;"><b>Sales Forecasting Model (SFM)</b></h1>
				<div id="login-box">
					<div class="row">
						<div class="col-xs-12 clearfix" id="login-box-header">
							
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div id="login-box-inner">
								<!-- <img src="img/logo-login.png" alt="SuperheroAdmin" class="img-responsive" id="login-logo"/> -->
								
							<div id="login-logo" style="margin-top: 1px; margin-bottom: 30px;">
									<img src="img/logo.png" alt="" ">
								</div>			
								<div style = "color:#cc0000;" class="input-group input-group-lg"><?php echo $error; ?></div>
								<form role="form" action="index.php" method="POST">
									<div class="input-group input-group-lg">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input class="form-control" placeholder="Username" name="username" required>
									</div>
									<div class="input-group input-group-lg">
										<span class="input-group-addon"><i class="fa fa-key"></i></span>
										<input type="password" class="form-control" placeholder="Password" name="password" required>
									</div>
									
									<div class="row">
										<div class="col-sm-12">
											
											<input type = "submit" class = "btn btn-lg btn-primary btn-block" value="Login" name="submit">

										</div>
										
									</div>
									<br>
							
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<p class="disclaimer"> All data used for the benefit of Spinnaker Analytics product demonstrations does not reflect actual proprietary data or any other client specific information. Actual client results and experience using Spinnaker products will differ based upon customization and client specific requirements.  All product demonstrations are for the sole use of our clients and prospects.  Any unauthorized use or distribution of Spinnaker Analytics products is expressly prohibited without the express written consent of Spinnaker Analytics LLC. </p>

	<!-- global scripts -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	
	<!-- this page specific scripts -->

	
	<!-- theme scripts -->
	<script src="js/scripts.js"></script>
	
	<!-- this page specific inline scripts -->
	
</body>
</html>
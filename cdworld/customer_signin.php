<?php 
error_reporting(0);
session_start();
include('include/connect.php');
if (isset($_POST['btnsignin'])) 
{
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];

	//$txtemail=mysqli_real_escape_string($txtemail);
	//$txtpassword=mysqli_real_escape_string($txtpassword);
	$check="SELECT * FROM customer
			WHERE email='$txtemail'
			and password='$txtpassword'";

	$ret=mysqli_query($con,$check);
	$count=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	if ($count==0) 
	{
		echo "<script>window.alert('Email or password do not match!')</script>";
		echo "<script>window.location='customer_signin	.php'</script>";
	}
	else
	{
		$_SESSION['customer_id']=$row['customer_id'];
		$_SESSION['first_name']=$row['first_name'];
		$_SESSION['last_name']=$row['last_name'];
		$firstname=$_SESSION['first_name'];
		echo "<script>window.alert('Welcome $firstname!')</script>";
		echo "<script>window.location='home_page.php'</script>";
	}
}
?>
<html>
<head>
	<title>Account Sign-In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="style1.css">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<form action="customer_signin.php" method="POST" enctype="multipart/form-data">
<table align="center">
<tr>
<td>
<ul class="menu cf">
  <li><a href="home_page.php">CD World</a></li>
  <li>
    <a href="movie.php">Movies</a>
    <ul class="submenu">
      <li><a href="">Action</a></li>
      <li><a href="">Animation</a></li>
      <li><a href="">Comedy</a></li>
      <li><a href="">Crime</a></li>
      <li><a href="">Documentary</a></li>
      <li><a href="">Drama</a></li>
      <li><a href="">Fantasy</a></li>
      <li><a href="">Foreign</a></li>
      <li><a href="">Horror</a></li>
      <li><a href="">Romantic</a></li>
      <li><a href="">Sci-Fi</a></li>
      <li><a href="">Thriller</a></li>
      <li><a href="">War</a></li>
      <li><a href="">Western</a></li>
    </ul>     
  </li>
  <li><a href="music.php">Music</a>
    <ul class="submenu">
      <li><a href="">Alternative</a></li>
      <li><a href="">Blues</a></li>
      <li><a href="">Classical</a></li>
      <li><a href="">Country</a></li>
      <li><a href="">Dance & Electronic</a></li>
      <li><a href="">Folk</a></li>
      <li><a href="">Heavy Metal</a></li>
      <li><a href="">Jazz</a></li>
      <li><a href="">Pop</a></li>
      <li><a href="">R&B</a></li>
      <li><a href="">Rap & Hip-Hop</a></li>
      <li><a href="">Reggae</a></li>
      <li><a href="">Rock</a></li>
      <li><a href="">Soundtracks</a></li>
    </ul> 
    </li>
  <li><a href="game.php">Games</a>
    <ul class="submenu">
      <li><a href="">Action</a></li>
      <li><a href="">Adventrue</a></li>
      <li><a href="">Fighting</a></li>
      <li><a href="">Horror</a></li>
      <li><a href="">Rhythm & Dance</a></li>
      <li><a href="">Platformer</a></li>
      <li><a href="">Puzzle</a></li>
      <li><a href="">Racing</a></li>
      <li><a href="">Role Playing</a></li>
      <li><a href="">Shooter</a></li>
      <li><a href="">Simulation</a></li>
      <li><a href="">Sport</a></li>
      <li><a href="">Strategy</a></li>
    </ul>
    </li>
    <li><a href="">ABOUT</a></li>
<?php if (!isset($_SESSION['customer_id']))
      {
        echo "<li><a href='customer_signin.php'>Sign-In</a></li>";
        //echo "<li><a href='customer_signup.php'>Sign-Up</a></li>";
      } 
      else
      {
        echo "<li><a href='logout.php'>Logout</a></li>"; 
      }
?>
</ul>
</td>
</tr>
</table>
	<table align="center" class="ggwp" cellpadding="10">
		<tr><td></td>
			<td><h1>Account Sign-In</h1></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="email" name="txtemail" placeholder="Email address..." class="textboxd1" style="width:270px;" required/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="txtpassword" placeholder="Password..." class="textboxd1" style="width:270px;" required/></td>
		</tr>
		<tr>
			<td><input type="submit" name="btnsignin" class="btnd" value="Sign-In"></td>
			<td><a href="customer_signup.php"><input type="button" class="btnd" style="width:270px;" value="Don't Have an Account?"></a></td>
		</tr>	
	</table>
</form>
</body>
</html>
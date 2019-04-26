<?php 
error_reporting(0);
session_start();
require('include/connect.php');
if (isset($_POST['btncreateaccount'])) 
{
//		$txtcustomerid=$_POST['txtcustomerid'];
		$txtfirstname=$_POST['txtfirstname'];
		$txtlastname=$_POST['txtlastname']; 
		$txtemail=$_POST['txtemail'];
		$txtpassword=$_POST['txtpassword'];
		$txtphone=$_POST['txtphone'];
		$txtaddress=$_POST['txtaddress'];
		$txtcity=$_POST['txtcity'];
		$txtcountry=$_POST['txtcountry'];
		$txtpostcode=$_POST['txtpostcode'];
//----------Check Email---------------------------------------------------
		$checkemail="SELECT * FROM customer WHERE email=$txtemail";
		$ret=mysqli_query($con,$checkemail);
		$count=mysqli_num_rows($ret);
			$insert="INSERT INTO customer (first_name,last_name,address,city,country,post_code,phone_number,email,password)
					VALUES ('$txtfirstname','$txtlastname','$txtaddress','$txtcity','$txtcountry','$txtpostcode','$txtphone','$txtemail','$txtpassword')";
			$ret=mysqli_query($con,$insert);
			if ($ret) 
			{
				echo "<script>window.alert('Account successfully created!')</script>";
				echo "<script>window.location='customer_signin.php'</script>";
			}
			else
			{
				echo "Error:" . $insert . "<br>" . mysqli_error($con);
			}
		
}

?><!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<script>
	function CheckValidation()
	{
		var password=document.getElementById('txtpassword').value;
		var repassword=document.getElementById('txtrepassword').value;
		var email=document.getElementById('txtemail').value;
		var reemail=document.getElementById('txtreemail').value;
		// check password length----------------------------------------
		if (password.length < 8 || password.length > 16)
		{
			alert('Passowrd length should be between 8 and 16 characters.');
			return false;
		};
		//--------------------------------------------------------------

		// check password-----------------------------------------------
		if (password != repassword) 
		{
			alert('Passwords do not match.');
			return false;
		};
		//--------------------------------------------------------------

		// check email--------------------------------------------------
		if (email != reemail) 
		{
			alert('Emails do not match');
			return false;
		};
		//--------------------------------------------------------------
	}
	</script>
</head>
<body> 
<form action="customer_signup.php" method="post" enctype="multipart/form-data">
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
	<tr>
		<td><h1>Account Sign-Up</h1></td>
	</tr>
<!--	<input type="" name="txtcustomerid" value="<?php echo hexdec(uniqid()); ?>"> -->
	<tr>
		<td>First Name</td>
		<td>Last Name</td>
	</tr>
	<tr>
		<td>
			<input type="text" name="txtfirstname" placeholder="Enter Your First Name" class="textboxd1" requried/>
		</td>
		<td>
			<input type="text" name="txtlastname" placeholder="Enter Your Last Name" class="textboxd1" requried/>
		</td>
	</tr>
	<tr>
		<td>Email Address</td>
		<td>Confrim Email Address</td>
	</tr>
	<tr>
		<td><input type="email" name="txtemail" id="txtemail" placeholder="Enter Your Email" class="textboxd1" requried/></td>
		<td><input type="email" name="txtreemail" id="txtreemail"  placeholder="Retype Your email" class="textboxd1" requried/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>Confirm Password</td>
	</tr>
	<tr>
		<td><input type="password" name="txtpassword" id="txtpassword" placeholder="Enter Your Password" class="textboxd1" required/></td>
		<td><input type="password" name="txtrepassword" id="txtrepassword" placeholder="Retype Your Password" class="textboxd1" required/></td>
	</tr>
	<tr>
		<td>Address</td>
		<td>Town/City</td>
	</tr>
	<tr>
		<td><textarea name="txtaddress" style="width:396px;" class="textboxd1" placeholder="Flat,building,floor,street name" required/></textarea></td>
		<td><input type="text" name="txtcity" placeholder="City or town name" class="textboxd1" required/></td>
	</tr>
	<tr>
		<td>Postcode</td>
		<td>Country</td>
	</tr>
	<tr>
		<td><input type="text" name="txtpostcode" placeholder="Enter your post code" class="textboxd1" required/></td>
		<td><input type="text" name="txtcountry" class="textboxd1" value="United Kingdom" required/></td>
	</tr>
	<tr>
		<td>Phone Number</td>
<!--	<td>Security Answer</td> -->
	</tr>
	<tr>
		<td><input type="text" name="txtphone" class="textboxd1" placeholder="Enter Your Phone Number" required/></td>
<!--	<td><input type="text" name="code" placeholder="Enter Security Code" class="search" required/></td> -->
	</tr>
<!--	<tr> 
		<td colspan="2" align="center">
		<img src="generatecaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg'/>
		<a href='javascript: refreshCaptcha();'>Refresh</a>
		<script Language='Javascript' type='text/javascript'>
		function refreshCaptcha()
		{
			var img=document.images['captchaimg'];
			img.src=img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
		}
		</script>
		</td>
	</tr> -->
	<tr>
		<td><input type="submit" name="btncreateaccount" class="btnd" value="Create Account" onClick="return CheckValidation()"/>
		<input type="reset" name="btnclear" class="btnd" value="Clear"/></td>
	</tr>
	</table>
</form>
</body>
</html>
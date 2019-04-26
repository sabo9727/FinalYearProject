<?php 
error_reporting(0);
session_start();
require ('include/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Games</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<form action="game.php" method="post" enctype="multipart/form-data">
<table align="center">
<tr>
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
        echo "<li><a href='customer_signup.php'>Sign-Up</a></li>";
      } 
      else
      {
        echo "<li><a href='logout.php'>Logout</a></li>"; 
      }
?>
</ul>
<td>
</td>
</tr>
</table>
<table align="center" cellpadding="15">
	<?php
	$select="SELECT * FROM product WHERE category_category_id = 'GAME'";
	$run=mysqli_query($con,$select);
	$count7=mysqli_num_rows($run);
	for($i=0;$i<$count7;$i+=3)
	{
		$select1="SELECT * FROM product WHERE category_category_id = 'GAME'
				ORDER BY product_name DESC
				LIMIT $i,3";
				
		$run1=mysqli_query($con,$select1);
		$count8=mysqli_num_rows($run1);
		echo "<tr>";
		for($x=0;$x<$count8;$x++)
		{
			$row=mysqli_fetch_array($run1);
			$txtproduct=$row['product_id'];
			$txtproductname=$row['product_name'];
			$txtprice=$row['product_price'];
			$imag1=$row['image1'];
	?>
			<td align="center" class="bar1">
				<a class="btnlink2" href="sale_product_detail.php?PID=<?php echo $productid; ?>"></a><img class="bar3" src="<?php echo 'productimages/'.$image1 ?>" width="100px" height="140px"/>
					<b><h3><?php echo $brandname ?></h3></b>
					<b><h3><?php echo $productname ?></h3></b>
					<b><h5><?php echo $saleprice ?> USD</h5></b>
					
			</td>
		<td></td>
		<?php
		}
		echo "</tr>";
	}

?>
	
</table>
</form>
</body>
</html>
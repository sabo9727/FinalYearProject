<?php 
error_reporting(0);
session_start();
include('include/connect.php');
	$txtproductid=$_REQUEST['product_id'];
	$query="SELECT p.*, c.category_id, c.category_name
		    FROM product p, category c
			WHERE product_id='$txtproductid'
			AND c.category_id=p.category_category_id";
	$ret=mysqli_query($con,$query);
	$num=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	$txtproductname=$row['product_name'];
	$txtcategoryname=$row['category_name'];
	$txtquantity=$row['product_quantity'];
	$txtprice=$row['product_price'];
	$txtreleasedate=$row['release_date'];
	$txtdescription=$row['description'];
	$image1=$row['image1'];
	$image2=$row['image2'];
?>
<html>
<head>
	<title>Product Detail</title>
	<script type="text/javascript">
 	function ChangePhoto(photosrc)
 	{
 		document.images.imgPhoto.src=photosrc;
 	}
 	</script>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<form action="ShoppingCart.php" method="get"/>
<table align="center" cellpadding="15">
  <td></td>
  <td><input type="text" class="textboxd1" name="txtdata"/></td>
  <td><input type="submit" class="btnd" name="btnsearch" value="Search"/></td>
</table>
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
        echo "<li><a href='customer_signup.php'>Sign-Up</a></li>";
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
<input type="hidden" name="txtproductid" value="<?php echo $productid ?>"/>
<input type="hidden" name="action" value="buy"/>
<table align="center" class="ggwp">

<tr>
	<td>
		<?php 
		$image2=$row['image2'];
		list($width, $height)=getimagesize('productimages/'.$image2);
        $w=$width/24;
		$h=$height/24;
		 ?>
		<img src="<?php echo 'productimages/'.$image1 ?>" width="250" height="350" id="imgPhoto"/><br>
		<img src="<?php echo 'productimages/'.$image1 ?>" width="50" height="70" onClick="ChangePhoto('<?php echo 'productimages/'.$image1 ?>')"/>
		<img src="<?php echo 'productimages/'.$image2 ?>" width="<?php echo $w ?>" height="<?php echo $h ?>" onClick="ChangePhoto('<?php echo 'productimages/'.$image2 ?>')"/>	
	</td>
	<td>
	<table align="center">
		<tr>		
			<td><h1><b><?php echo $txtproductname ?></b></h1></td>
		</tr>
		<tr>
			<td>Release Date: <?php echo $txtreleasedate ?></td>
			<td></td>
		</tr>
		<tr>
			<td><b><h2>£<?php echo $txtprice ?></h2></b></td>
		<td></td>
		</tr>
		<tr>
			<td>
			<?php 
			if ($txtquantity<=0) 
			{
				echo "<b style='color:red;'>Currently Unavailable</b>"; echo" ";
				echo "</br>";
				echo "<a href='home_page.php'><input type='button' value='Back'/></a>";
			}
			else
			{
				echo "<b style='color:red;'>In Stock Now!</b> Usually dispatched within 1 working day.";
				echo "</br>";
				echo "<input type='submit' class='btnd' name='btnadd' value='Add to Basket' class='btnbuy'/>"; echo" ";
				echo "<a href='home_page.php'><input type='button' class='btnd' value='Back'/></a>";
				echo "<br/><br/>";
				echo "<input type='hidden' class='textbox_qty' type='number' name='buyqty' value='1'/>";
			}
			 ?>
			 <input type="hidden" name="txtproductid" value="<?php echo $row['product_id']; ?>" />
			</td>
		</tr>
	</table>
	</td>
</tr>
</table>
</body>
</html>
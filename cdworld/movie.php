<?php 
error_reporting(0);
session_start();
require ('include/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Computing</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<form action="sale_computer.php" method="post" enctype="multipart/form-data">
<table align="center">
<tr>
<td>
	<ul class="menu cf">
  <li><a href="home.php">QUANTUM TECHNOLOGY</a></li>
  <li>
    <a href="sale_computer.php">Computing</a>
    <ul class="submenu">
      <li><a href="">MACBOOK</a></li>
      <li><a href="">PC</a></li>
      <li><a href="">GAMING</a></li>
      <li><a href="">WINDOWS LAPTOP</a></li>
    </ul>			
  </li>
  <li><a href="sale_phone.php">Phone</a></li>
  <li><a href="sale_tv.php">Television</a></li>
  <li><a href="">ABOUT</a></li>

</ul>
</td>
</tr>
</table>
<table align="center" cellpadding="15">
	
	<?php
		$select="SELECT * FROM product WHERE category_category_id = 'C-5cc0559ec58ee'";
	$run=mysqli_query($mysqli,$select);;
	$count7=mysqli_num_rows($run);

	for($i=0;$i<$count7;$i+=3)
	{
		$select1="SELECT * FROM product WHERE category_category_id = 'C-5cc0559ec58ee'
				ORDER BY product_id DESC
				LIMIT $i,3";
				
		$run1=mysqli_query($mysqli,$select1);
		$count8=mysqli_num_rows($run1);
		echo "<tr>";
		for($x=0;$x<$count8;$x++)
		{
			$row=mysqli_fetch_array($run1);
			$productid=$row['product_id'];
			$productname=$row['product_name'];
			$brandname=$row['brand_name'];
			$saleprice=$row['price'];
			$productimg1=$row['product_img1'];	
			//list($width,$height)=getimagesize($productimg2);
			//$w=$width/2;
			//$h=$height/2;
	?>
			<td align="center" class="bar1">
				<img class="bar3" src="<?php echo $productimg1 ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>"/>
					<b><h3><?php echo $brandname ?></h3></b>
					<b><h3><?php echo $productname ?></h3></b>
					<b><h5><?php echo $saleprice ?> USD</h5></b>
					<a class="btnlink2" href="sale_product_detail.php?PID=<?php echo $productid; ?>">Detail</a>
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
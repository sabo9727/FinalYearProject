<?php 
error_reporting(0);
session_start();
require ('include/connect.php');
if (isset($_REQUEST['Delete'])) 
{
	$productid=$_REQUEST['product_id'];
	$deletemovie="DELETE FROM movie WHERE product_product_id='$productid'";
	$deletemusic="DELETE FROM music WHERE product_product_id='$productid'";
	$deletegame="DELETE FROM game WHERE product_product_id='$productid'";
	$retmoive=mysqli_query($con,$deletemovie);
	if ($retmoive) 
	{
		$delete="DELETE FROM product WHERE product_id='$productid'";
		$ret=mysqli_query($con,$delete);
		if ($ret) 
		{
			echo "<script>window.alert('Sucessfully Deleted')</script>";
			echo "<script>window.location='product_listing.php'</script>";	
		}
		else
		{
			echo "Error:".$delete."<br>".mysqli_error($con);
		}
	}
	else
	{
		echo "Error:".$deletemovie."<br>".mysqli_error($con);
	}
	$retmusic=mysqli_query($con,$deletemusic);
	if ($retmoive) 
	{
		$delete="DELETE FROM product WHERE product_id='$productid'";
		$ret=mysqli_query($con,$delete);
		if ($retmusic) 
		{
			echo "<script>window.alert('Sucessfully Deleted')</script>";
			echo "<script>window.location='product_listing.php'</script>";	
		}
		else
		{
			echo "Error:".$delete."<br>".mysqli_error($con);
		}
	}
	else
	{
		echo "Error:".$deletemusic."<br>".mysqli_error($con);
	}		
	$retgame=mysqli_query($con,$deletegame);
	if ($retgame) 
	{
		$delete="DELETE FROM product WHERE product_id='$productid'";
		$ret=mysqli_query($con,$delete);
		if ($ret) 
		{
			echo "<script>window.alert('Sucessfully Deleted')</script>";
			echo "<script>window.location='product_listing.php'</script>";	
		}
		else
		{
			echo "Error:".$delete."<br>".mysqli_error($con);
		}
	}
	else
	{
		echo "Error:".$deletegame."<br>".mysqli_error($con);
	}		
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Product Listing</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="product_listing.php" method="post" enctype="multipart/form-data">
	<table align="center" cellpadding="4">
	<tr>
		<td><h1>Product Listing</h1></td>
	</tr>
	</table>
	<table align="center" cellpadding="4" border="1">
	<tr>
		<td>Product ID</td>
		<td>Product Name</td>
		<td>Category</td>
		<td>Status</td>
		<td>Price</td>
		<td>Quantity</td>
		<td>Release Date</td>
		<td>Description</td>		
		<td>Image1</td>
		<td>Image2</td>
		<td>Action</td>
		</tr>
<?php 
			$query="SELECT * FROM product ORDER BY product_name";
			$ret=mysqli_query($con,$query);
			$count=mysqli_num_rows($ret);
			for ($i=0; $i < $count; $i++) 
			{ 
				$row=mysqli_fetch_array($ret);
				$productid=$row['product_id'];
				echo "<tr class='table_row'>";
				echo "<td>" . $row['product_id'] . "</td>";
				echo "<td>" . $row['product_name']. "</td>";
				echo "<td>" . $row['category_category_id']. "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['product_price']. "</td>";
				echo "<td>" . $row['product_quantity']. "</td>";
				echo "<td>" . $row['release_date']. "</td>";
				echo "<td>" . $row['description']. "</td>";
				echo "<td>" . $row['image1']. "</td>";
				echo "<td>" . $row['image2']. "</td>";
				echo "<td><a href='product_update.php?product_id=$productid'>Edit</a> | 
				<a href='product_listing.php?product_id=$productid&Delete'>Delete</a></td>";
				echo "</tr>";
			}
?>
	</table>
	</form>
</body>
</html>

<?php 
//error_reporting(0);
session_start();
require ('include/connect.php');
//require ('function.php');
if (isset($_POST['btnaddproduct'])) 
{
	$txtproductid=$_POST['txtproductid'];
	$txtproductname=$_POST['txtproductname'];
	$cbocategoryid=$_POST['cbocategoryid'];
	$rdostatus=$_POST['rdostatus'];
	$txtprice=$_POST['txtprice'];
	$txtquantity=$_POST['txtquantity'];
	$txtdescription=$_POST['txtdescription'];
	$releasedate=$_POST['releasedate'];

//Image Upload-----------------------------------
	$folder="productimages/";
	$image1=$_FILES['txtimage1']['name'];
	$image2=$_FILES['txtimage2']['name'];
	if ($image1) 
	{
		$filename1=$folder.''.$image1;
		$copied=copy($_FILES['txtimage1']['tmp_name'],$filename1);
		if (!$copied) 
		{
			exit("Problem Occur in Image Upload");
		}
	}
		
	if ($image2) 
	{
		$filename2=$folder.''.$image2;
		$copied=copy($_FILES['txtimage2']['tmp_name'],$filename2);
		if (!$copied) 
		{
			exit("Problem Occur in Image Upload");
		}
	}
//-----------------------------------------------End of code
//------------Check Data and insert-----------------------------------
	$checkname="SELECT * FROM product WHERE product_name='$txtproductname'";
	$ret=mysqli_query($con,$checkname);
	$count=mysqli_num_rows($ret);
	if($count != 0)
	{
		echo "<script>window.alert('Product Already Exist')</script>";
		echo "<script>window.location='product_entry.php'</script>";
	}
	else
	{
		$insert="INSERT INTO product(product_id,product_name,product_price,release_date,status,image1,image2,description,category_category_id,product_quantity)
				VALUES ('$txtproductid','$txtproductname','$txtprice','$releasedate','$rdostatus','$image1','$image2','$txtdescription','$cbocategoryid','$txtquantity')";
		$ret=mysqli_query($con,$insert);
		if ($ret) 
		{
			echo "<script> window.alert('Your Product is added to the database!') </script>";
			echo "<script> window.location='product_entry.php' </script>";
		}
		else
		{
			echo "Error:".$insert ."<br>".mysqli_error($con);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Product Entry</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="product_entry.php" method="post" enctype="multipart/form-data">
	<table align="center" cellpadding="4">
	<tr>
		<td><h1>Product Entry Form</h1></td>
	</tr>
</table>
<table align="center" cellpadding="6" >	
	<tr>
		<td>Product ID</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtproductid" style="width:250px";></td>
	</tr>
	<tr>
		<td>Product Name</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtproductname" class="search" style="width:250px";></td>
	</tr>		
	<tr>
		<td>Category</td>
		<td>&nbsp; &nbsp;
			<select name="cbocategoryid" class="search" style="width:130px";>
			<option>Choose Category</option>
			<?php 
			$select="SELECT * FROM category";
			$ret=mysqli_query($con,$select);
			$count=mysqli_num_rows($ret);
			for ($i=0; $i <$count ; $i++) 
			{ 
				$row=mysqli_fetch_array($ret);		
				$categoryid=$row['category_id'];
				echo "<option value='$categoryid'>$categoryid</option>";
			}
			 ?></select>
		</td>
	</tr>
	<tr>
	<tr>
		<td>Status</td>
		<td> 
			<input type="radio" name="rdostatus" value="In Stock" checked/>In Stock
			<input type="radio" name="rdostatus" value="Out of Stock"/>Out of Stock
		</td>
		</tr>
		<td>Price</td>
		<td>£<input type="number" name="txtprice" step="any" class="search" style="width:70px;"></td>
	</tr>
	<tr>
		<td>Quantity</td>
		<td>&nbsp;&nbsp;<input type="number" name="txtquantity" class="search" style="width:70px";></td>
	</tr>
		<tr>
		<td>Release Date</td>
		<td>&nbsp;&nbsp;<input type="date" name="releasedate" class="search" style="width:130px";></td>
	</tr>
	<tr>
		<td>Description</td>
		<td>&nbsp;&nbsp;<textarea name="txtdescription" class="search" style="width:250px"></textarea></td>
	</tr>
	<tr>
		<td>Image 1</td>
		<td>&nbsp;&nbsp;<input type="file" name="txtimage1" class="upload"></td>
	</tr>
	<tr>
		<td>Image 2</td>
		<td>&nbsp;&nbsp;<input type="file" name="txtimage2" class="upload"></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;
			<input type="submit" name="btnaddproduct" value="Add Product">
			<input type="reset" value="Clear">
		</td>
	</tr>
</table>
</form>
</body>
</html>
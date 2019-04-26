<?php 
	error_reporting(0);
	session_start();
	require ('include/connect.php');
	if (isset($_REQUEST['product_id'])) 
	{
		$productid=$_REQUEST['product_id'];
		$query="SELECT p.*,c.category_id
				FROM product p,category c
				WHERE product_id='$productid' AND c.category_id=p.category_category_id";
		$ret=mysqli_query($con,$query);
		$num=mysqli_num_rows($ret);
		$row=mysqli_fetch_array($ret);
		//$txtproductid=$row['product_id'];
		$txtproductname=$row['product_name'];
		$cbocategoryid=$row['category_category_id'];
		$rdostatus=$row['status'];
		$txtprice=$row['product_price'];
		$txtquantity=$row['product_quantity'];
		$txtdescription=$row['description'];
		$releasedate=$row['release_date'];
		$image1=$row['image1'];
		$image2=$row['image2'];
	}
	if (isset($_POST['btnupdate'])) 
	{
		$u_productid=$_POST['productid'];
		$u_productname=$_POST['txtproductname'];
		$u_categoryid=$_POST['cbocategoryid'];		
		$u_status=$_POST['rdostatus'];
		$u_price=$_POST['txtprice'];		
		$u_quantity=$_POST['txtquantity'];
		$u_description=$_POST['txtdescription'];
		$u_releasedate=$_POST['releasedate'];
		//Image Upload-----------------------------------
		$folder="productimages/";
		$u_image1=$_FILES['txtimage1']['name'];
		$u_image2=$_FILES['txtimage2']['name'];
		if ($u_image1) 
		{
			$filename1=$folder.''.$u_image1;
			$copied=copy($_FILES['txtimage1']['tmp_name'],$filename1);
			if (!$copied) 
			{
				exit("Problem Occur in Image Upload");
			}
		}		
		if ($u_image2) 
		{
			$filename2=$folder.''.$u_image2;
			$copied=copy($_FILES['txtimage2']['tmp_name'],$filename2);
			if (!$copied) 
			{
				exit("Problem Occur in Image Upload");
			}
		}
		//-----------------------------------------------
		$update="UPDATE product
				 SET product_name='$u_productname',category_category_id='$u_categoryid',status='$u_status', product_price='$u_price', product_quantity='$u_quantity',
				 description='$u_description',release_date='$u_releasedate',image1='$u_image1', image2='$u_image2'
				 WHERE product_id='$u_productid'";
		$ret=mysqli_query($con,$update);
		if ($ret) 
		{
			echo "<script>window.alert('Sucessfully Updated!')</script>";
			echo "<script>window.location='product_listing.php'</script>";
		}
		else
		{
			echo "Error:".$insert ."<br>".mysqli_error($con);
		}		
	}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Product Update</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="product_update.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="productid" value="<?php echo $productid ?>"/>
	<table align="center" cellpadding="4">
	<tr>
		<td><h1>Product Update Form</h1></td>
	</tr>
	</table>
	<table align="center" cellpadding="6" >	
	<tr>
		<td>Product ID</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtproductid" value="<?php echo $productid ?>" style="width:250px";></td>
	</tr>
	<tr>
		<td>Product Name</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtproductname" value="<?php echo $txtproductname ?>" style="width:250px";></td>
	</tr>		
	<tr>
		<td>Category</td>
		<td>&nbsp; &nbsp;
			<select name="cbocategoryid" value="<?php echo $cbocategoryid ?>" style="width:130px";>
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
		<td>£<input type="number" name="txtprice" value="<?php echo $txtprice ?>" step="any" style="width:70px;"></td>
	</tr>
	<tr>
		<td>Quantity</td>
		<td>&nbsp;&nbsp;<input type="number" name="txtquantity" value="<?php echo $txtquantity ?>" style="width:70px";></td>
	</tr>
		<tr>
		<td>Release Date</td>
		<td>&nbsp;&nbsp;<input type="date" name="releasedate" value="<?php echo $releasedate ?>" style="width:130px";></td>
	</tr>
	<tr>
		<td>Description</td>
		<td>&nbsp;&nbsp;<textarea name="txtdescription" class="search" style="width:250px; height:200px;"><?php echo $txtdescription ?></textarea></td>
	</tr>
	<tr>
		<td>Image 1</td>
		<td>&nbsp;&nbsp;<input type="file" name="txtimage1" value="<?php echo $image1 ?>"></td>
	</tr>
	<tr>
		<td>Image 2</td>
		<td>&nbsp;&nbsp;<input type="file" name="txtimage2" value="<?php echo $image2 ?>"></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;
			<input type="submit" name="btnupdate" value="Update"/>
			<input type="reset" value="Clear">
			<a href="product_listing.php"><input type="button" value="Back" ></a>
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
error_reporting(0);
session_start();
require ('include/connect.php');
if (isset($_POST['btnsave'])) 
{
	$txtcategoryid=$_POST['txtcategoryid'];
	$txtproductid=$_POST['cboproductid'];
	$txtmoviename=$_POST['txtmoviename'];
	$txtdirectorname=$_POST['txtdirectorname'];
	$txtstudioname=$_POST['txtstudioname'];
	$txtmoviegenre=$_POST['txtmoviegenre'];
	$txtduration=$_POST['txtduration'];
	$insert="INSERT INTO movie(movie_name,director_name,studio_name,movie_genre,duration,product_product_id,product_category_category_id)
			VALUES ('$txtmoviename','$txtdirectorname','$txtstudioname','$txtmoviegenre','$txtduration','$txtproductid','$txtcategoryid')";
	$ret=mysqli_query($con,$insert);
	if ($ret) 
	{
		echo "<script> window.alert('Movie is added to the database!')</script>";
		echo "<script> window.location='movie_entry.php'</script>";
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
	<title>Movie Entry Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="movie_entry.php" method="post" enctype="multipart/form-data">
	<table align="center" cellpadding="4">
	<tr>
		<td><h1>Movie Entry Form</h1></td>
	</tr>
</table>
<table align="center" cellpadding="6" >
	<tr>
		<td>Product Name</td>
		<td>&nbsp;&nbsp;
			<select name="cboproductid" style="width:400px";>
			<option>Choose Product</option>
			<?php 
			$select="SELECT p.product_name,p.product_id,c.category_id FROM product p,category c
					WHERE c.category_id=p.category_category_id 
					AND p.category_category_id='MOVIE'";
			$ret=mysqli_query($con,$select);
			$count=mysqli_num_rows($ret);
			for ($i=0; $i <$count ; $i++) 
			{ 
				$row=mysqli_fetch_array($ret);
				$txtproductname=$row['product_name'];
				$txtproductid=$row['product_id'];
				echo "<option value='$txtproductid'>$txtproductid - $txtproductname</option>";
			}	
			?>
			 </select>
		</td>
	</tr>
	<tr>
		<td><input type="hidden" name="txtcategoryid" value="MOVIE"/></td>
	</tr>
	<tr>
		<td>Movie Name</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtmoviename" style="width:250px";></td>
	</tr>		
	<tr>
		<td>Director</td>
		<td>&nbsp; &nbsp;<input type="text" name="txtdirectorname" style="width:250px";>
		</td>
	</tr>
	<tr>
		<td>Studio</td>
		<td>&nbsp;&nbsp; <input type="text" name="txtstudioname" style="width:250px";></td>
	</tr>
	<tr>
		<td>Genre</td>
		<td>&nbsp;&nbsp; <input type="text" name="txtmoviegenre" style="width:250px";></td>
	</tr>
	<tr>
		<td>Duration</td>
		<td>&nbsp;&nbsp; <input type="text" name="txtduration" style="width:50px";>mins</td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;
			<input type="submit" name="btnsave" value="Save">
			<input type="reset" value="Clear">
		</td>
	</tr>
</table>
</form>
</body>
</html>
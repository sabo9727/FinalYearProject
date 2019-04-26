<?php
error_reporting(0);
session_start();
include("include/connect.php");
function Insert($txtproductid,$txtquantity)
{
	$sql="SELECT * FROM product WHERE product_id='$txtproductid'";
	$ret=mysqli_query($con,$sql);
	if(mysqli_num_rows($ret)<1)
	{
		 return false;
	}	
	$row=mysqli_fetch_array($ret);
	$txtproductname=$row['product_name'];
	$txtprice=$row['product_price'];
	$totalquantity=$row['product_quantity']; 
	$image1=$row['image1'];
	if ($txtquantity > $totalquantity)
	{
		echo'<script>window.alert("Please Enter Correct Quantity") </script>';
		echo'<script>window.location="product_detail.php?ProductID='.$txtproductid.'";</script>';
	}
	if($txtquantity==0)
	{
		echo'<script>window.alert("Product Quantity Cannot Be Zero") </script>';
		echo'<script>window.location="product_detail.php?ProductID='.$txtproductid.'";</script>';
	}
	if(isset($_SESSION['ShoppingCart']))
	{
		$index=IndexOf($txtproductid);
		
		if($index==-1)
		{
			$size=count($_SESSION['ShoppingCart']);
			
			$_SESSION['ShoppingCart'][$size]['product_id']=$txtproductid;
			$_SESSION['ShoppingCart'][$size]['product_name']=$txtproductname;
			$_SESSION['ShoppingCart'][$size]['image1']=$image1;
			$_SESSION['ShoppingCart'][$size]['product_price']=$txtprice;
			$_SESSION['ShoppingCart'][$size]['product_quantity']=$txtquantity;
		}
		else
		{
			$_SESSION['ShoppingCart'][$index]['product_id']=$txtproductid;
			$_SESSION['ShoppingCart'][$index]['product_name']=$txtproductname;
			$_SESSION['ShoppingCart'][$index]['image1']=$image1;
			$_SESSION['ShoppingCart'][$index]['product_price']=$txtprice;
			$_SESSION['ShoppingCart'][$index]['product_quantity']=$txtquantity;
		}
	}
	else
	{
		$_SESSION['ShoppingCart']=array();
		$_SESSION['ShoppingCart'][0]['product_id']=$txtproductid;
		$_SESSION['ShoppingCart'][0]['product_name']=$txtproductname;
		$_SESSION['ShoppingCart'][0]['image1']=$image1;
		$_SESSION['ShoppingCart'][0]['product_price']=$txtprice;
		$_SESSION['ShoppingCart'][0]['product_quantity']=$txtquantity;
	}
	echo "<script>window.location='ShoppingCart.php'</script>";
}
//----------------------------------------------------------------------------------------------------------------
function Remove($txtproductid)
{
	$index=IndexOf($txtproductid);
	
	if ($index>-1)
	{
		unset($_SESSION['ShoppingCart'][$index]);
	}
	$_SESSION['ShoppingCart']=array_values($_SESSION['ShoppingCart']);
	echo "<script>window.location='ShoppingCart.php'</script>";
}

function Clear()
{
	unset($_SESSION['ShoppingCart']);
	echo "<script>window.location='ShoppingCart.php'</script>";
}
	
function Get_TotalAmount()
{
	if (!isset($_SESSION['ShoppingCart']))
	{
		return 0;
	}
	$total=0;
	$size=count($_SESSION['ShoppingCart']);
	
	for($i=0;$i<$size;$i++)
	{
		$txtquantity=$_SESSION['ShoppingCart'][$i]['product_quantity'];
		$txtprice=$_SESSION['ShoppingCart'][$i]['product_price'];
		$total=$total+($txtquantity * $txtprice);
	}
	
	return $total;
}
function AdvanceAmount()
{
	if (!isset($_SESSION['ShoppingCart']))
	{
		return 0;
	}
	$total=0;
	$size=count($_SESSION['ShoppingCart']);
	
	for($i=0;$i<$size;$i++)
	{
		$txtquantity=$_SESSION['ShoppingCart'][$i]['product_quantity'];
		$txtprice=$_SESSION['ShoppingCart'][$i]['product_price'];
		$total=$total+($txtquantity * $txtprice);
		$advanceamount=$total / 3;
	}
	return $advanceamount;
}
function Get_TotalQuantity()
{
	if (!isset($_SESSION['ShoppingCart']))
	{
		return 0;
	}
	
	$totalqty=0;
	$size=count($_SESSION['ShoppingCart']);
	
	for($i=0;$i<$size;$i++)
	{
		$txtquantity=$_SESSION['ShoppingCart'][$i]['product_quantity'];
		$totalqty=$totalqty+($txtquantity);
	}
	
	return $totalqty;
}

function IndexOf($txtproductid)
{
	if (!isset($_SESSION['ShoppingCart']))
		return -1;
		
	$size=count($_SESSION['ShoppingCart']);
	
	if ($size==0)
		return -1;
		
	for ($i=0;$i<$size;$i++)
	{
		if ($txtproductid==$_SESSION['ShoppingCart'][$i]['product_id'])
		{
			return $i;
		}
	}
	return -1;
}

?>
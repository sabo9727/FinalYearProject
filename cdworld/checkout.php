<?php 
session_start();
include("include/connect.php");
include("ShoppingCartFunction.php");
include("AutoID_Functions.php");

$txtcustomerid=$_SESSION['customer_id'];
$txtfirstname=$_SESSION['first_name'];
$txtlastname=$_SESSION['last_name'];

if(!isset($_SESSION['customer_id'])) 
{
	echo "<script>window.alert('Please login first to continue.')</script>";
	echo "<script>window.location='customer_signin.php'</script>";
}
if(isset($_POST['btncancel']))
{
	session_destroy();
	session_regenerate_id();
	echo "<script>window.location='customer_signin.php'</script>";
}
if(isset($_POST['btncheckout']))
{
	$txtorderid=$_POST['txtorderid'];
	$txtcustomerid=$_SESSION['customer_id'];
	//-------------------------------------------------
	$OrderDate=date('Y-m-d');
	$TotalAmount=$_POST['txtincludetax'];
	$TotalQuantity=$_POST['txttotalquantity'];
	$Tax=$_POST['txttax'];
	$Status="Pending";

	$OrderInsert="INSERT INTO orders
				 (OrdersID,CustomerID,OrdersDate,OrdersStatus,TotalAmount,TotalQuantity,Tax) 
				 VALUES 
				 ('$OrderID','$CustomerID','$OrderDate','$Status','$TotalAmount','$TotalQuantity','$Tax')";
	$ret=mysql_query($OrderInsert);
	
	$count=count($_SESSION['ShoppingCart']);	

	for ($i=0;$i<$count;$i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCart'][$i]['ProductID'];
		$Price=$_SESSION['ShoppingCart'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart'][$i]['Quantity'];

		$OrderDetail="INSERT INTO OrdersDetail
					  (OrdersID,ProductID,Price,Quantity) 
					  VALUES 
					  ('$OrderID','$ProductID','$Price','$Quantity')";
		$ret=mysql_query($OrderDetail);

		$UpdateProductQty="UPDATE Product 
						   SET Quantity=Quantity-'$Quantity'
						   WHERE ProductID='$ProductID'";
		$ret=mysql_query($UpdateProductQty);
	}

	if ($ret) 
	{
		echo "<script>window.alert('Checkout Process Completed.')</script>";
		echo "<script>window.location='Product_Display.php'</script>";
	}
	else
	{
		echo "<p>Error in Checkout Page : " . mysql_error() .  "</p>";
	}
}
?>
<html>
<head>
	<title>Checkout</title>
	<script type="text/javascript">
	function show()
	{ 
		document.getElementById('deliveryinfo').style.display = 'block'; 
	}
	function hide() 
	{ 
		document.getElementById('deliveryinfo').style.display = 'none'; 
	}</script>
</head>
<body>
<form acton="checkout.php" method="post">
<fieldset>
	<legend>Checkout</legend>
<table align="center">
<tr>
	<td>Order ID</td>
	<td>
		<input type="text" name="txtorderid" value="<?php echo AutoID('order','order_id','',6) ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Order Date</td>
	<td> 
		<input type="text" name="txtorderdate" value="<?php echo date('d-M-Y') ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Customer Name</td>
	<td><input type="text" name="txtcustomername" value="<?php echo $txtfirstname.' '.$txtlastname  ?>" readonly/></td>
</tr>
<tr>
	<td>Total Quantity</td>
	<td><input type="text" name="txttotalquantity" value="<?php  $txttotalquantity=Get_TotalQuantity();
	echo $txttotalquantity ?>" readonly/></td>
</tr>
<tr>
	<td>Total Amount</td>
	<td>: <input text="txttoalamount" value="<?php 
		$txttotalamount=Get_TotalAmount();
		echo $txttotalamount
	 	?>" readonly/></td>
</tr>
<tr>
	<td>Payment Type</td>
	<td>: <input type="radio" name="rdopaymenttype" value="CashonDelivery" checked><img src="images/Cash_on_Delivery.png" width="25" height="20"/> 
		<input type="radio" name="rdopaymenttype" value="Myanpay"><img src="images/MyanPay_Logo.png" width="33" height="20"/> 
		<input type="radio" name="rdopaymenttype" value="Visa"><img src="images/visa.png" width="30" height="20"/>
		<br/>
		<input type="text" name="txtcardinfo" placeholder="Bank Card Pin No"/>
	</td>
</tr>
<tr>
	<td>Delivery Type</td>
	<td>
	: <input type="radio" name="rdodeliverytype" value="same" onClick="hide()" checked>Same Address
	<input type="radio" name="rdodeliverytype" value="other" onClick="show()">Other Address
	</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="submit" name="btnCheckout" value="Checkout"/>
	<input type="submit" name="btnCancel" value="Cancel"/>
	<input type="reset" value="Clear"/>
	</td>
</tr>
</table>
	<div style="display:none" id="deliveryinfo">
	<fieldset>
	<legend>Enter Delivery Info :</legend>
		<p>Delivery Phone</p>
		: <input type="text" name="txtphone" placeholder="+95--------"/>

		<p>Delivery Address</p>
		: <textarea name="txtaddress"></textarea>
	</fieldset>
	</div>
</table>
</fieldset>
</form>
</body>
</html>
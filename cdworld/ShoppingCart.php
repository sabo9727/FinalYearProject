<?php
//error_reporting(0);
session_start();
require('include/connect.php');
require('ShoppingCartFunction.php');
//-------------------------------
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action="";
}
//------------------------------
if($action==="buy")
{
	$txtproductid=$_GET['txtproductid'];
	$txtquantity=$_GET['buyqty']; 
	Insert($txtproductid,$txtquantity);
}
elseif($action==="remove")
{
	$txtproductid=$_GET['txtproductid'];
	Remove($txtproductid);		
}
elseif($action==="clear")
{
	Clear();
}
?>
<title>Shopping Cart</title>
</head>
<body>
<fieldset>
<legend>Your Shopping Cart :</legend>
<table align="center" >
<tr>
	<td>
    <hr/>
    <?php
	if(!isset($_SESSION["ShoppingCart"]))
    {
        echo "<p>Your Shopping Cart is Empty</p>";
        echo "<img src='images/Shoppingcart_empty.png' width='150' height='150' />";
        echo "<p>Total Amount : 0</p>";
        echo "<a href='home_page.php'>Home Page</a>";
        exit();
    }
    ?>
    </td>
</tr>
</table>
<table class='#' align="center" width="100%" height="100%" border="1" cellspacing="5px">
    <tr>
        <th>Image</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sub Amount</th>
		<th>Action</th>
    </tr>
    <?php
	$size=count($_SESSION['ShoppingCart']);	  
	for($i=0;$i<$size;$i++)
	{
	?>
        <tr>
           <?php
				$img=$_SESSION['ShoppingCart'][$i]['Image1'];
				list($width, $height, $type, $attr)=getimagesize($img);
				$w=$width/7;
				$h=$height/7;
			?>
			<th align="center">
				<img src="<?php echo $_SESSION['ShoppingCart'][$i]['Image1']?>" 
				width="<?php echo $w ?>" height="<?php echo $h ?>" />
			</th>
			<th><?php echo $_SESSION['ShoppingCart'][$i]['ProductName']?></th>
			<th><?php echo $_SESSION['ShoppingCart'][$i]['Price']?> MMK</th>
			<th>
                <input type="text" value="<?php echo $_SESSION['ShoppingCart'][$i]['Quantity']?>" name="txtqty" id="txtqty" size="1" onkeypress="CalculateQty()"/></td>
            <th>
            <?php echo $_SESSION['ShoppingCart'][$i]['Quantity'] * $_SESSION['ShoppingCart'][$i]['Price']?> MMK
            </th>
            <th>
                <a href="ShoppingCart.php?action=remove&ProductID=<?php echo $_SESSION['ShoppingCart'][$i]['ProductID']?>">Remove</a>
            </th>
        </tr>
        <tr>
            <td colspan="9">
            </td>
        </tr>
    <?php
	}
	?>
    <tr>
    	<td colspan="9" align="right">
            <table>
                <tr>
                    <td>
                        <br/>
                        <h2 class="paid_label">Total Amount&nbsp;&nbsp;: <?php echo Get_TotalAmount() ?> MMK</h1>
                        <h2 class="paid_label">Total Quantity&nbsp;: <?php echo Get_TotalQuantity() ?> pcs</h1>
                        <hr class="reddot" />
                        <a class="btn btn-success" href="Product_Display.php">Product Display</a>&nbsp; |
                        <a class="btn btn-danger" href="ShoppingCart.php?action=clear">Empty Cart</a>&nbsp; |
                        <a class="btn btn-primary" href="CheckOut.php">Check Out</a>
                    </td>
                </tr>
				<tr>
				<td>
                <br />
				<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
				<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
				</td>
				</tr>
            </table>
        </td>
    </tr>
    </table>
</fieldset>
</body>
</html>
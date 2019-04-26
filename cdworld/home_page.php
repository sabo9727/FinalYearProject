<?php 
error_reporting(0);
session_start();
require ('include/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="style1.css">
<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<form action="home_page.php" method="post" class="bar" enctype="multipart/form-data">
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
<table align="center" cellpadding="15">
<?php 
    if (isset($_POST['btnsearch'])) 
    {
      $data=$_POST['txtdata'];
      $searchdata="Select * from product 
                  where product_name like'%$data%'
                    order by product_price desc";
            $ret=mysqli_query($con,$searchdata);
            $num_result=mysqli_num_rows($ret);
            if ($num_result==0) 
            {
              echo "<script>window.alert('No match found.')</script>";
              echo "<script>window.location='home_page.php'</script>";
            }
            else
            {
              for ($a=0; $a < $num_result; $a+=4) 
              { 
                $product="Select * from product 
                  where product_name like'%$data%'
                    order by product_price desc     
                      LIMIT $a,4";
                $retp=mysqli_query($con,$product);
                $num_resultp=mysqli_num_rows($retp);
                echo "<tr>";
                for ($b=0; $b < $num_resultp; $b++) 
                { 
                  $row=mysqli_fetch_array($ret);
                  $image1=$row['image1'];
                  list($width, $height)=getimagesize('productimages/'.$image1);
                  $w=$width/6;
                  $h=$height/6;
                  ?>
                  <td height="330" class="ggwp">
                    <a href="product_detail.php?product_id=<?php echo $row['product_id'] ?>">
                    <img src="<?php echo 'productimages/'.$image1 ?>" width='<?php echo $w ?>' height='<?php echo $h ?>'/></a>
                    <br>
                    <b><?php echo $row['product_name']; ?></b>
                    <br>
                    <b>£<?php echo $row['product_price']; ?></b>
                    <br><br>
                  </td>
                  <?php
                }
                echo "</tr>";
              }
            }
          }
          

else {  $select="SELECT p.* FROM product p,category c
          WHERE p.category_category_id=c.category_id 
          ORDER BY release_date ASC";
  $ret=mysqli_query($con,$select);
  $count7=mysqli_num_rows($ret);
  for($i=0;$i<$count7;$i+=3)
  {
    $select1="SELECT * FROM product p,category c WHERE p.category_category_id=c.category_id 
        ORDER BY product_id ASC
        LIMIT $i,3";
        
    $ret1=mysqli_query($con,$select1);
    $count8=mysqli_num_rows($ret1);
    echo "<tr>";
    for($x=0;$x<$count8;$x++)
    {
      $row=mysqli_fetch_array($ret1);
      $productid=$row['product_id'];
      $categoryid=$row['category_category_id'];
      $productname=$row['product_name'];
      $price=$row['product_price'];
      $image1=$row['image1'];  
?>
      <td align="center" class="ggwp"/>
        <a href="product_detail.php?product_id=<?php echo $row['product_id'] ?>">
        <img src="<?php echo 'productimages/' .  $image1 ?>" width="100px" height="140px" />
        </a>    
        <b><h3><?php echo $productname ?> </h3></b>
        <b><h5>£<?php echo $price ?></h5></b>
      </td>
    <td></td>
    <?php
    }
    echo "</tr>";
  }
}
?>
</table>
</form>
</body>
</html>

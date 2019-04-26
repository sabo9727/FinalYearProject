<?php
$host='localhost';
$user='root';
$pass="";
$database='cdworlddb';
$con=mysqli_connect($host,$user,$pass,$database);
// Check connection
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	/*else
	{
		echo "Successfully connected to MySQL";
	}*/
?>
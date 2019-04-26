<?php
function AutoID($tableName,$fieldName,$prefix,$noOfLeadingZeros)
{
	$newID="";
	$sql="";
	$value=1;
	
	$sql="SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " DESC";	
	
	$result = mysql_query($sql);
	$noOfRow=mysql_num_rows($result);
	$row = mysql_fetch_array($result);		
	
	if ($noOfRow<1)
	{		
		return $prefix . "000001";
	}
	else
	{
		$oldID=$row[$fieldName];	//Reading Last ID
		$oldID=str_replace($prefix,"",$oldID);	//Removing "Prefix"
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$prefix . NumberFormatter($value,$noOfLeadingZeros);			
		return $newID;		
	}
}

function NumberFormatter($number,$n) 
{	
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}
?>

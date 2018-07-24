<?php // require_once('Connections/condb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_prdt = "-1";
if (isset($_GET['p_id'])) {
  $colname_prdt = $_GET['p_id'];
}
mysql_select_db($database_condb, $condb);
$query_prdt = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_prdt, "int"));
$prdt = mysql_query($query_prdt, $condb) or die(mysql_error());
$row_prdt = mysql_fetch_assoc($prdt);
$totalRows_prdt = mysql_num_rows($prdt);


//update product view
$p_id = $row_prdt['p_id'];
$p_view = $row_prdt['p_view'];
$count = $p_view + 1;

$sql= "UPDATE tbl_product SET  p_view=$count WHERE p_id = $p_id";
	mysql_db_query($database_condb,$sql);
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include('h.php');?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
	<div class="col-sm-5">
    	<img src="pimg/<?php echo $row_prdt['p_img1'];?>" class="img img-responsive">
      <br>
      <img src="pimg/<?php echo $row_prdt['p_img2'];?>" class="img img-responsive">
    </div>
    <div class="col-md-7">
   <h4>  ชื่อสินค้า :  <?php echo $row_prdt['p_name']; ?> </h4>
    รายละเอียด : <?php echo $row_prdt['p_detial']; ?>  
    <font color="blue">
    <h3> ราคา <?php echo $row_prdt['p_price']; ?>  บาท  </h3> </font> <br />
    จำนวนการเข้าชม <?php echo $row_prdt['p_view']; ?>  ครั้ง  
   
    <br /><br />
    <a href="https://www.youtube.com/watch?v=PsxN5lSEXfo&list=PLEA4F1w-xYVZX-h5l0xYldQCvZJR4kvft&index=1" class="btn btn-success" target="_blank"> <span class="glyphicon glyphicon-shopping-cart"> เพิ่มลงตะกร้า </span> </a>
    
    
    </div>
</body>
</html>
<?php
mysql_free_result($prdt);
?>

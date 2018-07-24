<?php require_once('Connections/condb.php'); ?>
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

mysql_select_db($database_condb, $condb);
$query_rb = "SELECT * FROM tbl_bank";
$rb = mysql_query($query_rb, $condb) or die(mysql_error());
$row_rb = mysql_fetch_assoc($rb);
$totalRows_rb = mysql_num_rows($rb);
?>
<?php include('h.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-12">
    	  <?php include('navbar.php');?>
    	</div>
    </div>
 </div> 
 
 <div class="container">
 	<div class="row">
    	<div class="col-md-12">
        		<h3 align="center"> เลขบัญชีสำหรับชำระเงิน <br>
                <font color="red"> *กรุณา Login เพื่อชำระเงิน </font> </h3>
                <table border="1" align="center" class="table table-hover">
                  <tr class="success">
                    <td></td>
                    <td>ธนาคาร</td>
                    <td>ประเภท</td>
                    <td>เลขบัญชี</td>
                    <td>ชื่อบัญชี</td>
                    <td>สาขา</td>
                  </tr>
                  <?php do { ?>
                    <tr>
                      <td><img src="bimg/<?php echo $row_rb['b_logo']; ?>" width="50"></td>
                      <td><?php echo $row_rb['b_name']; ?></td>
                      <td><?php echo $row_rb['b_type']; ?></td>
                      <td><?php echo $row_rb['b_number']; ?></td>
                      <td><?php echo $row_rb['b_owner']; ?></td>
                      <td><?php echo $row_rb['bn_name']; ?></td>
                    </tr>
                    <?php } while ($row_rb = mysql_fetch_assoc($rb)); ?>
                </table>
        </div>
    </div>
</div>
  </body>
</html><?php
mysql_free_result($rb);
?>
<?php include('f.php');?>
<?php require_once('../Connections/condb.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "ptype")) {
  $updateSQL = sprintf("UPDATE tbl_type SET t_name=%s WHERE t_id=%s",
                       GetSQLValueString($_POST['t_name'], "text"),
                       GetSQLValueString($_POST['t_id'], "int"));

  mysql_select_db($database_condb, $condb);
  $Result1 = mysql_query($updateSQL, $condb) or die(mysql_error());

  $updateGoTo = "edit_product_type.php?t_id=" . $row_edittype['t_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edittype = "-1";
if (isset($_GET['t_id'])) {
  $colname_edittype = $_GET['t_id'];
}
mysql_select_db($database_condb, $condb);
$query_edittype = sprintf("SELECT * FROM tbl_type WHERE t_id = %s", GetSQLValueString($colname_edittype, "int"));
$edittype = mysql_query($query_edittype, $condb) or die(mysql_error());
$row_edittype = mysql_fetch_assoc($edittype);
$totalRows_edittype = mysql_num_rows($edittype);
?>
<?php include('access.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
    <?php include('datatable.php');?>
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-2">
        <b>  ADMIN : <?php include('mm.php');?> </b>
        <br>
        <?php include('menu.php');?>        	 
      </div>
      <div class="col-md-6">
        <h3 align="center"> เพิ่มประเภทสินค้า </h3>
        <form action="<?php echo $editFormAction; ?>" method="POST" name="ptype" id="ptype" class="form-horizontal">
        	<div class="form-group">
            	<div class="col-sm-3" align="right"> ประเภทสินค้า </div>
                <div class="col-sm-7">
                	<input name="t_name" type="text" required class="form-control" value="<?php echo $row_edittype['t_name']; ?>">
                </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-3"></div>
                <div class="col-sm-7">
                	<button type="submit" name="save" class="btn btn-primary"> บันทึก </button>
                	<input name="t_id" type="hidden" id="t_id" value="<?php echo $row_edittype['t_id']; ?>"> 
                </div>
             </div>
            <input type="hidden" name="MM_update" value="ptype">
        </form>
      </div>
    </div>
 </div> 
  </body>
</html>
<?php
mysql_free_result($edittype);
?>
<?php include('f.php');?>
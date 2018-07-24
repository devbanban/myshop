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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['admin_user'])) {
  $loginUsername=$_POST['admin_user'];
  $password=$_POST['admin_pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "backend/index.php";
  $MM_redirectLoginFailed = "login_admin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_condb, $condb);
  
  $LoginRS__query=sprintf("SELECT admin_user, admin_pass FROM tbl_admin WHERE admin_user=%s AND admin_pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $condb) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
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
        <div class="row" style="padding-top:100px">
        <div class="col-md-4"></div>
    	<div class="col-md-4" style="background-color:#f4f4f4">
                  <h3 align="center">
                  <span class="glyphicon glyphicon-lock"> </span>
                   Form Login For Admin</h3>
                  <form ACTION="<?php echo $loginFormAction; ?>"  name="formlogin" method="POST" id="login" class="form-horizontal">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input  name="admin_user" type="text" required class="form-control" id="admin_user" placeholder="Username" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input name="admin_pass" type="password" required class="form-control" id="admin_pass" placeholder="Password" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" id="btn">
                        <span class="glyphicon glyphicon-log-in"> </span>
                         Login </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
 </div>

 
 
 
 
   
  </body>
</html>
<?php include('f.php');?>
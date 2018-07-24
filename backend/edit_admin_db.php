<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );
$admin_id = $_POST['admin_id'];
$admin_pass = $_POST['admin_pass'];
$admin_name = $_POST['admin_name'];
 

$sql ="UPDATE tbl_admin SET 
			admin_name='$admin_name',
		  	admin_pass='$admin_pass'			
			WHERE admin_id=$admin_id
			";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "window.location ='edit_admin.php?admin_id=$admin_id&act=edit-ok'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_admin'; ";
			echo "</script>";
		}
		


?>
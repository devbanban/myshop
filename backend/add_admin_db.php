<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

$admin_user = $_POST['admin_user'];
$admin_pass = $_POST['admin_pass'];
$admin_name = $_POST['admin_name'];


$check ="SELECT * FROM tbl_admin  WHERE admin_user='$admin_user'";
$result1=mysql_db_query($database_condb, $check);
$num=mysql_num_rows($result1);

if($num > 0)
{
			echo "<script>";
			echo "alert('user นีมีผู้ใช้แล้ว กรุณาสมัครใหม่อีกครั้ง');";
			echo "window.location ='add_admin.php'; ";
			echo "</script>";

} else {


$sql ="INSERT INTO tbl_admin
		
		(admin_user,  admin_pass, admin_name)
		
		VALUES
		
		('$admin_user', '$admin_pass', '$admin_name')";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
}

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('เพิ่ม admin เรียบร้อยแล้ว');";
			echo "window.location ='list_admin.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_admin'; ";
			echo "</script>";
		}
		


?>
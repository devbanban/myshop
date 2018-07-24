<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting( error_reporting() & ~E_NOTICE );
 
 //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
 

$b_name = $_POST['b_name'];
$b_number = $_POST['b_number'];
$b_type = $_POST['b_type'];
$bn_name = $_POST['bn_name'];
$b_owner = $_POST['b_owner'];

$b_logo = (isset($_POST['b_logo']) ? $_POST['b_logo'] : '');

$upload=$_FILES['b_logo'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="../bimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['b_logo']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname ='imgb'.$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="../bimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['b_logo']['tmp_name'],$path_copy);  
		
	}else{}

$sql ="INSERT INTO tbl_bank
		
		(b_name,  b_number,b_type, bn_name,b_owner, b_logo)
		
		VALUES
		
		('$b_name', '$b_number','$b_type','$bn_name','$b_owner', '$newname')";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 
		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
			echo "window.location ='list_bank.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_bank.php'; ";
			echo "</script>";
		}
		


?>
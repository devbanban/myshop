<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );
 
 //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());

$p_id = $_POST['p_id'];
$p_name = $_POST['p_name'];
$t_id = $_POST['t_id'];
$p_detial = $_POST['p_detial'];
$p_price = $_POST['p_price'];
$p_unit = $_POST['p_unit'];
$p_img11 = $_POST['p_img11'];
$p_img22 = $_POST['p_img22'];
$p_img1 = (isset($_POST['p_img1']) ? $_POST['p_img1'] : '');
$p_img2 = (isset($_POST['p_img2']) ? $_POST['p_img2'] : '');

$upload=$_FILES['p_img1']['name'];;
	if($upload !='') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="../pimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['p_img1']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname ='img1'.$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="../pimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['p_img1']['tmp_name'],$path_copy);  		
	
	}else{
		
		$newname = $p_img11;
				
	}
 


$upload2=$_FILES['p_img2']['name'];;
	if($upload2 !='') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path2="../pimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type2 = strrchr($_FILES['p_img2']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname2 ='img2'.$numrand.$date1.$type2;
 
	$path_copy2=$path2.$newname2;
	$path_link2="../pimg/".$newname2;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['p_img2']['tmp_name'],$path_copy2);  		
	
	}else{
		
		$newname2 = $p_img22;
				
	}
 

 
$sql ="UPDATE tbl_product SET	 
		p_name='$p_name',
		t_id='$t_id',
		p_detial='$p_detial',
		p_price='$p_price',
		p_unit='$p_unit',
		p_img1='$newname',
		p_img2='$newname2'	
		WHERE p_id=$p_id
	 ";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
//  echo $sql;
// exit();
		mysql_close();
		
		if($result){
			echo "<script>";
			echo "window.location ='edit_product.php?p_id=$p_id&t_id=$t_id&act=edit-ok'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_product.php'; ";
			echo "</script>";
		}
		


?>
<?php
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	require_once"../db/db_config.php";
	
	
	if(isset($_REQUEST['upload']))
	{
		$image_name = $_FILES['myimage']['name'];
		$image_error = $_FILES['myimage']['error'];
		$tmp_name = $_FILES['myimage']['tmp_name'];
		$type = $_FILES['myimage']['type'];
		if($image_error==0)
		{
			extract(pathinfo($image_name));
			$imgname = md5($_SESSION['username'].time()).".".$extension; 
			move_uploaded_file($tmp_name,"../images/".$imgname);
			if(iud("update doctor_information set image='$imgname' where student_id='".$_SESSION['doctorid']."'"))
			{
				$_SESSION['userimage']=$imgname;
				header("location:../change_image.php");
			}
			else
			{
				echo "Something Wrong";
				}
		}
		
	}
	
	if(isset($_REQUEST['upload_report']))
	{
		$image_name = $_FILES['myimage']['name'];
		$image_error = $_FILES['myimage']['error'];
		$_POST['userid'];
		$tmp_name = $_FILES['myimage']['tmp_name'];
		$type = $_FILES['myimage']['type'];
		if($image_error==0)
		{
			extract(pathinfo($image_name));
			$imgname = md5($tmp_name.time()).".".$extension; 
			move_uploaded_file($tmp_name,"../../reports/".$imgname);
			if(iud("insert into report (path,userid,report_date) values ('$imgname','".$_POST['userid']."','".date("Y-m-d h:i:sa")."') "))
			{
				echo '<script>alert("Report Successfully Uploaded");window.location="../upload_reports.php";</script>';
			}
			else
			{
				echo "Something Wrong";
				}
		}
		
	}
	
	
?>
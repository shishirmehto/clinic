<?php
	session_start();
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
			if(iud("update patient_information set image='$imgname' where student_id='".$_SESSION['userid']."'"))
			{
				$_SESSION['userimage']=$imgname;
				echo "<script>alert('Profile Picture Uploaded');window.location='../change_image.php';</script>";
			}
			else
			{
				echo "Something Wrong";
				}
		}
		
	}
	
?>
<?php
	session_start();
	require_once"../db/db_config.php";
	date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['signup']))
	{
		extract($_POST);
		$email = strtolower($email);
		$password = md5($password);
		$query1 = "select * from user where email='$email'";
		$n = mysqli_num_rows(select($query1));
		if($n==0)
		{
			$query2= "insert into user (name,email,password) values ('$signup_name','$email','$password')";
			if(iud($query2)>0)
			{
				$a = mysqli_insert_id($cid);
				$query4 = "insert into patient_information (student_id,gender,registration_date) values ('$a','$mygender',NOW()) ";
				if(iud($query4)>0)
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo"Email Already Registered";
		}
	}
	if(isset($_POST['signin']))
	{
		extract($_POST);
		$email = strtolower($email);
		$password = md5($password);
		if(mysqli_num_rows(select("select * from user where email='$email' "))==1)
		{
			$query = "select * from user where email='$email' and password='$password'";
			$n = mysqli_num_rows(select($query));
			if($n==1)
			{
				extract(mysqli_fetch_array(select($query)));
				extract(mysqli_fetch_array(select("select image from patient_information where student_id='$userid'")));
				iud("update patient_information set last_login_date='".date('Y-m-d h:i:sa')."' where  student_id='$userid'");
				$_SESSION['userid'] = $userid;
				$_SESSION['username'] = ucwords($name);
				$_SESSION['userimage'] = $image;
				echo 1;
			}
			else
			{
				echo 3;
			}
		}
		else
		{
			echo 2;
		}
	}
	if(isset($_POST['forget']))
	{
		extract($_POST);
		$email = strtolower($email);
		$query = "select * from user where email='$email'";
		$n = mysqli_num_rows(select($query));
		if($n>0)
		{
			extract(mysqli_fetch_array(select($query)));
			$resetcode = md5($email.time());
			if(iud("update user set resetcode='".$resetcode."' where userid='$userid'")==1)
			{
				$_SESSION['reset_userid']=$userid;
				$_SESSION['reset_code']=$resetcode;
				echo 1;
			}
		}
		else
		{
			echo 0;
		}
	}
	if(isset($_POST['reset']))
	{
		extract($_POST);
		$password = md5($password);
		if(iud("update user set password='$password',resetcode='' where resetcode='$resetcode' and userid='$reset_userid'")==1)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	if(isset($_POST['change_pass']) && $_POST['change_pass']==1)
	{
		extract($_POST);
		$opassword = md5($opassword);
		$password = md5($password);
		if(mysqli_num_rows(select("select userid from user where password='$opassword' and userid='".$_SESSION['userid']."'"))==1)
		{
			if(iud("update user set password='$password' where userid='".$_SESSION['userid']."' and password='$opassword'")==1)
			echo 1;
			else
			echo 0;
		}
		else
		echo 2;
	}
	if(isset($_POST['update_details']) && $_POST['update_details']==1)
	{
		extract($_POST);
		if(iud("update patient_information set gender='$gender',date_of_birth='$dob',contact_no='$contact_no',address='$address',description='$desc' where student_id='".$_SESSION['userid']."'")==1 || iud("update user set name='$patient_name',email='$patient_email' where userid='".$_SESSION['userid']."'")==1)
		{
		$_SESSION['username'] = $patient_name;
		echo 1;
		}
		else
		{
	echo 0;
		}
	}
	mysqli_close($cid);
?>
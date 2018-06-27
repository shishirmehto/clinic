<?php
	session_start();
	require_once"../db/db_config.php";
	date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['signup']))
	{
		extract($_POST);
		$password = md5($password);
		$email = strtolower($email);
		$query1 = "select * from doctor where email='$email'";
		$n = mysqli_num_rows(select($query1));
		if($n==0)
		{
			$query2= "insert into doctor (name,email,password) values ('$signup_name','$email','$password')";
			if(iud($query2)>0)
			{
				$a = mysqli_insert_id($cid);
				$query4 = "insert into doctor_information (student_id,gender,registration_date) values ('$a','$mygender',NOW()) ";
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
		$password = md5($password);
		$email = strtolower($email);
		if(mysqli_num_rows(select("select * from doctor where email='$email' "))==1)
		{
			$query = "select * from doctor where email='$email' and password='$password'";
			$n = mysqli_num_rows(select($query));
			if($n==1)
			{
				extract(mysqli_fetch_array(select($query)));
				extract(mysqli_fetch_array(select("select image from doctor_information where student_id='$doctorid'")));
				iud("update doctor_information set last_login_date='".date('Y-m-d h:i:sa')."' where  student_id='$doctorid'");
				$_SESSION['doctorid'] = $doctorid;
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
		$query = "select * from doctor where email='$email'";
		$n = mysqli_num_rows(select($query));
		if($n>0)
		{
			extract(mysqli_fetch_array(select($query)));
			$resetcode = md5($email.time());
			if(iud("update doctor set resetcode='".$resetcode."' where doctorid='$doctorid'")==1)
			{
				$_SESSION['reset_doctorid']=$doctorid;
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
		if(iud("update doctor set password='$password',resetcode='' where resetcode='$resetcode' and doctorid='$reset_doctorid'")==1)
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
		if(mysqli_num_rows(select("select doctorid from doctor where password='$opassword' and doctorid='".$_SESSION['doctorid']."'"))==1)
		{
			if(iud("update doctor set password='$password' where doctorid='".$_SESSION['doctorid']."' and password='$opassword'")==1)
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
		if(iud("update doctor_information set gender='$gender',date_of_birth='$dob',contact_no='$contact_no',address='$address',description='$desc' where student_id='".$_SESSION['doctorid']."'")==1 || iud("update doctor set name='$doctor_name' where doctorid='".$_SESSION['doctorid']."' ")==1)
		{
			$_SESSION['username'] = $doctor_name;
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	if(isset($_POST['update_presc']) && $_POST['update_presc']==1)
	{
		extract($_POST);
		if(iud("update patients set symptoms='$symptoms',medicine='$medicine' where patientid='$patientid'")==1)
		echo 1;
		else
		echo 0;
	}
	
	if(isset($_REQUEST['del_report']) && $_REQUEST['del_report']==1)
	{
		if(iud("delete from report where report_id='".$_REQUEST['del_report_id']."'")==1)
		echo '<script>alert("Report Deleted Successfully");window.location="../view_active_patients.php";</script>';
		else
		echo '<script>alert("Something Wrong");window.location="../view_active_patients.php";</script>';
		
	}
	
	if(isset($_POST['new_patient']) && $_POST['new_patient']==1)
	{
		extract($_POST);
		if(iud("insert into patients (userid,doctorid,symptoms,medicine,amount,date) values ('$userid','".$_SESSION['doctorid']."','$symptoms','$medicine','$amount','".date('Y-m-d h:i:sa')."') ")==1)
		echo 1;
		else
		echo 0;
	}
	if(isset($_POST['patient_detail']) && $_POST['patient_detail']==1)
	{
		$query = "select * from patient_information where student_id='".$_POST['userid']."'";
		extract(mysqli_fetch_array(select($query)));
	?>
	<table class="table table-hover  table-bordered">
		<tbody>
			<?php if(!empty($name)){ ?>
				<tr>
					<th scope="row">Name</th> <td><?=ucwords($name)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($gender)){ ?>
				<tr>
					<th scope="row">Gender</th> <td><?=ucwords($gender)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($date_of_birth)){ ?>
				<tr>
					<th scope="row">Date Of Birth</th> <td><?php echo date('d-m-Y', strtotime($date_of_birth));
						$date = explode("-",$date_of_birth);
						$dob = new DateTime($date[0].'-'.$date[1].'-'.$date[2]);  //DateTime Object
						$interval = $dob->diff(new DateTime); //calculates the difference between two DateTime objects
						echo "  &nbsp;( Age  : $interval->y )</p>";
					?></td>
					
				</tr>
			<?php } ?>
			<?php if(!empty($address)){ ?>
				<tr>
					<th scope="row">Address</th> <td><?=ucwords($address)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($description)){ ?>
				<tr>
					<th scope="row">Description</th> <td><?=ucwords($description)?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php
	}
	if(isset($_POST['oldpatient_detail']) && $_POST['oldpatient_detail']==1)
	{
		$query = "select * from patient_information where student_id='".$_POST['userid']."'";
		extract(mysqli_fetch_array(select($query)));
		$query2 = "select * from patients where userid='".$_POST['userid']."'";
		$old_patients_res = select($query2);
	?>
	<table class="table table-hover table-responsive table-bordered">
		<tbody>
			<?php if(!empty($name)){ ?>
				<tr>
					<th scope="row" style="word-break: break-all;">Name</th> <td><?=ucwords($name)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($gender)){ ?>
				<tr>
					<th scope="row">Gender</th> <td><?=ucwords($gender)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($date_of_birth)){ ?>
				<tr>
					<th scope="row">Date Of Birth</th> <td><?php echo date('d-m-Y', strtotime($date_of_birth));
						$date = explode("-",$date_of_birth);
						$dob = new DateTime($date[0].'-'.$date[1].'-'.$date[2]);  //DateTime Object
						$interval = $dob->diff(new DateTime); //calculates the difference between two DateTime objects
						echo "  &nbsp;( Age  : $interval->y )</p>";
					?></td>
					
				</tr>
			<?php } ?>
			<?php if(!empty($address)){ ?>
				<tr>
					<th scope="row" style="word-break: break-all;">Address</th> <td><?=ucwords($address)?></td>
				</tr>
			<?php } ?>
			<?php if(!empty($description)){ ?>
				<tr>
					<th scope="row" style="word-break: break-all;">Description</th> <td><?=ucwords($description)?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<h4 class="text-center">Old Records</h4>
	<table class="table table-hover table-responsive  table-bordered">
		<tbody>
			<tr>
				<th scope="row" style="width:10%;">S. No.</th>
				<th scope="row" style="width:25%;">Symptoms</th>
				<th scope="row" style="width:25%;">Medicine</th>
				<th scope="row" style="width:15%;">Date.</th>
				<th scope="row" style="width:15%;">Amount</th>
			</tr>
			<?php
				$d_counts=1;
				while($rows2 = mysqli_fetch_array($old_patients_res)) {
					extract($rows2);
				?>
				<tr>
					<td style="word-break: break-all;"><?=$d_counts;?> .</td>
					<td style="word-break: break-all;"><?=ucwords($symptoms)?></td>
					<td style="word-break: break-all;"><?=ucwords($medicine)?></td>
					<td style="word-break: break-all;"><?=date('d-m-Y', strtotime($date))?></td>
					<td style="word-break: break-all;"><?php if(!empty($amount)){ ?> Rs. <?=$amount?><?php } ?></td>
				</tr>
			<?php $d_counts++; } ?>
		</tbody>
	</table>
	<div class="md-form">
		<textarea type="text" id="textareaPrefix" class="form-control symptoms md-textarea animated rotateInUpLeft" placeholder="Patient Symptoms" rows="3"><?=ucwords($symptoms)?></textarea>
	</div>
	<div class="md-form">
		<textarea type="text" id="textareaPrefix" class="form-control medicine md-textarea animated rotateInUpLeft"  placeholder="Medicine Prescribed." rows="3"><?=ucwords($medicine)?></textarea>
	</div>
	<input type="number" class="animated rotateInUpLeft"  id="amount" placeholder="Amount Charged">
	<?php
	}
	mysqli_close($cid);
?>
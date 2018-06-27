<?php
	session_start();
	require_once"../db/db_config.php";
	
	if(isset($_POST['signup']))
	{
		extract($_POST);
		$password = md5($password);
		$query1 = "select * from admin where email='$email'";
		$n = mysqli_num_rows(select($query1));
		if($n==0)
		{
			$query2= "insert into admin (name,email,gender,password) values ('$signup_name','$email','$mygender','$password')";
			if(iud($query2)>0)
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
			echo"Email Already Registered";
		}
		
		
		
	}
	if(isset($_POST['signin']))
	{
		extract($_POST);
		$password = md5($password);
		if(mysqli_num_rows(select("select * from admin where email='$email' "))==1)
		{
			$query = "select * from admin where email='$email' and password='$password'";
			$n = mysqli_num_rows(select($query));
			if($n==1)
			{
				
				extract(mysqli_fetch_array(select($query)));
				$_SESSION['adminid'] = $adminid;
				$_SESSION['adminname'] = $name;
				$_SESSION['adminimage'] = $image;
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
		$query = "select * from admin where email='$email'";
		$n = mysqli_num_rows(select($query));
		if($n>0)
		{
			$reset_code_admin = md5($email.time());
			extract(mysqli_fetch_array(select($query)));
			if(iud("update admin set resetcode='$reset_code_admin' where email='$email'")==1)
			{
				$_SESSION['reset_adminid']=$adminid;
				$_SESSION['reset_code_admin']=$reset_code_admin;
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
		if(iud("update admin set password='$password',resetcode='' where resetcode='$resetcode' and adminid='$reset_adminid'")==1)
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
		if(mysqli_num_rows(select("select adminid from admin where password='$opassword' and adminid='".$_SESSION['adminid']."'"))==1)
		{
			if(iud("update admin set password='$password' where adminid='".$_SESSION['adminid']."' and password='$opassword'")==1)
			echo 1;
			else
			echo 0;
		}
		else
		echo 2;
		
		
		
	}
	if(isset($_POST['new_patient']) && $_POST['new_patient']==1)
	{
		extract($_POST);
		if(iud("insert into patients (userid,doctorid,symptoms,medicine,amount,date) values ('$userid','$doctorid','$symptoms','$medicine','$amount','".date('Y-m-d h:i:sa')."') ")==1)
		echo 1;
		else
		echo 0;
	}
	if(isset($_POST['update_presc']) && $_POST['update_presc']==1)
	{
		extract($_POST);
		if(iud("update patients set symptoms='$symptoms',medicine='$medicine' where patientid='$patientid'")==1)
		echo 1;
		else
		echo 0;
	}
	
	if(isset($_POST['update_doctor_details']) && $_POST['update_doctor_details']==1)
	{
		extract($_POST);
		if(iud("update doctor_information set gender='$gender',date_of_birth='$dob',contact_no='$contact_no',address='$address',description='$desc' where student_id='$doctorid'")==1 || iud("update doctor set name='$doctor_name',email='$doctor_email' where doctorid='$doctorid'")==1)
		{
		echo 1;
		}
		else
		echo 0;
	}
	if(isset($_POST['update_patient_details']) && $_POST['update_patient_details']==1)
	{
		extract($_POST);
		if(iud("update patient_information set gender='$gender',date_of_birth='$dob',contact_no='$contact_no',address='$address',description='$desc' where student_id='$patientid'")==1 || iud("update user set name='$patient_name',email='$patient_email' where userid='$patientid'")==1)
		{
		echo 1;
		}
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
					<th scope="row">Date Of Birth</th> <td><?=date('d-m-Y', strtotime($date_of_birth));?></td>
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
					<th scope="row">Date Of Birth</th> <td><?=date('d-m-Y', strtotime($date_of_birth));?></td>
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
					<td style="word-break: break-all;"><?=$symptoms?></td>
					<td style="word-break: break-all;"><?=$medicine?></td>
					<td style="word-break: break-all;"><?=date('d-m-Y', strtotime($date))?></td>
					<td style="word-break: break-all;"><?php if(!empty($amount)){ ?> Rs. <?=$amount?><?php } ?></td>
				</tr>
			<?php $d_counts++; } ?>
		</tbody>
	</table>
	<div class="md-form">
		<textarea type="text" id="textareaPrefix" class="form-control symptoms md-textarea animated rotateInUpLeft" placeholder="Patient Symptoms" rows="3"><?=$symptoms?></textarea>
	</div>
	<div class="md-form">
		<textarea type="text" id="textareaPrefix" class="form-control medicine md-textarea animated rotateInUpLeft"  placeholder="Medicine Prescribed." rows="3"><?=$medicine?></textarea>
	</div>
	<input type="hidden" id="doctorid" value="<?=$doctorid?>" readonly="readonly">
	<input type="number" class="form-control" class="animated rotateInUpLeft"  id="amount" placeholder="Amount Charged">
	<?php
	}
	mysqli_close($cid);
?>
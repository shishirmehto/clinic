<?php require_once"db/session.php"; require_once"db/db_config.php";
	if(!isset($_REQUEST['patientid']))
	{
		echo "<script>alert('Patient Not Found');window.location='view_active_patients.php'</script>";
		exit();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Edit Prescription</title>
		<?php include_once"head_files.php";?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page login-page" style="width:60%;">
					<h3 class="title1">Edit Prescription</h3>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" id="update_presc">
								<?php
									$query = "SELECT * from patients WHERE patientid='".$_REQUEST['patientid']."'";
									extract(mysqli_fetch_array(select($query)));
								?>
								<div class="md-form">
									<textarea type="text" id="textareaPrefix" class="form-control symptoms md-textarea animated rotateInUpLeft" placeholder="Patient Symptoms" rows="3"><?=$symptoms?></textarea>
								</div>
								<div class="md-form">
									<textarea type="text" id="textareaPrefix" class="form-control medicine md-textarea animated rotateInUpLeft" placeholder="Medicine Prescribed." rows="3"><?=$medicine?></textarea>
								</div>
								<p class="myerror" id="error"></p>
								<div class="col-md-12">
									<?php
										extract(mysqli_fetch_array(select("select * from patient_information where student_id='$userid'")));
										$query2 = "select * from patients where userid='$userid' and patientid!='".$_REQUEST['patientid']."'";
										$old_patients_res = select($query2);
									?>
									<h4 class="text-center">Patient Details</h4>
									<div class="col-md-12">
										<table class="table table-hover  table-bordered">
											<tbody>
												<?php if(!empty($name)){ ?>
													<tr>
														<th scope="row">Name</th> <td><?=$name?></td>
													</tr>
												<?php } ?>
												<?php if(!empty($gender)){ ?>
													<tr>
														<th scope="row">Gender</th> <td><?=$gender?></td>
													</tr>
												<?php } ?>
												<?php if(!empty($date_of_birth)){ ?>
													<tr>
														<th scope="row">Date Of Birth</th> <td><?=date('d-m-Y', strtotime($date_of_birth))?></td>
													</tr>
												<?php } ?>
												<?php if(!empty($address)){ ?>
													<tr>
														<th scope="row">Address</th> <td><?=$address?></td>
													</tr>
												<?php } ?>
												<?php if(!empty($description)){ ?>
													<tr>
														<th scope="row">Description</th> <td><?=$description?></td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
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
													<td style="word-break: break-all;"><?=$medicine?></td>
													<td style="word-break: break-all;"><?=$symptoms?></td>
													<td style="word-break: break-all;"><?=date('d-m-Y', strtotime($date))?></td>
													<td style="word-break: break-all;"><?php if(!empty($amount)){ ?> Rs. <?=$amount?><?php } ?></td>
												</tr>
											<?php $d_counts++; } ?>
										</tbody>
									</table>
								</div>
								<input type="submit" class="animated pulse" value="Update Prescription">
							</form>
						</div>
					</div>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				</div>
			</div>
			<!--footer-->
			<?php include_once"footer.php";?>
			<!--//footer-->
		</div>
		<?php include_once"footer_scripts.php";?>
		<script>
			$(window).load(function(){
				$("#update_presc").submit(function(){
					var symptoms = $.trim($(".symptoms").val());
					var medicine = $.trim($(".medicine").val());
					if(symptoms.length<3)
					{
						$(".symptoms").focus();
						$(".symptoms").css('border','2px solid #ec000069');
						$("#error").text('Invalid symptoms');
						alertify.error('Invalid symptoms');
						return false;
					}
					$(".symptoms").css('border','1px solid green');
					if(medicine.length<3)
					{
						$(".medicine").focus();
						$(".medicine").css('border','2px solid #ec000069');
						$("#error").text('Invalid medicine');
						alertify.error('Invalid medicine');
						return false;
					}
					$(".medicine").css('border','1px solid green');
					$("#error").text('');
					$.ajax({
						url : "ajax/user.php",
						method:"post",
						data:{"symptoms":symptoms,"medicine":medicine,"patientid":<?=$_REQUEST['patientid']?>,"update_presc":1},
						success:function(data){
							if(data==1)
							{
								alertify.alert("Prescription Updated", function(){
									window.location="view_active_patients.php";
								});
							}
							else if(data==0)
							{
								alertify.success("No Change");
								$("input").each(function(){
									$(this).css('border','none');
								});
								$("textarea").each(function(){
									$(this).css('border','none');
								});
							}
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
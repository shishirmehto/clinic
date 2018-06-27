<?php  require_once"db/session.php";require_once"db/db_config.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Your Reports</title>
		<?php include_once"head_files.php";
			$q1 = "SELECT doctor_information.*,doctor.* from patients INNER JOIN doctor_information on patients.doctorid = doctor_information.student_id INNER JOIN doctor on doctor_information.student_id = doctor.doctorid WHERE patients.userid='".$_SESSION['userid']."' GROUP BY patients.userid";
			$res1 = select($q1);
			extract(mysqli_fetch_array($res1));
		?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page login-page"  style="width:80% !important;">
					<h3 class="title1">Your Reports</h3>
					<div class="widget-shadow">
						<div class="login-body">
						<?php if(mysqli_num_rows($res1)>0){ ?>
							<div class="row" style="background: #0addff14;">
								<h3 class="title1">Doctor Details</h3>
								<div class="col-md-4">
									<img style="height:200px;width:200px;" src="doctor/images/<?=$image?>">
								</div>
								<div class="col-md-8">
									<table class="table table-hover  table-bordered">
										<tbody>
											<tr>
												<th scope="row">Name</th>
												<td><?=$name?></td>
											</tr>
											<tr>
												<th scope="row">Contact No.</th>
												<td><?=$contact_no?></td>
											</tr>
											<tr>
												<th scope="row">Email</th>
												<td><?=$email?></td>
											</tr>
											<tr>
												<th scope="row">Gender</th>
												<td><?=$gender?></td>
											</tr>
											<tr>
												<th scope="row">Address</th>
												<td><?=$address?></td>
											</tr>
											<tr>
												<th scope="row">Description</th>
												<td><?=$description?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
							<div class="row">
							<div class="col-md-12">
								<?php
									$query3 = "select * from report where userid='".$_SESSION['userid']."'";
									$old_patients_reposts = select($query3);
									if(mysqli_num_rows($old_patients_reposts)>0){
									?>
									<h3 class="text-center">Reports</h3>
									<br/>
									<table class="table table-hover table-responsive  table-bordered">
										<tbody>
											<tr>
												<th scope="row" >S. No.</th>
												<th scope="row" >Image</th>
												<th scope="row" >Date</th>
											</tr>
											<?php
												$d_counts=1;
												while($rows3 = mysqli_fetch_array($old_patients_reposts)) {
													extract($rows3);
												?>
												<tr>
													<td style="word-break: break-all;"><?=$d_counts?> .</td>
													<td style="word-break: break-all;"><img src="reports/<?=$path?>" style="width:100px"></td>
													<td style="word-break: break-all;"><?=$report_date?></td>
												</tr>
											<?php $d_counts++; } } else { ?>
											<h4 class="text-center">No Reports Available </h4>
										<?php } ?>
									</tbody>
								</table>
							</div>
							</div>
						<?php } else{ ?>
							<h3 class="text-center">No Reports Available</h3>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!--footer-->
			<?php include_once"footer.php";?>
			<!--//footer-->
		</div>
		<?php include_once"footer_scripts.php";?>
	</body>
</html>
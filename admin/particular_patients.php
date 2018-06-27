<?php require_once"db/session.php"; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Profile Picture</title>
		<?php include_once"head_files.php";?>
		<link href='css/rotating-card.css' rel='stylesheet' />
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page" style="min-height: 531px;">
					<h3 class="title1">Patients List</h3>
					<div class="inbox-page">
						<?php
							$query = "SELECT patients.*,user.*,patient_information.* FROM patients INNER JOIN user on patients.userid = user.userid left join patient_information on user.userid = patient_information.student_id where patients.doctorid='".$_SESSION['doctorid']."' group by patients.userid ";
							$res = select($query);
							if(mysqli_num_rows($res)>0)
							{
								$i=1;
								while($row = mysqli_fetch_array($res)){
									extract($row);
								?>
								<div class="inbox-row widget-shadow" id="accordion<?=$i?>" role="tablist" aria-multiselectable="true">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
										<div class="mail mail-name"><h6>Patient Name : <?=$name?></h6></div>
										<div class="mail mail-name"><h6>Patient Contact : <?=$contact_no?></h6></div>
										<div class="mail-right">
										</div>
										<div class="mail-right"><p><?=$date?></p></div>
										<div class="clearfix"> </div>
									</a>
									<div id="collapse<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$i?>" aria-expanded="true" style="">
										<div class="mail-body">
											<div class="row">
												<div class="col-md-6">
													<img src="../images/<?=$image?>">
												</div>
												<div class="col-md-6">
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
												<div class="col-md-12">
													<?php
														$query2 = "select * from patients where userid='$userid'";
														$old_patients_res = select($query2);
													?>
													<h4 class="text-center">Old Records</h4>
													<table class="table table-hover table-responsive  table-bordered">
														<tbody>
															<tr>
																<th scope="row" style="width:10%;">S. No.</th>
																<th scope="row" style="width:22.5%;">Symptoms</th>
																<th scope="row" style="width:22.5%;">Medicine</th>
																<th scope="row" style="width:15%;">Date.</th>
																<th scope="row" style="width:15%;">Amount</th>
																<th scope="row" style="width:5%;">Edit</th>
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
																	<td style="word-break: break-all;"><a href="edit_prescripton.php?patientid=<?=$patientid?>"><i class="fa fa-edit"></i></a></td>
																</tr>
															<?php $d_counts++; } ?>
														</tbody>
													</table>
												</div>
												<div class="col-md-12">
													<?php
														$query3 = "select * from report where userid='$userid'";
														$old_patients_reposts = select($query3);
														if(mysqli_num_rows($old_patients_reposts)>0){
													?>
													<h4 class="text-center">Reports</h4>
													<table class="table table-hover table-responsive  table-bordered">
														<tbody>
															<tr>
																<th scope="row" >S. No.</th>
																<th scope="row" >Image</th>
																<th scope="row" >Date</th>
																<th scope="row" >Delete</th>
															</tr>
															<?php
																$d_counts=1;
																while($rows3 = mysqli_fetch_array($old_patients_reposts)) {
																	extract($rows3);
																?>
																<tr>
																	<td style="word-break: break-all;"><?=$d_counts?> .</td>
																	<td style="word-break: break-all;"><img src="../reports/<?=$path?>" style="width:100px"></td>
																	<td style="word-break: break-all;"><?=$report_date?></td>
																	<td style="word-break: break-all;"><a href="ajax/user.php?del_report=1&del_report_id=<?=$report_id?>">Delete</a></td>
																</tr>
														<?php $d_counts++; } } else { ?>
														<h4 class="text-center">No Reports Available </h4>
													
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											</div>
										</div>
									</div>
									<?php
									$i++; }
								}
								else
								{
									echo "No recode_file";
								}
							?>
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
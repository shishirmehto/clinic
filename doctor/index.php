<?php require_once"db/session.php";	require_once"db/db_config.php"; 
	$query = "SELECT COUNT(patientid) FROM patients WHERE doctorid='".$_SESSION['doctorid']."' group by userid";
	$res= select($query);
	$total_patients = 0;
	while($row= mysqli_fetch_array($res))
	{
		$total_patients++;
	}
	
	$query2 = "SELECT user.* from user LEFT JOIN patients on user.userid = patients.userid WHERE doctorid IS NULL";
	$res2= select($query2);
	$total_new_patients = mysqli_num_rows($res2);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Home</title>
		<?php include_once"head_files.php";?>
		
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<!--left-fixed -navigation-->
			<?php include_once"sidebar.php";?>
			<!--left-fixed -navigation-->
			<!-- header-starts -->
			<?php include_once"header.php";?>
			<!-- //header-ends -->
			<!-- main content start-->
			<div id="page-wrapper">
				<div class="main-page">
					<div class="row-one">
						<a href="view_active_patients.php" >
						<div class="widget animated bounceInLeft col-md-6">
							<div class="stats-left ">
								<h5>Total</h5>
								<h4>Active Patients</h4>
							</div>
							<div class="stats-right">
								<label><?=$total_patients;?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						</a>
						<a href="new_patient.php" >
						<div class="widget states-last animated bounceInRight col-md-6">
							<div class="stats-left">
								<h5>Total </h5>
								<h4>New Patients</h4>
							</div>
							<div class="stats-right">
								<label><?=$total_new_patients;?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						</a>
						<div class="clearfix"> </div>
					</div>
					
				</div>
				<div class="row calender widget-shadow">
					<h4 class="title">Calender</h4>
					<div class="cal1">
					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
		<!--footer-->
		<?php include_once"footer.php";?>
		<!--//footer-->
	
	<?php include_once"footer_scripts.php";?>
</body>
</html>
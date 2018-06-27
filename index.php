<?php require_once"db/session.php";	require_once"db/db_config.php"; 
	
	
	extract(mysqli_fetch_array(select("SELECT COUNT(report_id) as total_reports from report WHERE userid='".$_SESSION['userid']."'")));
	extract(mysqli_fetch_array(select("SELECT COUNT(patientid) as total_presc from patients WHERE userid='".$_SESSION['userid']."'")));
		
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
						<a href="prescription.php" >
						<div class="widget animated bounceInLeft col-md-6">
							<div class="stats-left ">
								<h5>Total</h5>
								<h4>Prescription</h4>
							</div>
							<div class="stats-right">
								<label> <?=$total_presc?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						</a>
						<a href="reports.php" >
						<div class="widget states-last animated bounceInRight col-md-6">
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Reports</h4>
							</div>
							<div class="stats-right">
								<label><?=$total_reports?></label>
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
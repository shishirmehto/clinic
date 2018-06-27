<?php 
	
	require_once"db/session.php";
	require_once"db/db_config.php";
	
	extract(mysqli_fetch_array(select("SELECT COUNT(userid) as total_patients FROM user")));
	extract(mysqli_fetch_array(select("SELECT COUNT(doctorid) as total_doctors FROM doctor")));
	$query = "SELECT COUNT(patientid) FROM patients group by userid";
	$res= select($query);
	$total_active_patients = 0;
	while($row= mysqli_fetch_array($res))
	{
		$total_active_patients++;
	}
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
					<a href="view_all_doctors.php" >
					<div class="col-md-4 widget">
						<div class="stats-left ">
							<h5>Today</h5>
							<h4>Doctors</h4>
						</div>
						<div class="stats-right">
							<label> <?=$total_doctors?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					</a>
					<a href="view_all_doctors.php" >
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
							<h5>Today</h5>
							<h4>Patients</h4>
						</div>
						<div class="stats-right">
							<label> <?=$total_patients?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					</a>
					<a href="view_active_patients.php" >
					<div class="col-md-4 widget states-last">
						<div class="stats-left">
							<h5>Today</h5>
							<h4>Active Patients</h4>
						</div>
						<div class="stats-right">
							<label><?=$total_active_patients?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					</a>
					<div class="clearfix"> </div>	
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
	</div>
<?php include_once"footer_scripts.php";?>
</body>
</html>
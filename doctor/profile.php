<?php require_once"db/session.php"; extract(mysqli_fetch_array(select("select * from doctor_information where student_id='".$_SESSION['doctorid']."'"))); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Profile Picture</title>
		<?php include_once"head_files.php";?>
		<link href='css/rotating-card.css' rel='stylesheet' />
		<style>
			
			.boton {
			width: 200px;
			height: 50px;
			margin: 50px auto;
			display: block;
			position: relative;
			}
			
			.botontext {
			position: absolute;
			height: 100%;
			width: 100%;
			z-index: 1;
			text-align: center;
			line-height: 50px;
			font-family: 'Montserrat', sans-serif;
			font-size: 12px;
			text-transform: uppercase;
			}
			
			.twist {
			display: block;
			height: 100%;
			width: 25%;
			position: relative;
			float: left;
			margin-left: -4px;
			}
			
			.twist:before {
			content: "";
			width: 100%;
			height: 100%;
			background: #fed5a9;
			bottom: 100%;
			position: absolute;
			transform-origin: center bottom 0px;
			transform: matrix3d(1, 0, 0, 0,
			0, 0, -1, -0.003,
			0, 1, 0, 0,
			0, 0, 0, 1);
			
			-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
			}
			
			.twist:after {
			content: "";
			position: absolute;
			width: 100%;
			top: 100%;
			height: 100%;
			background: #4045ff;
			transform-origin: center top 0px;
			transform: matrix3d(1, 0, 0, 0,
			0, 1, 0, 0,
			0, 0, 1, -0.003,
			0, -50, 0, 1);
			
			-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
			}
			
			.boton:hover .twist:before {
			background: #E91E63;
			color:white;
			transform: matrix3d(1, 0, 0, 0,
			0, 1, 0, 0,
			0, 0, 1, 0.003,
			0, 50, 0, 1);
			}
			
			.boton:hover .twist:after {
			background: #dedae1;
			transform: matrix3d(1, 0, 0, 0,
			0, 0, -1, 0.003,
			0, 1, 0, 0,
			0, 0, 0, 1);
			}
			
			.boton .twist:nth-of-type(1) {
			margin-left: 0;
			}
			
			.boton .twist:nth-of-type(1):before,
			.boton .twist:nth-of-type(1):after {
			transition-delay: 0s;
			}
			
			.boton .twist:nth-of-type(2):before,
			.boton .twist:nth-of-type(2):after {
			transition-delay: 0.1s;
			}
			
			.boton .twist:nth-of-type(3):before,
			.boton .twist:nth-of-type(3):after {
			transition-delay: 0.2s;
			}
			
			.boton .twist:nth-of-type(4):before,
			.boton .twist:nth-of-type(4):after {
			transition-delay: 0.3s;
			}
			
			.boton .botontext:nth-of-type(1) {
			color: #fff;
			bottom: 100%;
			transform-origin: center bottom 0px;
			transform: matrix3d(1, 0, 0, 0,
			0, 0, -1, -0.003,
			0, 1, 0, 0,
			0, 0, 0, 1);
			
			-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
			}
			
			.boton:hover .botontext:nth-of-type(1) {
			transform: matrix3d(1, 0, 0, 0,
			0, 1, 0, 0,
			0, 0, 1, 0.003,
			0, 50, 0, 1);
			}
			
			.boton .botontext:nth-of-type(2) {
			color: #fff;
			top: 100%;
			transform-origin: center top 0px;
			transform: matrix3d(1, 0, 0, 0,
			0, 1, 0, 0,
			0, 0, 1, -0.003,
			0, -50, 0, 1);
			
			-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			-o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995);
			transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
			}
			
			.boton:hover .botontext:nth-of-type(2) {
			transform: matrix3d(1, 0, 0, 0,
			0, 0, -1, 0.003,
			0, 1, 0, 0,
			0, 0, 0, 1);
			}
			
			@keyframes tipsy {
			0 {
			transform: translateX(-50%) translateY(-50%) rotate(0deg);
			}
			100% {
			transform: translateX(-50%) translateY(-50%) rotate(360deg);
			}
			}
			
			body {
			font-family: helvetica, arial, sans-serif;
			background-color: #2e2e31;
			}
			
			.mya {
			color: #fffbf1;
			text-shadow: 0 20px 25px #2e2e31, 0 40px 60px #2e2e31;
			font-size: 40px;
			font-weight: bold;
			text-decoration: none;
			letter-spacing: -3px;
			margin: 0;
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			}
			
			.mya:before,
			.mya:after {
			content: '';
			padding: .9em .4em;
			position: absolute;
			left: 50%;
			width: 100%;
			top: 50%;
			display: block;
			border: 1px solid red;
			transform: translateX(-50%) translateY(-50%) rotate(0deg);
			animation: 10s infinite alternate ease-in-out tipsy;
			}
			
			.mya:before {
			border-color: #6cf3e047 #6cf3e047 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
			z-index: -1;
			}
			
			.mya:after {
			border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #6cf3e047 #6cf3e047;
			box-shadow: 2px 2px 5px rgba(46, 46, 49, .8);
			}
			
		</style>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="col-md-4 col-md-offset-4">
								<div class="card-container">
									<div class="card">
										<div class="front">
											<div class="cover">
												<img src="images/rotating_card_thumb.jpg"/>
											</div>
											<div class="user">
												<img class="img-circle" src="images/<?php if(empty($_SESSION['userimage'])) echo "users.png"; else echo $_SESSION['userimage']; ?>"/>
											</div>
											<div class="content">
												<div class="main">
													<h3 class="name"><?=$_SESSION['username'];?></h3>
													<p class="profession">Student</p>
													<p class="text-center">Gender  : <?=ucwords($gender)?></p>
													<?php if(!empty($contact_no)) { ?><p class="text-center">Contact No.  : <?=$contact_no?></p><br/><?php } ?>
													<?php if(!empty($email)) { ?><p class="text-center">Email.  : <?=ucwords($email)?></p><br/><?php } ?>
												</div>
											</div>
										</div> <!-- end front panel -->
										<div class="back">
											<div class="header">
												<?php if(!empty($description)) { ?><h5 class="motto">" <?=ucwords($description)?> !"</h5><?php } ?>
											</div>
											<div class="content">
												<div class="main">
													<?php if(!empty($address)) { ?><p class="text-center">Address.  : <?=ucwords($address)?></p><br/><?php } ?>
													<?php if(!empty($qualification)) { ?><p class="text-center">Qualification.  : <?=ucwords($qualification)?></p><br/><?php } ?>
													
													
													<?php if(!empty($city)) { ?><p class="text-center">City.  : <?=ucwords($city)?></p><?php } ?>
													<?php if($date_of_birth!="0000-00-00") { $date = explode("-",$date_of_birth);?>
														<div class="stats-container">
															<div class="stats">
																<h4><?=$date[2]?></h4>
																<p>
																	DD
																</p>
															</div>
															<div class="stats">
																<h4><?=$date[1]?></h4>
																<p>
																	MM
																</p>
															</div>
															<div class="stats">
																<h4><?=$date[0]?></h4>
																<p>
																	YYYY
																</p>
															</div>
														</div>
													<?php } ?>
													
												</div>
											</div>
											<div class="footer">
												<div class="social-links text-center">
													<a href="update_details.php" class="btn btn-primary">Update Details</a>
												</div>
											</div>
										</div> <!-- end back panel -->
									</div> <!-- end card -->
								</div> <!-- end card-container -->
							</div> <!-- end col sm 3 -->
						</div> <!-- end col-sm-10 -->
					</div> <!-- end row -->
					<br/>
					<br/>
				</div>
			</div>
			<!--footer-->
			<?php include_once"footer.php";?>
			<!--//footer-->
		</div>
		<?php include_once"footer_scripts.php";?>
		<script type="text/javascript">
			$().ready(function(){
				$('[rel="tooltip"]').tooltip();
			});
			function rotateCard(btn){
				var $card = $(btn).closest('.card-container');
				console.log($card);
				if($card.hasClass('hover')){
					$card.removeClass('hover');
					} else {
					$card.addClass('hover');
				}
			}
		</script>
	</body>
</html>
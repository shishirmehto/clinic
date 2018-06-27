<?php require_once"db/session.php"; require_once"db/db_config.php"; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | New Patient</title>
		<?php include_once"head_files.php";?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page login-page" style="width:60%;">
					<h3 class="title1">Active Patient</h3>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" id="new_patient">
								<p>Patient Name</p>
								<?php
									$query = "SELECT user.*,patients.* FROM patients INNER JOIN user on patients.userid = user.userid WHERE doctorid='".$_SESSION['doctorid']."' group by patients.userid ";
									?>
								<select class="form-control" id="userid">
									<?php
										
										$res = select($query);
										$k = 1;
										while($rows = mysqli_fetch_array($res)){ extract($rows);
											if($k==1){ $fuserid = $userid; }
										?>
										<option value="<?=$userid?>"><?=$name?></option>
									<?php $k++; } ?>
								</select>
								<div id="res">
								</div>
								
								<p class="myerror" id="error"></p>
								<input type="submit" class="animated pulse" value="Create Prescription">
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
			function get_user_details(userid1)
			{
				$.ajax({
					url : "ajax/user.php",
					method:"post",
					data:{"userid":userid1,"oldpatient_detail":1},
					success:function(res){
						$("#res").html(res);
					}
				});
			}
			$(window).load(function(){
			get_user_details(<?=$fuserid?>);
			$("#userid").focus();
				$("#userid").change(function(){
				get_user_details($(this).val());
			
				});
				$("#new_patient").submit(function(){
					var userid = $.trim($("#userid").val());
					var symptoms = $.trim($(".symptoms").val());
					var medicine = $.trim($(".medicine").val());
					var amount = $.trim($("#amount").val());
					if(userid<1)
					{
						$("#userid").focus();
						$("#userid").css('border','2px solid #ec000069');
						$("#error").text('Please Select Patient');
						alertify.error('Please Select Patient');
						return false;
					}
					$("#userid").css('border','1px solid green');
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
					if(amount<100)
					{
						$("#amount").focus();
						$("#amount").css('border','2px solid #ec000069');
						$("#amount").text('Invalid amount');
						alertify.error('Invalid amount');
						return false;
					}
					$("#amount").css('border','1px solid green');
					$("#error").text('');
					$.ajax({
						url : "ajax/user.php",
						method:"post",
						data:{"userid":userid,"symptoms":symptoms,"medicine":medicine,"amount":amount,"new_patient":1},
						success:function(data){
							alert(data);
							/*
								if(data==1)
								{
								$(this).attr("disabled","disabled");
								$("#contact_no").css('border','none');
								$("#dob").css('border','none');
								$("textarea").each(function(){
								$(this).css('border','none');
								});
								alertify.alert("Details Updated", function(){
								window.location="profile.php";
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
							*/
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
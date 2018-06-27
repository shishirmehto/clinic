<?php require_once"db/session.php";
	require_once"db/db_config.php";
	extract(mysqli_fetch_array(select("select user.*, patient_information.* from  user INNER JOIN patient_information on user.userid=patient_information.student_id WHERE user.userid='".$_SESSION['userid']."'")));
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Change Password</title>
		<?php include_once"head_files.php";?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page login-page ">
					<h3 class="title1">Update Details</h3>
					<?php
						
						?>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" id="update_details">
								<input type="text"  class="user animated rotateInUpLeft form-control" value="<?=$name?>" id="patient_name" placeholder="patient Name">
								<input type="email"  class="animated rotateInUpLeft form-control" value="<?=$email?>" id="patient_email" placeholder="patient Email">
								<div class="sign-u gender">
									<div class="sign-up1">
										<h4 class="animated bounceInLeft">Gender* :</h4>
									</div>
									<div class="sign-up2">
										<label>
											<input class="animated fadeInDown" id="gender" type="radio" name="Gender" value="male" <?php if($gender=="male") echo "checked";?>>
											Male
										</label>
										<label>
											<input class="animated fadeInDown" id="gender"  type="radio" name="Gender" value="female" <?php if($gender=="female") echo "checked";?>>
											Female
										</label>
									</div>
									<div class="clearfix"> </div>
								</div>
								<input type="date"  class="user animated rotateInUpLeft" value="<?=$date_of_birth?>" id="dob" placeholder="<?=date("Y-m-d");?>">
								<input type="text" class="user animated rotateInUpLeft" value="<?=$contact_no?>"  id="contact_no" placeholder="Enter Contact No.">
								<div class="md-form">
									<textarea type="text" id="textareaPrefix" class="form-control address md-textarea animated rotateInUpLeft" placeholder="Enter Your Address." rows="3"><?=$address?></textarea>
								</div>
								<div class="md-form">
									<textarea type="text" id="textareaPrefix" class="form-control desc md-textarea animated rotateInUpLeft" placeholder="Enter Your Description." rows="3"><?=$description?></textarea>
								</div>
								<p class="myerror" id="error"></p>
								<input type="submit" class="animated pulse" id="login_check" value="Update Details">
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
			$("#patient_name").focus();
				$("#update_details").submit(function(){
					var patient_name = $("#patient_name").val();
					patient_name = $.trim(patient_name);
					var patient_email = $("#patient_email").val();
					patient_email = $.trim(patient_email);
					var gender = $("input[id='gender']").is(':checked');
					
					var mygender = $.trim($("input[id='gender']:checked").val());
					
					var dob = $("#dob").val();
					dob = $.trim(dob);
					var contact_no = $("#contact_no").val();
					contact_no = $.trim(contact_no);
					var address = $(".address").val();
					address = $.trim(address);
					var valid_mob = /^[6789]\d{9}$/;
					var email_valid = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					var alphanum_valid = /^[-_ a-zA-Z0-9]+$/;
					var desc = $(".desc").val();
					desc = $.trim(desc);
					if(patient_name=="")
					{
						$("#patient_name").focus();
						$("#patient_name").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Name');
						alertify.error('Please Provide a Name');
						return false;
					}
					if(patient_name.length<3)
					{
						$("#patient_name").focus();
						$("#patient_name").css('border','2px solid #ec000069');
						$("#error").text('Name Should be Minimum 3 Charachter');
						alertify.error('Name Should be Minimum 3 Charachter');
						return false;
					}
					if(!alphanum_valid.test(patient_name))
					{
						$("#patient_name").focus();
						$("#patient_name").css('border','2px solid #ec000069');
						$("#error").text('Name can Only Contains Alpha Numeric Charachter');
						alertify.error('Name can Only Contains Alpha Numeric Charachter');
						return false;
					}
					$("#patient_name").css('border','1px solid green');
					if(patient_email=="")
					{
						$("#patient_email").focus();
						$("#patient_email").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a patient Email');
						alertify.error('Please Provide a patient Email');
						return false;
					}
					if(!email_valid.test(patient_email))
					{
						$("#patient_email").focus();
						$("#patient_email").css('border','2px solid #ec000069');
						$("#error").text('Invalid patient Email');
						alertify.error('Invalid patient Email');
						return false;
					}
					$("#patient_email").css('border','1px solid green');
					if(!gender)
					{
						$(".gender").focus();
						$(".gender").css('border','2px solid #ec000069');
						$("#error").text('Please Select Gender');
						alertify.error('Please Select Gender');
						return false;
					}
					$(".gender").css('border','none');
					if(dob=='0000-00-00' || dob=='')
					{
						$("#dob").focus();
						$("#dob").css('border','2px solid #ec000069');
						$("#error").text('Invalid Date of Birth');
						alertify.error('Invalid Date of Birth');
						return false;
					}
					$("#dob").css('border','1px solid green');
					if(!valid_mob.test(contact_no))
					{
						$("#contact_no").focus();
						$("#contact_no").css('border','2px solid #ec000069');
						$("#error").text('Invalid Mobile No.');
						alertify.error('Invalid Mobile No.');
						return false;
					}
					$("#contact_no").css('border','1px solid green');
					if(address.length>0)
					{
						if(address.length<3)
						{
							$(".address").focus();
							$(".address").css('border','2px solid #ec000069');
							$("#error").text('Invalid Address');
							alertify.error('Invalid Address');
							return false;
						}
					}
					$(".address").css('border','1px solid green');
					if(desc.length>0)
					{
						if(desc.length<4)
						{
							$(".desc").focus();
							$(".desc").css('border','2px solid #ec000069');
							$("#error").text('Invalid Description');
							alertify.error('Invalid Description');
							return false;
						}
					}
					$(".desc").css('border','1px solid green');
					$("#error").text('');
					$.ajax({
						url : "ajax/user.php",
						method:"post",
						data:{"patient_name":patient_name,"patient_email":patient_email,"gender":mygender,"dob":dob,"contact_no":contact_no,"address":address,"desc":desc,"update_details":1},
						success:function(data){
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
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
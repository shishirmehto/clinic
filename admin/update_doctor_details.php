<?php require_once"db/session.php";
	require_once"db/db_config.php";
	extract(mysqli_fetch_array(select("select doctor.*, doctor_information.* from doctor INNER JOIN doctor_information on doctor.doctorid=doctor_information.student_id WHERE doctor.doctorid='".$_REQUEST['doctorid']."'")));
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
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" id="update_details">
								<input type="hidden"  value="<?=$_REQUEST['doctorid']?>" id="doctorid" readonly>
								<input type="text"  class="user animated rotateInUpLeft form-control" value="<?=$name?>" id="doctor_name" placeholder="Doctor Name">
								<input type="email"  class="animated rotateInUpLeft form-control" value="<?=$email?>" id="doctor_email" placeholder="Doctor Email">
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
								<input type="date"  class="animated rotateInUpLeft form-control" value="<?=$date_of_birth?>" id="dob" placeholder="<?=date("Y-m-d");?>">
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
					
				</div>
			</div>
			<!--footer-->
			<?php include_once"footer.php";?>
			<!--//footer-->
		</div>
		<?php include_once"footer_scripts.php";?>
		<script>
			$(window).load(function(){
				$("#update_details").submit(function(){
					var doctorid = $("#doctorid").val();
					var doctor_name = $("#doctor_name").val();
					doctor_name = $.trim(doctor_name);
					var doctor_email = $("#doctor_email").val();
					doctor_email = $.trim(doctor_email);
					
					var gender = $("input[id='gender']").is(':checked');
					
					var mygender = $.trim($("input[id='gender']:checked").val());
					var email_valid = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					var alphanum_valid = /^[-_ a-zA-Z0-9]+$/;
					
					var dob = $("#dob").val();
					dob = $.trim(dob);
					var contact_no = $("#contact_no").val();
					contact_no = $.trim(contact_no);
					var address = $(".address").val();
					address = $.trim(address);
					var valid_mob = /^[6789]\d{9}$/;
					var desc = $(".desc").val();
					desc = $.trim(desc);
					
					if(doctor_name=="")
					{
						$("#doctor_name").focus();
						$("#doctor_name").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Name');
						alertify.error('Please Provide a Name');
						return false;
					}
					if(doctor_name.length<3)
					{
						$("#doctor_name").focus();
						$("#doctor_name").css('border','2px solid #ec000069');
						$("#error").text('Name Should be Minimum 3 Charachter');
						alertify.error('Name Should be Minimum 3 Charachter');
						return false;
					}
					if(!alphanum_valid.test(doctor_name))
					{
						$("#doctor_name").focus();
						$("#doctor_name").css('border','2px solid #ec000069');
						$("#error").text('Name can Only Contains Alpha Numeric Charachter');
						alertify.error('Name can Only Contains Alpha Numeric Charachter');
						return false;
					}
					$("#doctor_name").css('border','1px solid green');
					if(doctor_email=="")
					{
						$("#doctor_email").focus();
						$("#doctor_email").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Doctor Email');
						alertify.error('Please Provide a Doctor Email');
						return false;
					}
					if(!email_valid.test(doctor_email))
					{
						$("#doctor_email").focus();
						$("#doctor_email").css('border','2px solid #ec000069');
						$("#error").text('Invalid Doctor Email');
						alertify.error('Invalid Doctor Email');
						return false;
					}
					$("#doctor_email").css('border','1px solid green');
					
					if(!gender)
					{
						$(".gender").focus();
						$(".gender").css('border','2px solid #ec000069');
						$("#error").text('Please Select Gender');
						alertify.error('Please Select Gender');
						return false;
					}
					$(".gender").css('border','none');
					
					
					if(dob=='0000-00-00')
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
						data:{"doctor_name":doctor_name,"doctor_email":doctor_email,"gender":mygender,"doctorid":doctorid,"dob":dob,"contact_no":contact_no,"address":address,"desc":desc,"update_doctor_details":1},
						success:function(data){
							if(data==1)
							{
								$(this).attr("disabled","disabled");
								$("#contact_no").css('border','1px solid #ccc');
								$("#dob").css('border','1px solid #ccc');
								$("textarea").each(function(){
									$(this).css('border','1px solid #ccc');
								});
								alertify.alert("Doctor Details Updated", function(){
									window.location="view_all_doctors.php";
								});
							}
							else if(data==0)
							{
								alertify.success("No Change");
								$("input").each(function(){
									$(this).css('border','1px solid #ccc');
								});
								$("textarea").each(function(){
									$(this).css('border','1px solid #ccc');
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
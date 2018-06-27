<?php require_once"db/session2.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | SignUp Page</title>
		<?php include_once"head_files.php";?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			
			<div id="page-wrapper">
				<div class="main-page signup-page">
					<h3 class="title1 animated bounceIn">SignUp Here</h3>
					<div class="sign-up-row widget-shadow">
					<form method="post">
						<h5>Personal Information :</h5>
						<div class="sign-u">
							<div class="sign-up1">
								<h4 class="animated bounceInLeft">Name* :</h4>
							</div>
							<div class="sign-up2">
								<input class="animated fadeInDown" type="text"  id="signup_name">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<div class="sign-up1">
								<h4 class="animated bounceInLeft">Email Address* :</h4>
							</div>
							<div class="sign-up2">
								<input class="animated fadeInDown" type="text" id="signup_email">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u gender">
							<div class="sign-up1">
								<h4 class="animated bounceInLeft">Gender* :</h4>
							</div>
							<div class="sign-up2">
								<label>
									<input class="animated fadeInDown" id="gender" type="radio" name="Gender" value="male" required>
									Male
								</label>
								<label>
									<input class="animated fadeInDown" id="gender"  type="radio" name="Gender" value="female"  required>
									Female
									</label>
							</div>
							<div class="clearfix"> </div>
						</div>
						<h6>Login Information :</h6>
						<div class="sign-u">
							<div class="sign-up1">
								<h4 class="animated bounceInLeft">Password* :</h4>
							</div>
							<div class="sign-up2">
								<input class="animated fadeInDown" type="password"  id="signup_password">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<div class="sign-up1">
								<h4 class="animated bounceInLeft">Confirm Password* :</h4>
							</div>
							<div class="sign-up2">
								<input class="animated fadeInDown" type="password" id="signup_cpassword">
							</div>
							<div class="clearfix"> </div>
						</div>
						<p class="myerror" id="error"></p>
						<div class="sub_home">
							<input type="submit" class="animated flipInY"  id="signup" value="Signup Now">
							<div class="clearfix"> </div>
						</div>
						</form>
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
			$("#signup_name").focus();
				$("#signup").click(function(){
					var signup_name = $("#signup_name").val();
					signup_name = $.trim(signup_name);
					var email = $("#signup_email").val();
					email = $.trim(email);
					var password = $("#signup_password").val();
					password = $.trim(password);
					var cpassword = $("#signup_cpassword").val();
					cpassword = $.trim(cpassword);
					
					var gender = $("input[id='gender']").is(':checked');
					
					var mygender = $.trim($("input[id='gender']:checked"). val());
					
					
					var signup_mobile = $("#signup_mobile").val();
					signup_mobile = $.trim(signup_mobile);
					var mobile_first = signup_mobile.charAt(0);
					var email_valid = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					var alphanum_valid = /^[-_ a-zA-Z0-9]+$/;
					var num_valid = /^[-0-9]+$/;
					var num_valid2 = /^[-6-9]+$/;
					if(signup_name=="")
					{
						$("#signup_name").focus();
						$("#signup_name").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Name');
						alertify.error('Please Provide a Name');
						return false;
					}
					if(signup_name.length<3)
					{
						$("#signup_name").focus();
						$("#signup_name").css('border','2px solid #ec000069');
						$("#error").text('Name Should be Minimum 3 Charachter');
						alertify.error('Name Should be Minimum 3 Charachter');
						return false;
					}
					if(!alphanum_valid.test(signup_name))
					{
						$("#signup_name").focus();
						$("#signup_name").css('border','2px solid #ec000069');
						$("#error").text('Name can Only Contains Alpha Numeric Charachter');
						alertify.error('Name can Only Contains Alpha Numeric Charachter');
						return false;
					}
					$("#signup_name").css('border','1px solid green');
					if(email=="")
					{
						$("#signup_email").focus();
						$("#signup_email").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Email');
						alertify.error('Please Provide a Email');
						return false;
					}
					if(!email_valid.test(email))
					{
						$("#signup_email").focus();
						$("#signup_email").css('border','2px solid #ec000069');
						$("#error").text('Invalid Email');
						alertify.error('Invalid Email');
						return false;
					}
					$("#signup_email").css('border','1px solid green');
					
					if(!gender)
					{
						$(".gender").focus();
						$(".gender").css('border','2px solid #ec000069');
						$("#error").text('Please Select Gender');
						alertify.error('Please Select Gender');
						return false;
					}
					$(".gender").css('border','none');
					if(password.length<5)
					{
						$("#signup_password").focus();
						$("#signup_password").css('border','2px solid #ec000069');
						$("#error").text('Password Must Be 6 Charachter');
						alertify.error('Password Must Be 6 Charachter');
						return false;
					}
					$("#signup_password").css('border','1px solid green');
					
					if(password!=cpassword)
					{
						$("#signup_cpassword").focus();
						$("#signup_password").css('border','2px solid #ec000069');
						$("#signup_cpassword").css('border','2px solid #ec000069');
						$("#error").text('Password And Confirm Password Not Match');
						alertify.error('Password And Confirm Password Not Match');
						return false;
					}
					$("#signup_cpassword").css('border','1px solid green');
					$("#error").text('');
					
					$.ajax({
						url : "ajax/user.php",
						method:"post",
						data:{"signup_name":signup_name,"email":email,"password":password,"mygender":mygender,"cpassword":cpassword,"signup":1},
						success:function(data){
							if(data==1)
							{
								$(this).attr("disabled","disabled");
								$("input").each(function(){
									$(this).val('');
								});
								alertify.success('Signup Success');
								alertify.alert("Signup Success", function(){
									window.location="login.php";
								});
							}
							else if(data==0)
							{
								alertify.alert("Something Wrong", function(){
									location.reload();
								});
							}
							else
							{
								$("#signup_email").css('border','2px solid #ec000069');
								$("#signup_email").focus();
								$("#error").text(data);
								alertify.error(data);
							}
							
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
<?php require_once"db/session2.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Reset Password</title>
		<?php include_once"head_files.php";?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			<div id="page-wrapper">
				<div class="main-page signup-page">
					<h3 class="title1">SignUp Here</h3>
					<div class="sign-up-row widget-shadow">
						<div class="sign-u">
							<div class="sign-up1">
								<h4>Reset Code* :</h4>
							</div>
							<div class="sign-up2">
								<input type="text" value="<?=$_SESSION['reset_code']?>" id="resetcode">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<div class="sign-up1">
								<h4>Password* :</h4>
							</div>
							<div class="sign-up2">
								<input type="password"  id="signup_password">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<div class="sign-up1">
								<h4>Confirm Password* :</h4>
							</div>
							<div class="sign-up2">
								<input type="password" id="signup_cpassword">
							</div>
							<div class="clearfix"> </div>
						</div>
						<p class="myerror" id="error"></p>
						<div class="sub_home">
							<input type="submit"   id="reset" value="Update Password">
							<div class="clearfix"> </div>
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
				$("#reset").click(function(){
					var password = $("#signup_password").val();
					password = $.trim(password);
					var cpassword = $("#signup_cpassword").val();
					cpassword = $.trim(cpassword);
					var resetcode = $("#resetcode").val();
					resetcode = $.trim(resetcode);
					if(resetcode.length<32)
					{
						$("#resetcode").focus();
						$("#resetcode").css('border','2px solid #ec000069');
						$("#error").text('Invalid Reset Code');
						alertify.error('Invalid Reset Code');
						return false;
					}
					$("#resetcode").css('border','1px solid green');
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
						data:{"password":password,"cpassword":cpassword,'resetcode':resetcode,"reset_doctorid":<?=$_SESSION['reset_doctorid']?>,"reset":1},
						success:function(data){
							if(data==1)
							{
								$(this).attr("disabled","disabled");
								$("input").each(function(){
									$(this).val('');
								});
								alertify.success('Password Reseted');
								alertify.alert("Password Reseted Successfully", function(){
									window.location="login.php";
								});
							}
							else
							{
								alertify.error('Invalid Reset Code');
								$("#resetcode").focus();
								$("#resetcode").css('border','2px solid #ec000069');
								$("#error").text('Invalid Reset Code');
							}
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
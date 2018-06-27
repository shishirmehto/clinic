<?php require_once"db/session2.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Login Page</title>
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
				<div class="main-page login-page ">
					<h3 class="title1">SignIn Page</h3>
					<div class="widget-shadow">
						<div class="login-top">
							<h4>Welcome back to Healthcare AdminPanel ! <br> Not a Member? <a href="signup.php">  Sign Up »</a> </h4>
						</div>
						<div class="login-body">
							<form method="post" id="login_form">
								<input type="text" class="user" id="email" name="email" placeholder="Enter your email">
								<input type="password"  id="password"  name="password" class="lock" placeholder="Password">
								<p class="myerror" id="error"></p>
								<input type="submit"  id="login_check" value="Sign In">
								<div class="forgot-grid">
									<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
									<div class="forgot">
										<a href="forget.php">Forgot password?</a>
									</div>
									<div class="clearfix"> </div>
								</div>
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
				$("#login_form").submit(function(){
					var email = $("#email").val();
					email = $.trim(email);
					var password = $("#password").val();
					password = $.trim(password);
					var email_valid = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					if(email=="")
					{
						alertify.error('Please Provide a Email');
						$("#email").focus();
						$("#email").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Email');
						return false;
					}
					if(!email_valid.test(email))
					{
						alertify.error('Invalid Email');
						$("#email").focus();
						$("#email").css('border','2px solid #ec000069');
						$("#error").text('Invalid Email');
						return false;
					}
					$("#email").css('border','1px solid green');
					if(password.length<1)
					{
						alertify.error('Please Provide a Password');
						$("#password").focus();
						$("#password").css('border','2px solid #ec000069');
						$("#error").text('Please Provide a Password');
						return false;
					}
					else if(password.length<5)
					{
						alertify.error('Password Must Be 6 Charachter');
						$("#password").focus();
						$("#password").css('border','2px solid #ec000069');
						$("#error").text('Password Must Be 6 Charachter');
						return false;
					}
					$("#password").css('border','1px solid green');
					$.ajax({
						url:'ajax/user.php',
						method:'post',
						data:{'email':email,'password':password,'signin':1},
						success:function(data){
							if(data==1)
							{
								$(this).attr("disabled","disabled");
								$("input").each(function(){
									$(this).val('');
								});
								alertify.success('Login Success');
								window.location="index.php";
							}
							else if(data==2)
							{
								$("#email").css('border','2px solid #ec000069');
								$("#email").focus();
								$("#error").text("Email Not Registered");
								$("#password").css('border','2px solid #A8A8A8');
								alertify.error("Email Not Registered");
							}
							else if(data==3)
							{
								$("#password").css('border','2px solid #ec000069');
								$("#password").focus();
								$("#error").text("Credentials Wrong");
								alertify.error("Credentials Wrong");
							}
						}
					});
					return false;
				});
			});
		</script>
	</body>
</html>
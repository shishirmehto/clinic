<?php require_once"db/session2.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Forget Password</title>
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
						<h3 class="title1 animated slideInDown" >Forget Password</h3>
						<div class="widget-shadow">
							<div class="login-top">
								<h4 class="animated slideInDown">Forgetted Your Password ! <br> Remember Password ? <a href="login.php">  Login Now »</a> </h4>
							</div>
							<div class="login-body">
								<form method="post" id="login_form">
									<input type="text" class="user animated rotateInUpLeft" id="email" name="email" placeholder="Enter your email">
									<p class="myerror" id="error"></p>
									<input type="submit" class="animated rubberBand" id="login_check" value="Forget Password">
									<div class="forgot-grid">
										<div class="forgot">
											<a href="login.php">Login Now ?</a>
										</div>
										<div class="clearfix"> </div>
									</div>
								</form>
							</div>
						</div>
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
							$("#reg").hide();
							$("#email").focus();
							$("#login_form").submit(function(){
								var email = $("#email").val();
								email = $.trim(email);
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
								$.ajax({
									url:'ajax/user.php',
									method:'post',
									data:{'email':email,'forget':1},
									success:function(data){
										alert(data);
										if(data==1)
										{
											$("#error").text('');
											$("input").each(function(){
												$(this).val('');
											});
											alertify.alert("Password Reseted", function(){
												window.location="resetpassword.php";
											});
										}
										else
										{
											alertify.error("Email Not Registered");
											$("#email").css('border','2px solid #ec000069');
											$("#reg").fadeIn();
											$("#lg").fadeOut();
											$("#error").text('Email Not Registered');
										}
									}
								});
								return false;
							});
						});
					</script>
	</body>
</html>
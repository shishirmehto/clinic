<?php require_once"db/session.php";?>
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
					<h3 class="title1">Change Password</h3>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" id="change_pass">
								<input type="password"  class="lock animated rotateInUpLeft"  id="opassword" placeholder="Enter Old Password">
								<input type="password" class="lock animated rotateInUpLeft"  id="password" placeholder="Enter New Password">
								<input type="password" class="lock animated rotateInUpLeft"  id="cpassword" placeholder="Confirm Password">
								
								<p class="myerror" id="error"></p>
								
								<input type="submit" class="animated pulse" id="login_check" value="Change Password">
								
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
				$("#change_pass").submit(function(){
					var password = $("#password").val();
					password = $.trim(password);
					var cpassword = $("#cpassword").val();
					cpassword = $.trim(cpassword);
					var opassword = $("#opassword").val();
					opassword = $.trim(opassword);
					if(opassword.length==0)
					{
						$("#opassword").focus();
						$("#opassword").css('border','2px solid #ec000069');
						$("#error").text('Please Input Old Password');
						alertify.error('Please Input Old Password');
						return false;
					}
					$("#opassword").css('border','1px solid green');
					if(opassword.length<5)
					{
						$("#opassword").focus();
						$("#opassword").css('border','2px solid #ec000069');
						$("#error").text('Old Password Must Be 6 Charachter');
						alertify.error('Old Password Must Be 6 Charachter');
						return false;
					}
					$("#opassword").css('border','1px solid green');
					if(password.length<5)
					{
						$("#password").focus();
						$("#password").css('border','2px solid #ec000069');
						$("#error").text('Password Must Be 6 Charachter');
						alertify.error('Password Must Be 6 Charachter');
						return false;
					}
					$("#password").css('border','1px solid green');
					if(password!=cpassword)
					{
						$("#cpassword").focus();
						$("#password").css('border','2px solid #ec000069');
						$("#cpassword").css('border','2px solid #ec000069');
						$("#error").text('Password And Confirm Password Not Match');
						alertify.error('Password And Confirm Password Not Match');
						return false;
					}
					$("#cpassword").css('border','1px solid green');
					$("#error").text('');
					
					$.ajax({
						url : "ajax/user.php",
						method:"post",
						data:{"opassword":opassword,"password":password,"cpassword":cpassword,"change_pass":1},
						success:function(data){
							if(data==1)
							{
								$(this).attr("disabled","disabled");
								$("input").each(function(){
									$(this).val('');
									$(this).css('border','2px solid #BEBEBE');
								});
								alertify.alert("Password Changed", function(){
								alertify.success('Password Changed');
								});
							}
							else if(data==0)
							{ alertify.success("No Change"); }
							else if(data==2)
							{
								$("input").each(function(){
									$(this).css('border','2px solid #BEBEBE');
								});
								$("#opassword").css('border','2px solid #ec000069');
								$("#opassword").focus();
								$("#error").text("Incorrect Old Password");
								alertify.error("Incorrect Old Password");
								
							}
						}
					});
					
					return false;
				});
			});
		</script>
	</body>
</html>
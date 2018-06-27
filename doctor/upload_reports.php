<?php require_once"db/session.php";?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Healthcare | Profile Picture</title>
		<?php include_once"head_files.php";?>
		
		<style>
			
			.file-upload__input {
			position: absolute;
			left: 0;
			top: 0;
			right: 0;
			bottom: 0;
			font-size: 1;
			width:0;
			height: 100%;
			opacity: 0;
			}
			
			.btn-file {
			position: relative;
			overflow: hidden;
			}
			.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
			
			}
			
			#imagePreview{
			width: 100%;
			}
			.input-group {
			position: relative;
			display: table;
			width: 100%;
			float: left;
			margin: 0;
			border-collapse: separate;
			}
			.check{
			width: 100%;
			background: #5dc7fb;
			margin: 9px auto;
			color: white;
			font-weight: bolder;}
		</style>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<?php include_once"sidebar.php";?>
			<?php include_once"header.php";?>
			
			<div id="page-wrapper">
				<div class="main-page login-page ">
					<h3 class="title1 animated pulse">Change Profile Picture</h3>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" action="ajax/upload.php" id="change_pic" enctype="multipart/form-data">
								<div class="form-group">
									<?php
									$query = "SELECT user.*,patients.* FROM patients INNER JOIN user on patients.userid = user.userid WHERE doctorid='".$_SESSION['doctorid']."' group by patients.userid ";
									?>
								<select class="form-control" name="userid" id="userid">
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
								
								
								<label>Upload Image</label>
									<div class="input-group">
										<span class="btn btn-default btn-file check animated bounceInLeft"  >
											Browse…  <input type="file"  class="upload__input animated bounceInLeft" name="myimage" id="file" onchange="return fileValidation()"/>
										</span>
									</div>
									<div id="imagePreview" style="text-align:center;"></div>
								</div>
								
								<p class="myerror" id="error"></p>
								
								<input type="submit" class="animated flipInY"  name="upload_report" id="img_upload" value="Upload Report">
								
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
		
		function get_user_details(userid1)
			{
				$.ajax({
					url : "ajax/user.php",
					method:"post",
					data:{"userid":userid1,"patient_detail":1},
					success:function(res){
						$("#res").html(res);
					}
				});
			}
			
			
			function fileValidation(){
				var fileInput = document.getElementById('file');
				var imagePreview = document.getElementById('imagePreview');
				var filePath = fileInput.value;
				var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
				if(!allowedExtensions.exec(filePath)){
					alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
					fileInput.value = '';
					imagePreview.innerHTML="";
					return false;
					}else{
					//Image preview
					if (fileInput.files && fileInput.files[0]) {
						var reader = new FileReader();
						reader.onload = function(e) {
							document.getElementById('imagePreview').innerHTML = '<img style="width:300px;" src="'+e.target.result+'"/>';
						};
						reader.readAsDataURL(fileInput.files[0]);
					}
				}
			}
			
			$(window).load(function(){
			$("#userid").focus();
			
			get_user_details(<?=$fuserid?>);
			$("#userid").change(function(){
				get_user_details($(this).val());
				});
				$("#change_pic").submit(function(){
					return true;
				});
			});
		</script>
	</body>
</html>
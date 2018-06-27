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
					<h3 class="title1 animated pulse">Upload Your Resume</h3>
					<div class="widget-shadow">
						<div class="login-body">
							<form method="post" action="ajax/upload_resume.php" id="change_pic" enctype="multipart/form-data">
								<div class="form-group">
									<label>Upload Resume</label>
									<div class="input-group">
										<span class="btn btn-default btn-file check animated bounceInLeft"  >
											Browse…  <input type="file"  class="upload__input animated bounceInLeft" name="myimage" id="file" onchange="return fileValidation()"/>
										</span>
									</div>
									<div id="imagePreview" style="text-align:center;"></div>
								</div>
								
								<p class="myerror" id="error"></p>
								
								<input type="submit" class="animated flipInY"  name="upload" id="img_upload" value="Upload Resume">
								
							</form>
						</div>
					</div>
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div>
			</div>
			<!--footer-->
			<?php include_once"footer.php";?>
			<!--//footer-->
		</div>
		<?php include_once"footer_scripts.php";?>
		<script>
			function fileValidation(){
				var fileInput = document.getElementById('file');
				var imagePreview = document.getElementById('imagePreview');
				var filePath = fileInput.value;
				var allowedExtensions = /(\.jpg|\.jpeg|\.doc|\.docx)$/i;
				if(!allowedExtensions.exec(filePath)){
					alert('Please upload file having extensions .jpeg/.jpg/.doc/.docx only.');
					fileInput.value = '';
					imagePreview.innerHTML="";
					return false;
					}else{
					//Image preview
					
				}
			}
			
			$(window).location(function(){
				$("#change_pic").submit(function(){
					alert('tesrt');
					return true;
				});
			});
		</script>
	</body>
</html>
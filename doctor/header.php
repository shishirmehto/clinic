<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="index.php">
						<h1>Healthcare</h1>
						<span>Hospital</span>
					</a>
				</div>
				<!--//logo-->
				
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				<?php if(isset($_SESSION['doctorid'])) {?>
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img style="width:60px;height:60px;" src="images/<?=$_SESSION['userimage']?>" alt=""> </span> 
									<div class="user-name">
										<p><?=$_SESSION['username'];?></p>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="change_password.php"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="update_details.php"><i class="fa fa-user"></i>Update Details</a> </li> 
								<li> <a href="change_image.php"><i class="fa fa-user"></i>Profile Pic</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				
				
				<?php } else { ?>
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<div class="user-name">
										<p>Login</p>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="login.php"><i class="fa fa-user"></i>Login</a> </li> 
								<li> <a href="signup.php"><i class="fa fa-cog"></i> Signup</a> </li> 
								<li> <a href="forget.php"><i class="fa fa-key"></i> Forget</a> </li> 
							</ul>
						</li>
					</ul>
				</div>
				
				<?php } ?>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						
						<?php if(isset($_SESSION['userid'])) {?>
						<li>
							<a href="index.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						<li>
							<a href="profile.php"><i class="fa fa-user nav_icon"></i>Profile</a>
						</li>
						<li>
							<a href="prescription.php"><i class="fa fa-user nav_icon"></i>Prescription</a>
						</li>
						<li>
							<a href="reports.php"><i class="fa fa-user nav_icon"></i>Reports</a>
						</li>
						<li>
							<a href="change_password.php"><i class="fa fa-key nav_icon"></i>Change Password</a>
						</li>
						<li>
							<a href="update_details.php"><i class="fa fa-user nav_icon"></i>Update Details</a>
						</li>
						
						<li>
							<a href="change_image.php"><i class="fa fa-camera nav_icon"></i>Change Profile Pic</a>
						</li>
						
						<?php }else { ?>
						<li>
							<a href="login.php"><i class="fa fa-user nav_icon"></i>Login</a>
						</li>
						
						<li>
							<a href="signup.php"><i class="fa fa-user nav_icon"></i>Signup</a>
						</li>
						
						<li>
							<a href="forget.php"><i class="fa fa-user nav_icon"></i>Forget</a>
						</li>
						<?php } ?>
						<!--<li>
							<a href="#"><i class="fa fa-cogs nav_icon"></i>Components <span class="nav-badge">12</span> <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="grids.php">Grid System</a>
								</li>
								<li>
									<a href="media.php">Media Objects</a>
								</li>
							</ul>
						</li>-->
						
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
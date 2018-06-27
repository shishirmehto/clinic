<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						
						<?php if(isset($_SESSION['adminid'])) {?>
						<li>
							<a href="index.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						
						<li>
							<a href="view_active_patients.php"><i class="fa fa-home nav_icon"></i>All Active Patients</a>
						</li>
						<li>
							<a href="upload_reports.php"><i class="fa fa-home nav_icon"></i>Upload Reports</a>
						</li>
						
						<li>
							<a href="old_patient.php"><i class="fa fa-home nav_icon"></i>Add Prescription</a>
						</li>
						
						<li>
							<a href="view_all_doctors.php"><i class="fa fa-home nav_icon"></i>All Doctors</a>
						</li>
						
						<li>
							<a href="change_password.php"><i class="fa fa-key nav_icon"></i>Change Password</a>
						</li>
						
						<?php }else { ?>
						<li>
							<a href="login.php"><i class="fa fa-user nav_icon"></i>Login</a>
						</li>
						
						<li>
							<a href="forget.php"><i class="fa fa-user nav_icon"></i>Forget</a>
						</li>
						<?php } ?>
												
					</ul>
				</nav>
			</div>
		</div>
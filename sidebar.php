<?php 
$newsql = "SELECT * FROM subject ";
$newquery=mysqli_query($conn, $newsql);
$num_subject = mysqli_num_rows($newquery);

$newsql = "SELECT * FROM department ";
$newquery=mysqli_query($conn, $newsql);
$num_dept = mysqli_num_rows($newquery);

$newsql = "SELECT * FROM student ";
$newquery=mysqli_query($conn, $newsql);
$num_student = mysqli_num_rows($newquery);

$newsql = "SELECT * FROM result ";
$newquery=mysqli_query($conn, $newsql);
$num_result = mysqli_num_rows($newquery);

$newsql = "SELECT * FROM user WHERE status=1";
$newquery=mysqli_query($conn, $newsql);
$num_activeuser = mysqli_num_rows($newquery);

$newsql = "SELECT * FROM user WHERE status=0";
$newquery=mysqli_query($conn, $newsql);
$num_inactiveuser = mysqli_num_rows($newquery);
?>
<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="dashboard.php">
		  <span class="align-middle">Admin Panel</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Menus
			</li>
			
			<li class="sidebar-item <?php if($page == "dashboard"){ echo "active"; } ?>">
				<a class="sidebar-link" href="dashboard.php">
					<i class="fa fa-dashboard"></i><span class="align-middle">Dashboard</span>
				</a>
			</li>	
			<li class="sidebar-item <?php if($page == "subject" || $page == "department" || $page == "student"){ echo "active"; } ?>">
				<a data-bs-target="#master" data-bs-toggle="collapse" class="sidebar-link collapsed">
					<i class="fa fa-database"></i><span class="align-middle">Master</span>
				</a>
				<ul id="master" class="sidebar-dropdown list-unstyled collapse <?php if($page == "subject" || $page == "department" || $page == "student"){ echo "show"; } ?>" data-bs-parent="#sidebar">
					<li class="sidebar-item <?php if($page == "department"){ echo "active"; } ?>"><a class="sidebar-link" href="department.php">Department <span class="sidebar-badge badge bg-primary"><?php echo $num_dept; ?></span></a></li>
					<li class="sidebar-item <?php if($page == "subject"){ echo "active"; } ?>"><a class="sidebar-link" href="subject.php">Subjects <span class="sidebar-badge badge bg-primary"><?php echo $num_subject; ?></span></a></li>		
					<li class="sidebar-item <?php if($page == "student"){ echo "active"; } ?>"><a class="sidebar-link" href="student.php">Student <span class="sidebar-badge badge bg-primary"><?php echo $num_student; ?></span></a></li>	
				</ul>
			</li>
			<li class="sidebar-item <?php if($page == "result"){ echo "active"; } ?>">
				<a class="sidebar-link" href="results.php">
					<i class="fa fa-graduation-cap"></i><span class="align-middle">Result</span>
				</a>
			</li>
			<li class="sidebar-item <?php if($page == "settings"){ echo "active"; } ?>">
				<a class="sidebar-link" href="settings.php">
					<i class="fa fa-cog"></i><span class="align-middle">Settings</span>
				</a>
			</li>
			<li class="sidebar-item <?php if($page == "user"){ echo "active"; } ?>">
				<a class="sidebar-link" href="user.php">
					<i class="fa fa-user"></i><span class="align-middle">User <span class="sidebar-badge badge bg-success"><?php echo $num_activeuser; ?></span></span>
				</a>
			</li>
		</ul>

		
	</div>
</nav>
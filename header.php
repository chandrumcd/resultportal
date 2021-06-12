<?php 
include("includes/connection.php"); 
include('head.php');
if(!isset($_SESSION['user']['status']) || ($_SESSION['user']['status'] !== "login")){
	header("Location: index.php");
} 
$loginuser = $_SESSION['user']['name'];
?>
<body>
	<div class="wrapper">
		<?php include('sidebar.php'); ?>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
				  <i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="<?php echo ucwords($loginuser); ?>" /> <span class="text-dark"><?php echo ucwords($loginuser); ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
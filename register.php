<?php 
include("includes/connection.php"); 
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "register"){
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$usertype = $_POST['usertype'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$query = "INSERT INTO `user`(`name`, `email`, `mobile`, `username`, `password`, `usertype`, `status`) VALUES ('$name', '$email', '$mobile', '$username', '$password', '$usertype', 0)";
		$query_result = mysqli_query($conn,$query);	
		if($query_result){
			$msg = "Registered Successfully";
			$alert = "success";
		} else {
			$msg = "Registration Failed";
			$alert = "danger";
		}
	}	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Register - ICC Education | Blitzjobs</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">ICC Education | Blitzjobs</h1>
							<p class="lead">
								Create your Account
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								
								<div class="m-sm-4">
									<?php
									if($msg !== ""){ ?>
										<div class="alert alert-<?php echo $alert; ?>" role="alert">
											<?php echo $msg; ?>
										</div>
									<?php } ?>
									<form action="register.php" method="post">
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Mobile</label>
											<input class="form-control form-control-lg num" type="number" id="mobile" name="mobile" maxlength="12" placeholder="Enter your mobile number" onchange="verifyunique();" required />
											<div id="mobileunique"></div>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Enter your email" onchange="verifyunique();" />
											<div id="emailunique"></div>
										</div>
										<div class="mb-3">
											<label class="form-label">Usertype</label>
											<select name="usertype" class="form-control form-control-lg" required>
												<option value="">Select Usertype</option>
												<option value="User">User</option>
											</select>
										</div>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Enter your username" onchange="verifyunique();" required />
											<div id="usernameunique"></div>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" required />
										</div>
										<div>
											<label class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" required checked>
												<span class="form-check-label">
												  I agree <a href="#">Terms and Conditions</a>
												</span>
											</label>
											<span class="float-end text-navy">Already have an Account? <a href="index.php" class="card-link">Login here</a></span>
										</div>
										<div class="text-center mt-3">
											<input class="form-control form-control-lg" type="hidden" name="action" value="register" />
											<button id="registerbtn" type="submit" class="btn btn-lg btn-success btn-block" disabled>Register</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/custom.js"></script>

</body>

</html>
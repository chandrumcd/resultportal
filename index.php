<?php 
include("includes/connection.php"); ?>
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

	<title>Login - ICC Education | Blitzjobs</title>
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
								Login to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								
								<div class="m-sm-4">
									<div id="loginstatus"></div>
									<form>
										<div class="mb-3">
											<label class="form-label">Email / Username</label>
											<input class="form-control form-control-lg" type="text" name="username" id="username" placeholder="Enter your Email or Username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Enter your password" />
										</div>
										<div>
											<label class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
												<span class="form-check-label">
												  Remember me
												</span>
											</label>
											<span class="float-end text-navy">Don't have an Account? <a href="register.php" class="card-link">Register here</a></span>
										</div>
										<div class="text-center mt-3">											
											<button type="button" class="btn btn-lg btn-success btn-block" onclick="login();">Login</button>
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
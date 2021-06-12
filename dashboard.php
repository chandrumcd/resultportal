<?php 
$page = "dashboard";
include('header.php'); ?>
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><strong>User</strong> Dashboard</h1>

		<div class="row">
			<div class="col-12 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Departments</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="fa fa-eye"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $num_dept; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Subjects</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="fa fa-eye"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $num_subject; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Students</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="fa fa-eye"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $num_student; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Results</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="fa fa-eye"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $num_result; ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title mb-0">Top Students</h5>
					</div>
					<table class="table table-hover my-0">
						<thead>
							<tr>
								<th>Roll No</th>
								<th>Name</th>
								<th class="d-none d-xl-table-cell">Mobile</th>
								<th class="d-none d-xl-table-cell">Email</th>
								<th>Dept</th>
								<th>Subject</th>
								<th>Mark</th>
								<th>Status</th>
								<th>Grade</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$newsql = "SELECT * FROM result ORDER BY markobtain DESC LIMIT 10 ";
							$newquery=mysqli_query($conn, $newsql);
							$sno = 1;
							while( $rows=mysqli_fetch_array($newquery) ) {
								$id = $rows["id"];
								$rollno = $rows["rollno"];
								$subject = $rows["subject"];
								$totalmark = $rows["totalmark"];
								$markobtain = $rows["markobtain"];
								$result = $rows["result"];
								$grade = $rows["grade"];
												
								$sql = "SELECT * FROM student WHERE rollno=$rollno";
								$query=mysqli_query($conn, $sql);
								while( $row=mysqli_fetch_array($query) ) {
									$stdname = $row["name"];
									$stdemail = $row["email"];
									$stdmobile = $row["mobile"];
									$stddept = $row["dept"];
								}
								$sql = "SELECT * FROM subject WHERE sno=$subject";
								$query=mysqli_query($conn, $sql);
								while( $row=mysqli_fetch_array($query) ) {
									$subjectname = $row["subject"];
								}
								$sql = "SELECT * FROM department WHERE sno=$stddept";
								$query=mysqli_query($conn, $sql);
								while( $row=mysqli_fetch_array($query) ) {
									$departmentname = $row["department"];
								}
								?>
								<tr>
									<td><?php echo $rows["rollno"]; ?></td>					
									<td><?php echo $stdname; ?></td>					
									<td class="d-none d-xl-table-cell"><?php echo $stdmobile; ?></td>					
									<td class="d-none d-xl-table-cell"><?php echo $stdemail; ?></td>					
									<td><?php echo $departmentname; ?></td>					
									<td><?php echo $subjectname; ?></td>					
									<td><?php echo $markobtain."/".$totalmark; ?></td>					
									<td>
										<?php 
										if($result == 1){ ?>
											<span class="badge bg-success">Pass</span>
										<?php } else { ?>
											<span class="badge bg-danger">Fail</span>
										<?php } ?>
									</td>					
									<td><?php echo $grade; ?></td>					
									
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</main>
<?php include('footer.php'); ?>
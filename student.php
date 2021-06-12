<?php 
$page = "student";
include('header.php'); 
$msg = "";
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "add"){
		$rollno = $_POST['rollno'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		
		$sql = "INSERT INTO `student`(`rollno`, `name`, `email`, `mobile`, `dept`) VALUES ($rollno, '$name', '$email', '$mobile', '$department')";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Student Added Successfully";
			$alert = "success";
		} else {
			$msg = "Student Failed to Add";
			$alert = "danger";
		}
	}
	if($action == "edit"){
		$rollno = $_POST['rollno'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		
		$sql = "UPDATE `student` SET `name`='$name', `email`='$email', `mobile`='$mobile', `dept`='$department' WHERE rollno=$rollno";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Student Details Updated Successfully";
			$alert = "success";
		} else {
			$msg = "Student Details Failed to Update";
			$alert = "danger";
		}
	}
	if($action == "delete"){
		$rollno = $_POST['rollno'];
		$sql = "DELETE from `student` WHERE rollno=$rollno";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Student Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "Student Failed to Delete";
			$alert = "danger";
		}
	}
}
?>
<div class="card card-default">
	<div class="card-header card-header-border-bottom">
        <div style="width: 100%; height: 100%;">
          <h2 style="display: inline-block;">Student</h2>
          <button class="btn btn-info" data-toggle="modal" data-target="#addsubject" style="display: inline-block; float: right;">Add Student</button>
        </div>
	</div>
	<div class="card-body">
		<?php
		if($msg !== ""){ ?>
			<div class="alert alert-<?php echo $alert; ?>" role="alert">
				<?php echo $msg; ?>
			</div>
		<?php } ?>
		<table class="table" id="example-table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Rollno</th>
					<th scope="col">Name</th>
					<th scope="col">Mobile</th>
					<th scope="col">Email</th>
					<th scope="col">Department</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $newsql = "SELECT * FROM student ORDER BY name DESC ";
        	$newquery=mysqli_query($conn, $newsql);
            $sno = 1;
        	while( $rows=mysqli_fetch_array($newquery) ) {
				$rollno = $rows["rollno"];
				$dept = $rows["dept"];
				
				$sql = "SELECT * FROM department WHERE sno=$dept";
				$query=mysqli_query($conn, $sql);
				while( $row=mysqli_fetch_array($query) ) {
					$deptname = $row["department"];
				}
				?>
				<tr>
					<td scope="row"><?php echo $sno; ?></td>
					<td><?php echo $rows["rollno"]; ?></td>					
					<td><?php echo $rows["name"]; ?></td>					
					<td><?php echo $rows["mobile"]; ?></td>					
					<td><?php echo $rows["email"]; ?></td>					
					<td><?php echo $deptname; ?></td>					
					<td>
						<button class="btn btn-info btn-xs" style="display: inline-block;" onclick="editstudent(<?php echo $rollno; ?>);"><i class="fa fa-pencil"></i></button>
					  <form action="student.php" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
						<input type="hidden" class="form-control" id="rollno" name="rollno" value="<?php echo $rollno; ?>">
						<input type="hidden" class="form-control" id="action" name="action" value="delete">
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
					  </form>
					</td>
				</tr>
				<?php
				$sno = $sno + 1; } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
function editstudent(rollno){
  $('.categoryedit').load('modalview.php?rollno='+rollno+'&action=editstudent',function(){
		$('#editstudentmodal').modal('show');
	
  });
}
</script>

<div class="modal fade" id="editstudentmodal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Student</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body categoryedit">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="addsubject" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Student</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="student.php" method="POST">
			<div class="form-group">
				<label for="exampleFormControlInput1">Roll no</label>
				<input type="text" class="form-control" id="rollno" name="rollno" required onchange="rollnouique();">
				<input type="hidden" class="form-control" id="action" name="action" value="add">
				<div id="rollnounique"></div>
				<!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="mobile" name="mobile" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="department">Department</label><br>
				<select class="form-control select2bs4" name="department" style="width: 100%;" required>
				  <option value="">-SELECT-</option>
				  <?php
				  $sql = "SELECT * FROM department ";
				  $query=mysqli_query($conn, $sql);
				  while( $row=mysqli_fetch_array($query) ) {
					$deptid = $row["sno"];
					$deptname = $row["department"]; ?>
					<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?></option>
				  <?php } ?>
				</select>
			</div>
			<button type="submit" id="submitbtn" class="btn btn-primary btn-default" disabled >Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php 
include('footer.php'); ?>
<script type="text/javascript">
	$(function() {
		$('#example-table').DataTable({
			pageLength: 10
		});
	});
	$(function () {
		//Initialize Select2 Elements
		$('.select2bs4').select2();
	});
</script>
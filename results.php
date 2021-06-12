<?php 
$page = "result";
include('header.php'); 
$msg = "";
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "add"){
		$student = $_POST['student'];
		$subject = $_POST['subject'];
		$totalmarks = $_POST['totalmarks'];
		$marksobtain = $_POST['marksobtain'];
		$status = $_POST['status'];
		$grade = $_POST['grade'];
		if($status == "Pass"){
			$status = 1;
		} else {
			$status = 0;
		}
		
		$newsql = "SELECT * FROM result WHERE rollno=$student AND subject='$subject' ";
		$newquery=mysqli_query($conn, $newsql);
		$num_result = mysqli_num_rows($newquery);
		
		if($num_result > 0){
			$sql = "UPDATE `result` SET `totalmark`=$totalmarks, `markobtain`=$marksobtain, `result`=$status, `grade`='$grade' WHERE rollno=$student AND subject='$subject'";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Result Updated Successfully";
				$alert = "success";
			} else {
				$msg = "Result Failed to Update";
				$alert = "danger";
			}
		} else {
			$sql = "INSERT INTO `result`(`rollno`, `subject`, `totalmark`, `markobtain`, `result`, `grade`) VALUES ($student, '$subject', $totalmarks, $marksobtain, $status, '$grade')";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Result Added Successfully";
				$alert = "success";
			} else {
				$msg = "Result Failed to Add";
				$alert = "danger";
			}
		}
	}
	if($action == "edit"){
		$id = $_POST['id'];
		$student = $_POST['student'];
		$subject = $_POST['subject'];
		$totalmarks = $_POST['totalmarks'];
		$marksobtain = $_POST['marksobtain'];
		$status = $_POST['status'];
		$grade = $_POST['grade'];
		if($status == "Pass"){
			$status = 1;
		} else {
			$status = 0;
		}
		
		$sql = "UPDATE `result` SET `rollno`=$student, `subject`='$subject', `totalmark`=$totalmarks, `markobtain`=$marksobtain, `result`=$status, `grade`='$grade' WHERE id=$id";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Result Updated Successfully";
			$alert = "success";
		} else {
			$msg = "Result Failed to Update";
			$alert = "danger";
		}
	}
	if($action == "delete"){
		$id = $_POST['id'];
		$sql = "DELETE from `result` WHERE id=$id";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Result Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "Result Failed to Delete";
			$alert = "danger";
		}
	}
}
?>
<div class="card card-default">
	<div class="card-header card-header-border-bottom">
        <div style="width: 100%; height: 100%;">
          <h2 style="display: inline-block;">Result</h2>
          <button class="btn btn-info" data-toggle="modal" data-target="#addsubject" style="display: inline-block; float: right;">Add Result</button>
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
					<th scope="col">Dept</th>
					<th scope="col">Subject</th>
					<th scope="col">Mark</th>
					<th scope="col">Result</th>
					<th scope="col">Grade</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $newsql = "SELECT * FROM result ORDER BY rollno DESC ";
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
					<td scope="row"><?php echo $sno; ?></td>
					<td><?php echo $rows["rollno"]; ?></td>					
					<td><?php echo $stdname; ?></td>					
					<td><?php echo $stdmobile; ?></td>					
					<td><?php echo $stdemail; ?></td>					
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
					<td>
						<button class="btn btn-info btn-xs" style="display: inline-block;" onclick="editresult(<?php echo $id; ?>);"><i class="fa fa-pencil"></i></button>
					  <form action="results.php" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
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

<div class="modal fade" id="editresults" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Result</h4>
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
        <h4 class="modal-title">Add Result</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="results.php" method="POST">
			<div class="form-group">
				<label for="exampleFormControlInput1">Student</label>
				<select class="form-control select2bs4" name="student" id="student" style="width: 100%;" onchange="studentdetail();" required>
				  <option value="">-SELECT-</option>
				  <?php
				  $sql = "SELECT * FROM student ";
				  $query=mysqli_query($conn, $sql);
				  while( $row=mysqli_fetch_array($query) ) {
					$name = $row["name"];
					$rollno = $row["rollno"]; ?>
					<option value="<?php echo $rollno; ?>"><?php echo $name; ?></option>
				  <?php } ?>
				</select>
				<input type="hidden" class="form-control" id="action" name="action" value="add">
				<!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="modal_name" name="modal_name" required readonly >
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="modal_mobile" name="modal_mobile" required readonly >
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="modal_email" name="modal_email" required readonly >
			</div>
			<div class="form-group">
				<label for="department">Department</label><br>
				<input type="text" class="form-control" id="modal_department" name="modal_department" required readonly >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Subject</label>
				<select class="form-control select2bs4" name="subject" style="width: 100%;" required>
				  <option value="">-SELECT-</option>
				  <?php
				  $sql = "SELECT * FROM subject ";
				  $query=mysqli_query($conn, $sql);
				  while( $row=mysqli_fetch_array($query) ) {
					$subject = $row["subject"];
					$subjectid = $row["sno"]; ?>
					<option value="<?php echo $subjectid; ?>"><?php echo $subject; ?></option>
				  <?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="totalmarks">Total Marks</label><br>
				<input type="number" class="form-control" id="totalmarks" name="totalmarks" required min="1" max="100" >
			</div>
			<div class="form-group">
				<label for="marksobtain">Marks Obtain</label><br>
				<input type="number" class="form-control" id="marksobtain" name="marksobtain" required min="1" max="100" onkeyup="gradescpt();" >
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<input type="text" class="form-control" id="status" name="status" required readonly >
			</div>
			<div class="form-group">
				<label for="grade">Grade</label><br>
				<input type="text" class="form-control" id="grade" name="grade" required readonly >
			</div>
			<button type="submit" id="submitbtn" class="btn btn-primary btn-default" >Submit</button>
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

<script>
function editresult(id){
  $('.categoryedit').load('modalview.php?id='+id+'&action=editresult',function(){
		$('#editresults').modal('show');
	
  });
}
</script>
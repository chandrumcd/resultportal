<?php 
session_start();
include("includes/connection.php"); 
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	$action = $_GET['action'];
	if($action == "editresult"){ 
		$id = $_GET['id'];
		$newsql = "SELECT * FROM result WHERE id=$id ";
		$newquery=mysqli_query($conn, $newsql);
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
		}
		if($result == 1){
			$result = "Pass";
		} else {
			$result = "Fail";
		}
		?>
		<form action="results.php" method="POST">
			<div class="form-group">
				<label for="exampleFormControlInput1">Student</label>
				<select class="form-control select2bs4" name="student" id="editstudent" style="width: 100%;" onchange="editstudentdetail();" required>
				  <option value="">-SELECT-</option>
				  <?php
				  $sql = "SELECT * FROM student ";
				  $query=mysqli_query($conn, $sql);
				  while( $row=mysqli_fetch_array($query) ) {
					$stdname = $row["name"];
					$stdrollno = $row["rollno"]; ?>
					<option value="<?php echo $rollno; ?>" <?php if($stdrollno == $rollno){echo "SELECTED";} ?>><?php echo $stdname; ?></option>
				  <?php } ?>
				</select>
				<input type="hidden" class="form-control" id="action" name="action" value="edit">
				<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
				<!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="editmodal_name" name="modal_name" value="<?php echo $stdname; ?>" required readonly>
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="editmodal_mobile" name="modal_mobile" value="<?php echo $stdmobile; ?>" required readonly >
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="editmodal_email" name="modal_email" value="<?php echo $stdemail; ?>" required readonly >
			</div>
			<div class="form-group">
				<label for="department">Department</label><br>
				<input type="text" class="form-control" id="editmodal_department" name="modal_department" value="<?php echo $departmentname; ?>" required readonly >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Subject</label>
				<select class="form-control select2bs4" name="subject" style="width: 100%;" required>
				  <option value="">-SELECT-</option>
				  <?php
				  $sql = "SELECT * FROM subject ";
				  $query=mysqli_query($conn, $sql);
				  while( $row=mysqli_fetch_array($query) ) {
					$subjectname = $row["subject"];
					$subjectid = $row["sno"]; ?>
					<option value="<?php echo $subjectid; ?>" <?php if($subject == $subjectid){ echo "SELECTED"; } ?>><?php echo $subjectname; ?></option>
				  <?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="totalmarks">Total Marks</label><br>
				<input type="number" class="form-control" id="totalmarks" name="totalmarks" value="<?php echo $totalmark; ?>" required min="1" max="100" >
			</div>
			<div class="form-group">
				<label for="marksobtain">Marks Obtain</label><br>
				<input type="number" class="form-control" id="editmarksobtain" name="marksobtain" value="<?php echo $markobtain; ?>" required min="1" max="100" onkeyup="gradescpt();" >
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<input type="text" class="form-control" id="editstatus" name="status" value="<?php echo $result; ?>" required readonly >
			</div>
			<div class="form-group">
				<label for="grade">Grade</label><br>
				<input type="text" class="form-control" id="editgrade" name="grade" value="<?php echo $grade; ?>" required readonly >
			</div>
			<button type="submit" id="submitbtn" class="btn btn-primary btn-default" >Submit</button>
        </form>
		<script>
		$(function () {
			//Initialize Select2 Elements
			$('.select2bs4').select2();
		});
		</script>
	<?php 	
	}
	if($action == "editstudent"){ 
		$rollno = $_GET['rollno'];
		$newsql = "SELECT * FROM student WHERE rollno=$rollno ";
		$newquery=mysqli_query($conn, $newsql);
		while( $rows=mysqli_fetch_array($newquery) ) {
			$rollno = $rows["rollno"];
			$name = $rows["name"];
			$mobile = $rows["mobile"];
			$email = $rows["email"];
			$dept = $rows["dept"];
		}
		?>
		<form action="student.php" method="POST">
			<div class="form-group">
				<label for="exampleFormControlInput1">Roll no</label>
				<input type="text" class="form-control" id="rollno" name="rollno" required  value="<?php echo $rollno; ?>" readonly>
				<input type="hidden" class="form-control" id="action" name="action" value="edit">
				<!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
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
					<option value="<?php echo $deptid; ?>"  <?php if($dept == $deptid){ echo "SELECTED"; } ?>><?php echo $deptname; ?></option>
				  <?php } ?>
				</select>
			</div>
			<button type="submit" id="submitbtn" class="btn btn-primary btn-default" >Submit</button>
        </form>
		<?php 
	}
	if($action == "editdepartment"){ 
		$id = $_GET['id'];
		$newsql = "SELECT * FROM department WHERE sno=$id ";
		$newquery=mysqli_query($conn, $newsql);
		while( $rows=mysqli_fetch_array($newquery) ) {
			$department = $rows["department"];
		}
		?>
		<form action="department.php" method="POST">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $department; ?>" required>
            <input type="hidden" class="form-control" id="action" name="action" value="edit">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </form>
	<?php 
	}
	if($action == "editsubject"){ 
		$id = $_GET['id'];
		$newsql = "SELECT * FROM subject WHERE sno=$id ";
		$newquery=mysqli_query($conn, $newsql);
		while( $rows=mysqli_fetch_array($newquery) ) {
			$subject = $rows["subject"];
		}
		?>
		<form action="subject.php" method="POST">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $subject; ?>" required>
            <input type="hidden" class="form-control" id="action" name="action" value="edit">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </form>
	<?php 
	}
	if($action == "edituser"){ 
		$id = $_GET['id'];
		$newsql = "SELECT * FROM user WHERE sno=$id ";
		$newquery=mysqli_query($conn, $newsql);
		while( $rows=mysqli_fetch_array($newquery) ) {
			$name = $rows["name"];
			$status = $rows["status"];
		}
		?>
		<form action="user.php" method="POST">
			<div class="form-group">
				<label for="exampleFormControlInput1">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
				<input type="hidden" class="form-control" id="action" name="action" value="edit">
				<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep existing password" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Status</label>
				<select name="status" id="status" class="form-control">
					<option value="1" <?php if($status == 1){ echo "SELECTED"; } ?>>Enable</option>
					<option value="0" <?php if($status == 0){ echo "SELECTED"; } ?>>Disable</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary btn-default">Submit</button>
        </form>
	<?php 
	}
}	
?>
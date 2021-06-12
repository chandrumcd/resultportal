<?php 
$page = "department";
include('header.php'); 
$msg = "";
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "add"){
		$name = $_POST['name'];
		$newsql = "SELECT * FROM department WHERE department='$name' ";
		$newquery=mysqli_query($conn, $newsql);
		$num_department = mysqli_num_rows($newquery);
		if($num_department > 0){
			$msg = "Duplicate Entry";
			$alert = "danger";
		} else {
			$sql = "INSERT INTO `department`(`department`, `status`) VALUES ('$name', 1)";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Department Added Successfully";
				$alert = "success";
			} else {
				$msg = "Department Failed to Add";
				$alert = "danger";
			}
		}
	}
	if($action == "edit"){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$newsql = "SELECT * FROM department WHERE department='$name' ";
		$newquery=mysqli_query($conn, $newsql);
		$num_department = mysqli_num_rows($newquery);
		if($num_department > 0){
			$msg = "Duplicate Entry";
			$alert = "danger";
		} else {
			$sql = "UPDATE `department` SET `department`='$name' WHERE sno=$id";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Department Updated Successfully";
				$alert = "success";
			} else {
				$msg = "Department Failed to Update";
				$alert = "danger";
			}
		}
	}
	if($action == "delete"){
		$id = $_POST['id'];
		$sql = "DELETE from `department` WHERE sno=$id";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Department Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "Department Failed to Delete";
			$alert = "danger";
		}
	}
}
?>
<div class="card card-default">
	<div class="card-header card-header-border-bottom">
        <div style="width: 100%; height: 100%;">
          <h2 style="display: inline-block;">Department</h2>
          <button class="btn btn-info" data-toggle="modal" data-target="#addsubject" style="display: inline-block; float: right;">Add Department</button>
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
					<th scope="col">Department</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $newsql = "SELECT * FROM department ORDER BY sno DESC ";
        	$newquery=mysqli_query($conn, $newsql);
            $sno = 1;
        	while( $rows=mysqli_fetch_array($newquery) ) {
				$id = $rows["sno"];
				$name = $rows["department"];
				?>
				<tr>
					<td scope="row"><?php echo $sno; ?></td>
					<td><?php echo $name; ?></td>					
					<td>
						<button class="btn btn-info btn-xs" style="display: inline-block;" onclick="editdept(<?php echo $id; ?>);"><i class="fa fa-pencil"></i></button>
					  <form action="department.php" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
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

<script>
function editdept(id){
  $('.categoryedit').load('modalview.php?id='+id+'&action=editdepartment',function(){
		$('#editdeptmodal').modal('show');	
  });
}
</script>

<div class="modal fade" id="editdeptmodal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Department</h4>
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
        <h4 class="modal-title">Add Department</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="department.php" method="POST">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <input type="hidden" class="form-control" id="action" name="action" value="add">
            <!-- <span class="mt-2 d-block">We'll never share your email with anyone else.</span> -->
          </div>
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
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
</script>
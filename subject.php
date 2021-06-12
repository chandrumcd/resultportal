<?php 
$page = "subject";
include('header.php'); 
$msg = "";
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "add"){
		$name = $_POST['name'];
		$newsql = "SELECT * FROM subject WHERE subject='$name' ";
		$newquery=mysqli_query($conn, $newsql);
		$num_subject = mysqli_num_rows($newquery);
		if($num_subject > 0){
			$msg = "Duplicate Entry";
			$alert = "danger";
		} else {
			$sql = "INSERT INTO `subject`(`subject`, `status`) VALUES ('$name', 1)";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Subject Added Successfully";
				$alert = "success";
			} else {
				$msg = "Subject Failed to Add";
				$alert = "danger";
			}
		}
	}
	if($action == "edit"){
		$name = $_POST['name'];
		$id = $_POST['id'];
		$newsql = "SELECT * FROM subject WHERE subject='$name' ";
		$newquery=mysqli_query($conn, $newsql);
		$num_subject = mysqli_num_rows($newquery);
		if($num_subject > 0){
			$msg = "Duplicate Entry";
			$alert = "danger";
		} else {
			$sql = "UPDATE `subject` SET `subject`='$name' WHERE sno=$id ";
			$query_result=mysqli_query($conn, $sql);
			if($query_result){
				$msg = "Subject Updated Successfully";
				$alert = "success";
			} else {
				$msg = "Subject Failed to Update";
				$alert = "danger";
			}
		}
	}
	if($action == "delete"){
		$id = $_POST['id'];
		$sql = "DELETE from `subject` WHERE sno=$id";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "Subject Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "Subject Failed to Delete";
			$alert = "danger";
		}
	}
}
?>
<div class="card card-default">
	<div class="card-header card-header-border-bottom">
        <div style="width: 100%; height: 100%;">
          <h2 style="display: inline-block;">Subject</h2>
          <button class="btn btn-info" data-toggle="modal" data-target="#addsubject" style="display: inline-block; float: right;">Add Subject</button>
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
					<th scope="col">Subject</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $newsql = "SELECT * FROM subject ORDER BY sno DESC ";
        	$newquery=mysqli_query($conn, $newsql);
            $sno = 1;
        	while( $rows=mysqli_fetch_array($newquery) ) {
				$id = $rows["sno"];
				$name = $rows["subject"];
				?>
				<tr>
					<td scope="row"><?php echo $sno; ?></td>
					<td><?php echo $name; ?></td>					
					<td>
						<button class="btn btn-info btn-xs" style="display: inline-block;" onclick="editsubject(<?php echo $id; ?>);"><i class="fa fa-pencil"></i></button>
					  <form action="subject.php" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
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
function editsubject(id){
  $('.categoryedit').load('modalview.php?id='+id+'&action=editsubject',function(){
		$('#editsubjectmodal').modal('show');
	
  });
}
</script>

<div class="modal fade" id="editsubjectmodal" role="dialog">
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
        <h4 class="modal-title">Add Subject</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="subject.php" method="POST">
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
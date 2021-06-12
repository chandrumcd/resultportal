<?php 
$page = "user";
$msg = "";
include('header.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	
	if($action == "edit"){
		$id = $_POST['id'];
		$name = $_POST['name'];		
		$status = $_POST['status'];
		$sql = "UPDATE user SET name='$name', status=$status WHERE sno=$id";
		$query_result=mysqli_query($conn, $sql);
		
		$password = $_POST['password'];
		if($password !== ""){
			$password = md5($password);
			$sql = "UPDATE user SET password='$password' WHERE sno=$id";
			$query_result=mysqli_query($conn, $sql);
		}
		
		if($query_result){
			$msg = "User Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "User Failed to Delete";
			$alert = "danger";
		}
	}
	if($action == "delete"){
		$id = $_POST['id'];
		$sql = "DELETE from `user` WHERE sno=$id";
		$query_result=mysqli_query($conn, $sql);
		if($query_result){
			$msg = "User Deleted Successfully";
			$alert = "success";
		} else {
			$msg = "User Failed to Delete";
			$alert = "danger";
		}
	}
}
?>
<div class="card card-default">
	<div class="card-header card-header-border-bottom">
        <div style="width: 100%; height: 100%;">
          <h2 style="display: inline-block;">User</h2>
          
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
					<th scope="col">Name</th>
					<th scope="col">Mobile</th>
					<th scope="col">Email</th>
					<th scope="col">Username</th>
					<th scope="col">Usertype</th>
					<th scope="col">Status</th>
					
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $newsql = "SELECT * FROM user ORDER BY name DESC ";
        	$newquery=mysqli_query($conn, $newsql);
            $sno = 1;
        	while( $rows=mysqli_fetch_array($newquery) ) {
				$id = $rows["sno"];
				$name = $rows["name"];
				$mobile = $rows["mobile"];
				$email = $rows["email"];
				$username = $rows["username"];
				$usertype = $rows["usertype"];
				$status = $rows["status"];
				?>
				<tr>
					<td scope="row"><?php echo $sno; ?></td>				
					<td><?php echo $name; ?></td>					
					<td><?php echo $mobile; ?></td>					
					<td><?php echo $email; ?></td>					
					<td><?php echo $username; ?></td>					
					<td><?php echo $usertype; ?></td>										
					<td>
						<?php 
						if($status == 1){ ?>
							<span class="badge bg-success">Enable</span>
						<?php } else { ?>
							<span class="badge bg-danger">Disable</span>
						<?php } ?>
					</td>									
					<td>
						<button class="btn btn-info btn-xs" style="display: inline-block;" onclick="edituser(<?php echo $id; ?>);"><i class="fa fa-pencil"></i></button>
					  <form action="user.php" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
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
function edituser(id){
  $('.categoryedit').load('modalview.php?id='+id+'&action=edituser',function(){
		$('#editsubjectmodal').modal('show');
	
  });
}
</script>

<div class="modal fade" id="editsubjectmodal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
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
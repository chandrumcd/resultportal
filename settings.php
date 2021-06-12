<?php 
$page = "settings";
include('header.php');
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $passmark = $_POST['passmark'];
  $grade50 = $_POST['grade50'];
  $grade60 = $_POST['grade60'];
  $grade70 = $_POST['grade70'];
  $grade80 = $_POST['grade80'];
  $grade90 = $_POST['grade90'];

  $query = "UPDATE settings SET value='$passmark' WHERE options='passmark' ";
  $query_result = mysqli_query($conn,$query);

  $query = "UPDATE settings SET value='$grade50' WHERE options='grade50' ";
  $query_result = mysqli_query($conn,$query);

  $query = "UPDATE settings SET value='$grade60' WHERE options='grade60' ";
  $query_result = mysqli_query($conn,$query);

  $query = "UPDATE settings SET value='$grade70' WHERE options='grade70' ";
  $query_result = mysqli_query($conn,$query);

  $query = "UPDATE settings SET value='$grade80' WHERE options='grade80' ";
  $query_result = mysqli_query($conn,$query);

  $query = "UPDATE settings SET value='$grade90' WHERE options='grade90' ";
  $query_result = mysqli_query($conn,$query);
  
  if($query_result){
    $msg = "Settings Updated Successfully";
    $alert = "success";
  } else {
    $msg = "Settings Failed to Update";
    $alert = "danger";
  }
}
?>

    <!-- Top Statistics -->
    
<?php 
  $newsql = "SELECT * FROM settings";
  $newquery=mysqli_query($conn, $newsql);
  while( $rows=mysqli_fetch_array($newquery) ) {
    $options = $rows["options"];
    $value = $rows["value"];
  
    if($options == "passmark"){
      $passmark = $value;
    }
    if($options == "grade50"){
      $grade50 = $value;
    }
    if($options == "grade60"){
      $grade60 = $value;
    }
    if($options == "grade70"){
      $grade70 = $value;
    }
    if($options == "grade80"){
      $grade80 = $value;
    }
    if($options == "grade90"){
      $grade90 = $value;
    }
  }
  ?>

<div class="card card-default">
	<div class="card-body">
		<?php
		if($msg !== ""){ ?>
			<div class="alert alert-<?php echo $alert; ?>" role="alert">
				<?php echo $msg; ?>
			</div>
		<?php } ?>
  
        <form action="settings.php" method="POST">
          <div class="form-group">
            <label for="address">Passmark</label>
            <input type="text" class="form-control" id="passmark" name="passmark" value="<?php echo $passmark; ?>" required >
          </div>
          <div class="form-group">
            <label for="address2">Grade(50 - 60)</label>
            <input type="text" class="form-control" id="grade50" name="grade50" value="<?php echo $grade50; ?>" required >
          </div>
          <div class="form-group">
            <label for="city">Grade(60 - 70)</label>
            <input type="text" class="form-control" id="grade60" name="grade60" value="<?php echo $grade60; ?>" required >
          </div>
          <div class="form-group">
            <label for="State">Grade(70 - 80)</label>
            <input type="text" class="form-control" id="grade70" name="grade70" value="<?php echo $grade70; ?>" required >
          </div>
          <div class="form-group">
            <label for="email">Grade(80 - 90)</label>
            <input type="text" class="form-control" id="grade80" name="grade80" value="<?php echo $grade80; ?>" required >
          </div>
          <div class="form-group">
            <label for="mobile">Grade(90 - 100)</label>
            <input type="text" class="form-control" id="grade90" name="grade90" value="<?php echo $grade90; ?>" required >
          </div>
		  <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </form>
	</div>
</div>


<?php include('footer.php'); ?>
<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
	$(function() {
		$('#example-table').DataTable({
			pageLength: 10
		});
	})
</script>

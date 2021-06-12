<?php 
session_start();
include("includes/connection.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = $_POST['action'];
	if($action == "verify unique"){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$userstatus = $emailstatus = $mobilestatus = 0;
		$num_email = $num_mobile = $num_username = 0;
		
		if($email !== ""){
			$newsql = "SELECT * FROM user WHERE email='$email' ";
			$newquery=mysqli_query($conn, $newsql);
			$num_email = mysqli_num_rows($newquery);
		}
		
		if($mobile !== ""){
			$newsql = "SELECT * FROM user WHERE mobile='$mobile' ";
			$newquery=mysqli_query($conn, $newsql);
			$num_mobile = mysqli_num_rows($newquery);
		}
		
		if($username !== ""){
			$newsql = "SELECT * FROM user WHERE username='$username' ";
			$newquery=mysqli_query($conn, $newsql);
			$num_username = mysqli_num_rows($newquery);
		}
		
		if($num_email > 0){$emailstatus = 1; }
		if($num_mobile > 0){$mobilestatus = 1; }
		if($num_username > 0){$userstatus = 1; }
		
		$return_arr[] = array("userstatus" => $userstatus,
							  "emailstatus" => $emailstatus,
							  "mobilestatus" => $mobilestatus);
		echo json_encode($return_arr);
	}
	if($action == "login"){
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$pass = md5($pass);
		
		$newsql = "SELECT * FROM user WHERE (email='$username' OR username='$username') AND password='$pass' AND status=1 ";
		$newquery=mysqli_query($conn, $newsql);
		$num = mysqli_num_rows($newquery);
		if($num > 0){
			while( $rows=mysqli_fetch_array($newquery) ) {
				$name = $rows["name"];
				$email = $rows["email"];
				$mobile = $rows["mobile"];
			}
			$_SESSION['user']['name'] = $name;
			$_SESSION['user']['email'] = $email;
			$_SESSION['user']['mobile'] = $mobile;
			$_SESSION['user']['status'] = 'login'; ?>
			<div class="alert alert-success" role="alert">
				Login Successfully.
			</div>
		<?php } else { ?>
			<div class="alert alert-danger" role="alert">
				Username or Password Incorrect.
			</div>
		<?php 
		}
	}
	if($action == "verify rollno unique"){
		$rollno = $_POST['rollno'];
		
		$rollnostatus = 0;
		
		$newsql = "SELECT * FROM student WHERE rollno=$rollno ";
		$newquery=mysqli_query($conn, $newsql);
		$num_rollno = mysqli_num_rows($newquery);
		
		
		
		if($num_rollno > 0){$rollnostatus = 1; }
		
		$return_arr[] = array("rollnostatus" => $rollnostatus);
		echo json_encode($return_arr);
	}
	if($action == "studentdetail"){
		$student = $_POST['student'];
	
		$newsql = "SELECT * FROM student WHERE rollno=$student ";
		$newquery=mysqli_query($conn, $newsql);
		while( $rows=mysqli_fetch_array($newquery) ) {
			$name = $rows["name"];
			$email = $rows["email"];
			$mobile = $rows["mobile"];
			$dept = $rows["dept"];
		}
		$sql = "SELECT * FROM department WHERE sno=$dept";
		$query=mysqli_query($conn, $sql);
		while( $row=mysqli_fetch_array($query) ) {
			$departmentname = $row["department"];
		}
		
		$return_arr[] = array("name" => $name,
							  "email" => $email,
							  "mobile" => $mobile,
							  "departmentname" => $departmentname);
		echo json_encode($return_arr);
	}
	if($action == "findgrade"){
		$marksobtain = $_POST['marksobtain'];
		$result = $grade = "";
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
		
		if($marksobtain >= $passmark){
			$result = "Pass";
		} else {
			$result = "Fail";
		}
		
		if($marksobtain >= 50){
			$grade = $grade50;
		} 
		if($marksobtain >= 60){
			$grade = $grade60;
		} 
		if($marksobtain >= 70){
			$grade = $grade70;
		} 
		if($marksobtain >= 80){
			$grade = $grade80;
		} 
		if($marksobtain >= 90){
			$grade = $grade90;
		}
		
		$return_arr[] = array("result" => $result,
							  "grade" => $grade);
		echo json_encode($return_arr);
	}
}	
?>
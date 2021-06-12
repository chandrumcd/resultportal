$(".num").keypress(function() {
	if ($(this).val().length == $(this).attr("maxlength")) {
		return false;
	}
});

function verifyunique(){
	var username = $('#username').val();
	var email = $('#email').val();
	var mobile = $('#mobile').val();
	var action = "verify unique";
	var status = "ok";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { username: username, email: email, mobile: mobile, action: action },
		dataType: "json",
		success: function(data){
			if(username !== ""){
				if(data[0].userstatus == 1){
					$("#usernameunique").html("<span class='text-danger'>Username Exist!!!</span>");
					status = "notok";
				} else {
					$("#usernameunique").html("<span class='text-success'>Username Available!!!</span>");
					status = "ok";
				}
			} else {
				$("#usernameunique").html("<span class='text-danger'>Username cannot be blank!!!</span>");
				status = "notok";
			}
			if(email !== ""){
				if(data[0].emailstatus == 1){
					$("#emailunique").html("<span class='text-danger'>Email id Exist!!!</span>");
					status = "notok";
				} else {
					$("#emailunique").html("<span class='text-success'>Email id Available!!!</span>");
					status = "ok";
				}
			}
			if(mobile !== ""){
				if(data[0].mobilestatus == 1){
					$("#mobileunique").html("<span class='text-danger'>Mobile no. Exist!!!</span>");
					status = "notok";
				} else {
					$("#mobileunique").html("<span class='text-success'>Mobile no. Available!!!</span>");
					status = "ok";
				}
			} else {
				$("#mobileunique").html("<span class='text-danger'>Mobile no. cannot be blank!!!</span>");
				status = "notok";
			} 
			if(status == "ok"){
				$( "#registerbtn" ).prop( "disabled", false );
			} else {
				$( "#registerbtn" ).prop( "disabled", true );
			}
		}
	});
}

function login(){
	var username = $('#username').val();
	var pass = $('#password').val();
	var action = "login";
	if(username !== "" && pass !== ""){
		$.ajax({
			type: "POST",
			url: "function.php",
			data: { username: username, pass: pass, action: action },
			dataType: "html",
			success: function(datas){
				$("#loginstatus").html(datas);
				window.location = "dashboard.php";
			}
		});
	} else {
		alert("Please enter the required field!!!");
	}
}

function rollnouique(){
	var rollno = $('#rollno').val();	
	var action = "verify rollno unique";
	var status = "ok";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { rollno: rollno, action: action },
		dataType: "json",
		success: function(data){
			if(rollno !== ""){
				if(data[0].userstatus == 1){
					$("#rollnounique").html("<span class='text-danger'>Rollno Exist!!!</span>");
					status = "notok";
				} else {
					$("#rollnounique").html("<span class='text-success'>Rollno Available!!!</span>");
					status = "ok";
				}
			} else {
				$("#rollnounique").html("<span class='text-danger'>Rollno cannot be blank!!!</span>");
				status = "notok";
			}
			if(status == "ok"){
				$( "#submitbtn" ).prop( "disabled", false );
			} else {
				$( "#submitbtn" ).prop( "disabled", true );
			}
		}
	});
}

function studentdetail(){
	var student = $('#student').val();
	var action = "studentdetail";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { student: student, action: action },
		dataType: "json",
		success: function(datas){
			$('#modal_name').val(datas[0].name);
			$('#modal_mobile').val(datas[0].mobile);
			$('#modal_email').val(datas[0].email);
			$('#modal_department').val(datas[0].departmentname);			
		}
	});
}

function editstudentdetail(){
	var student = $('#editstudent').val();
	var action = "studentdetail";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { student: student, action: action },
		dataType: "json",
		success: function(datas){
			$('#editmodal_name').val(datas[0].name);
			$('#editmodal_mobile').val(datas[0].mobile);
			$('#editmodal_email').val(datas[0].email);
			$('#editmodal_department').val(datas[0].departmentname);			
		}
	});
}

function gradescpt(){
	var marksobtain = $('#marksobtain').val();
	var action = "findgrade";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { marksobtain: marksobtain, action: action },
		dataType: "json",
		success: function(datas){
			$('#status').val(datas[0].result);
			$('#grade').val(datas[0].grade);			
		}
	});
}

function editgradescpt(){
	var marksobtain = $('#editmarksobtain').val();
	var action = "findgrade";
	$.ajax({
		type: "POST",
		url: "function.php",
		data: { marksobtain: marksobtain, action: action },
		dataType: "json",
		success: function(datas){
			$('#editstatus').val(datas[0].result);
			$('#editgrade').val(datas[0].grade);			
		}
	});
}
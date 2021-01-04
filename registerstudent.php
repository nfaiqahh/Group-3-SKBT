<?php
	session_start();
	include 'functions.php';
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($_POST['StudGender'] == 'Male') {
			$studGender = "M";
		}
		else {
			$studGender = "F";
		}
		
		$grade = $_POST['StudAge'] - 6;
		$classArr = array("A", "B", "C");
		$classID = $grade.$classArr[rand(0,2)];
		
		$attribute = "StudFName, StudLName, StudGender, StudAge, StudEmail, StudPass, StudMyKid, StudAllergies, GuardID, ClassID";
		$values = "'".$_POST['StudFName']."', '".$_POST['StudLName']."', '".$studGender."', ".$_POST['StudAge'].", '".$_POST['StudEmail']."', '".$_POST['StudPass']."', '".$_POST['StudMyKid']."', '".$_POST['StudAllergies']."', '".$_SESSION['sesh_id']."', '".$classID."'";
		insert("Student", $attribute, $values);
		
		header("Location: GDviewStudent.php"); 
		exit();
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head lang = "en">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Register Account</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  
<script>
	window.onload=function() {
		var mainForm = document.getElementById("mainForm");
		  mainForm.onsubmit=function(e) {	
			var genderstu = document.forms["mainForm"]["StudGender"].value;
			var fnamestu = document.forms["mainForm"]["StudFName"].value;
			var lnamestu = document.forms["mainForm"]["StudLName"].value;
			var emailstu = document.forms["mainForm"]["StudEmail"].value;
			var mykidnum = document.forms["mainForm"]["StudMyKid"].value;
			var agestu = document.forms["mainForm"]["StudAge"].value;
			var allergy = document.forms["mainForm"]["StudAllergies"].value;
			var passwordstu = document.forms["mainForm"]["StudPass"].value;
			var password2stu = document.forms["mainForm"]["StudPass2"].value;
			

			
			if (passwordstu != password2stu){
				alert("Password for Student is not matched");
				e.preventDefault();
				return false
			}
			
			if ( agestu > 12){
				alert("Student age in incorrect");
				e.preventDefault();
				return false
			}
			
			if ( agestu < 7){
				alert("Student age in incorrect");
				e.preventDefault();
				return false
			}
			
			if (gender == "Male"){
				gender = "M";
			}
			else {
				gender = "F"
			}
		  }
		}
		
</script>
</head>
<body data-spy="scroll" data-target="#menu" class="form" >

	<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
	<div class="container-fluid">

		<a class="navbar-brand" href="#"><img src="img/nav_logo.png" alt = " "></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
			<span class ="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="menu">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="MainPageSKBT.php">HOME</a>
				</li>
			
			</ul>
		</div>
	</div>
	</nav>

	<div class="container" id="formspace">
	<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8" id = "formbackground">
			<form role="form" method="post"  id="mainForm">		
				<div class="page-header">
					<h2>Student Information</h2> 
					<hr>
				</div>
					<div class="form-group has-error">
						<label>First Name</label>
						<input type="text" class="form-control" name="StudFName" placeholder="First Name" required>
					</div>
					<div class="form-group has-error">
						<label>Last Name</label>
						<input type="text" class="form-control" name="StudLName" placeholder="Last Name" required>
					</div>
					<div class="form-group has-error">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" name="StudEmail" placeholder="example@gmail.com" required>
					</div>
					
				<div class = "row">
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label for="exampleInputEmail1">MyKid Number</label>
							<input type="text" class="form-control" name="StudMyKid" placeholder="99XXXX00XXXX" required>
						</div>
					</div>
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label> Age</label>
							<input type="text" class = "form-control" name="StudAge" placeholder = "10" required / >
						</div>
					</div>
				</div>
				
				<div class = "row">
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label> Gender</label><br>
							<input type="radio" name="StudGender" value="Male" / required>Male
							<br>
							<input type="radio" name="StudGender" value="Female" />Female
						</div>
					</div>
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label> Allergy (If any)</label>
							<input type="text" class = "form-control" name="StudAllergies" placeholder = " "/>
						</div>
					</div>

				</div>
				<div class = "row">
			
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" name="StudPass" placeholder = "********" required>							
						</div>
					</div>
					<div class = "col-md-6">
						<div class="form-group has-error">
							<label for="exampleInputPassword1">Confirm Password</label>
							<input type="password" class="form-control" name="StudPass2"  placeholder = "********" required>
						</div>
					</div>
				<br>
				</div>
				
				<br>
			<div class = "row">
				<div class="col-md-10"></div>
				<button type="submit" class="btn btn-primary" >Submit</button>
			</div>
		</form>	
	</div>
	<div class="col-md-2"></div>
	</div>
	</div>
	
    <!-- Start of Contact Section -->
    <div id="contacts">
        
    <div class="container-fluid footer">
    <div class="row">
        
        <div class="col-md-3"></div>
        <div class="col-md-6 text text-center">
            <img src="img/Logo_SKBT.png" alt = " ">
            <p>SK Bukit Tinggi, Klang</p>
            <strong>Location</strong>
            <p>H-12-12A<br>Cyberjaya</p>
            <strong>Contact Info</strong>
            <p>16000 622 066</p>
        </div>

    </div> <!-- End of Container Fluid -->
    </div> <!-- End of Contact Section -->
	</div>

	<script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>  

</body>
</html>
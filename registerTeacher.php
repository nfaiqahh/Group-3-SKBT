<?php
	session_start();
	include 'functions.php';
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($_POST['TeachGender'] == 'Male') {
			$teachGender = "M";
		}
		else {
			$teachGender = "F";
		}
		if ($_POST['IsAdmin'] == 'Admin') {
			$isAdmin = "y";
		}
		else {
			$isAdmin = "n";
		}
		
		$attribute = "TeachFName, TeachLname, TeachGender, TeachAge, TeachEmail, TeachPass, TeachIC, IsAdmin";
		$values = "'".$_POST['TeachFName']."', '".$_POST['TeachLname']."', '".$teachGender."', ".$_POST['TeachAge'].", '".$_POST['TeachEmail']."', '".$_POST['TeachPassword']."', '".$_POST['TeachIC']."', '".$isAdmin."'";
		insert("Teacher", $attribute, $values);
		
		header("Location: login.php"); 
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
			
			var fname = document.forms["mainForm"]["TeachFName"].value;
			var lname = document.forms["mainForm"]["TeachLname"].value;
			var email = document.forms["mainForm"]["TeachEmail"].value;
			var icnum = document.forms["mainForm"]["TeachIC"].value;
			var age = document.forms["mainForm"]["TeachAge"].value;
			var password = document.forms["mainForm"]["TeachPassword"].value;
			var password2 = document.forms["mainForm"]["TeachPassword2"].value;
			var gender = document.forms["mainForm"]["TeachGender"].value;
			var role = document.forms["mainForm"]["IsAdmin"].value;

			
			if (password != password2){
				alert("Password is not matched");
				e.preventDefault();
				return false
			}
			
			
			if (icnum.length != 12){
				alert("IC number must be 12 digits  ");
				e.preventDefault();
				return false
			}
			
			if ( age < 21 ){
				alert(" Age in incorrect");
				e.preventDefault();
				return false
			}
			
			if (phone.length != 10){
				alert("phone number must be 10 digits  ");
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
		<div class="collapse navbar-collapse" id="menu">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="formreg.php">Register as Guardian </a>
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
			  <div class="page-header">
					<h2>Register Account</h2> 
			  </div>
			  <hr>
			  <form role="form" method="post"  id="mainForm">		
						<div class="form-group has-error">
							<label>First Name</label>
							<input type="text" class="form-control" name="TeachFName" placeholder="Your First Name" required>
						</div>
						<div class="form-group has-error">
							<label>Last Name</label>
							<input type="text" class="form-control" name="TeachLname" placeholder="Your Last Name" required>
						</div>
						<div class="form-group has-error">
						<label for="inputEmail1">Email address</label>
						<input type="email" class="form-control" name="TeachEmail" placeholder="example@gmail.com" required>
						</div>
						<div class="form-group has-error">
						<label for="exampleInputEmail1">IC Number</label>
						<input type="text" class="form-control" name="TeachIC" placeholder="99XXXX00XXXX" required>
						</div>
						
						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group has-error">
									<label> Gender</label><br>
									<input type="radio" name="TeachGender" value="Male" / required>Male
									<br>
									<input type="radio" name="TeachGender" value="Female" />Female
								</div >
							</div>
							<div class = "col-md-6">
								<div class="form-group has-error">
									<label> Role</label><br>
									<input type="radio" name="IsAdmin" value="Admin" / required>Admin
									<br>
									<input type="radio" name="IsAdmin" value="Regular Teacher" />Regular Teacher
								</div >
							</div>
							<div class = "col-md-6">
								<div class="form-group has-error">
									<label> Age</label>
									<input type="text" class = "form-control" name="TeachAge" placeholder = "20" required>
								</div>
							</div>

						</div>
						<div class = "row">
					
							<div class = "col-md-6">
									<div class="form-group has-error">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" name="TeachPassword" placeholder = "********" required>							
									</div>
							</div>
							<div class = "col-md-6">
									<div class="form-group has-error">
										<label for="exampleInputPassword1">Confirm Password</label>
										<input type="password" class="form-control" name="TeachPassword2"  placeholder = "********" required>
									</div>
							</div>
						<br>

						</div>
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
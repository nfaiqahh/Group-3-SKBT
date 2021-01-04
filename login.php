<?php
if(isset($_POST["submit"])) { 
    $email = $_POST['email'];  
    $pass = $_POST['password'];
    $acctype = $_POST['acctype'];
    
    if ($acctype == "Guardian") {$attriName = "Guard";}
    if ($acctype == "Teacher") {$attriName = "Teach";}
    if ($acctype == "Student") {$attriName = "Stud";}
    
    $link = mysqli_connect("localhost","root","");
    if(!$link) {
        echo("Could not connect to database:".mysqli_connect_error());
    }
    else {
        //echo "Successfully connect to database <br>";
    }
    mysqli_select_db($link, "group11_db");
    
    $query = "SELECT * FROM ".$acctype." WHERE ".$attriName."Email='".$email."' AND ".$attriName."Pass='".$pass."'";
    $sql = mysqli_query($link, $query);
    $numrows = mysqli_num_rows($sql);  
    if (!$sql || $numrows != 0) {  
        while ($row = mysqli_fetch_assoc($sql)) {  
            $dbemail = $row[$attriName.'Email'];  
            $dbpassword = $row[$attriName.'Pass'];
			$dbID = $row[$attriName.'ID']; 
			
			if ($acctype == 'Teacher')
			{ $isAdmin = $row['IsAdmin']; }
        }  
        
        if ($email == $dbemail && $pass == $dbpassword) {  
            session_start();  
            $_SESSION['sesh_user'] = $email;    
            if ($acctype == 'Guardian') {$_SESSION['sesh_type'] = "gd"; $_SESSION['sesh_id'] = $dbID;}
            if ($acctype == 'Teacher') {$_SESSION['sesh_type'] = "tc"; $_SESSION['is_admin'] = $isAdmin; $_SESSION['sesh_id'] = $dbID;}
            if ($acctype == 'Student') {$_SESSION['sesh_type'] = "st"; $_SESSION['sesh_id'] = $dbID; $_SESSION['stud_id'] = $dbID;}
          
            /* Redirect browser */  
            header("Location: MainPageSKBT.php");  
        }  
    } 
    else {  
        echo '<script type="text/javascript">';
        echo ' alert("Wrong username or password")';
        echo '</script>';
    }
}        
?>  

<!DOCTYPE html>
<html lang = "en">
<head lang = "en">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login Account</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script>
  	function validateForm(){
  		var email = document.forms["loginForm"]["email"].value;
  		var pass = document.forms["loginForm"]["password"].value;

  		if (email == "" || pass == ""){
  			alert("Email and password must be filled out");
  			return false;
  		}
  	}
  </script>

</head>

<body data-spy="scroll" data-target="#menu" class="form" >

	<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
	<div class="container-fluid">

		<a class="navbar-brand" href="MainPageSKBT.php"><img src="img/nav_logo.png"></a>
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
	<br>
	<br>
	<br>
	<br>
	
	<!-- Start Landing Page Section -->
	
	<div class="container" id="loginform">
	   <div class="row">
	      <div class="col-md-8" id="whitebackground">
	         <div id="login">
	            <div class="page-header">
	               <h2>Login Account</h2> 
	               <br>
	            </div>
	            <form method="post" name="loginForm" role="form" onsubmit="return validateForm()">
	              <div class="form-group has-error">
	                <label for="inputEmail">Email address</label>
	                <input type="email" class="form-control" name="email">
	              </div>
	              <div class="form-group has-error">
	                <label for="inputPassword">Password</label>
	                <input type="password" class="form-control" name="password" >
	              </div>
	              <div class="form-group">
	                <label for="inputMode">Login As</label>
	                <select name="acctype" class="form-control">
	                  <option>Guardian</option>
	                  <option>Teacher</option>
	                  <option>Student</option>
	                </select>             
	              </div>
	              <button type="submit" class="btn btn-primary" name="submit">LOGIN</button>
	            </form>  
	         </div>
	      </div>
	      <div class="col-md-1"><br/></div>
	      <div class="col-md-3" id="register">
	      	<div class="page-header">
	               <h2>Register Account</h2> 
	               <br>
	        </div>
	        <p>Interested to register your kids to our school?</p>
	        <a href="formreg.php"><button type="submit" class="btn btn-primary">Register</button></a>
	      </div>
	   </div>  
	</div>  <!-- end container -->

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
</body>


</html>
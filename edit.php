<?php  
	session_start();
	$connect = mysqli_connect("localhost", "root", "", "group11_db");  
	$query = "SELECT * FROM student WHERE StudID  = '".$_SESSION['stud_id']."'" ; 
	$result = mysqli_query($connect, $query);  
	$row = mysqli_fetch_array($result);
	$StudID = $row[0];
	$StudFName = $row[1];
	$StudLName = $row[2];
	$StudGender = $row[3];
	$StudAge = $row[4];
	$StudEmail = $row[5];
	$StudPass = $row[6];
	$StudMyKid = $row[7];
	$StudAllergies = $row[8];
	$ClassID = $row[10];
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$StudFName = $_POST['StudFName'];
		$StudLName = $_POST['StudLName'];
		if ($_POST['StudGender'] == "Male")
		{$StudGender = 'M';}
		else {$StudGender = 'F';}
		$StudAge = $_POST['StudAge'];
		$StudEmail = $_POST['StudEmail'];
		$StudPass = $_POST['StudPass'];
		$StudMyKid = $_POST['StudMyKid'];
		$StudAllergies = $_POST['StudAllergies'];
		
		$query = "UPDATE `student` SET `StudFName`= '".$StudFName."', `StudLName`= '".$StudLName."', `StudGender`= '".$StudGender."',`StudAge`= ".$StudAge.",`StudEmail`= '".$StudEmail."',`StudPass`= '".$StudPass."',`StudMyKid`= '".$StudMyKid."',`StudAllergies`= '".$StudAllergies."' WHERE `StudID` = ".$StudID;
		$update = mysqli_query($connect, $query);
		
		header("Location: GDviewStudent.php"); 
		exit();
	}
 ?>

<html>  
<head>  
	<title>Webslesson Tutorial | Bootstrap Modal with Dynamic MySQL Data using Ajax & PHP</title>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script>
 window.onload=function() {
		var mainForm = document.getElementById("mainForm");
		  mainForm.onsubmit=function(e) {

			var mykidnum = document.forms["mainForm"]["StudMyKid"].value;
			var agestu = document.forms["mainForm"]["StudAge"].value;
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
<body>  
	<br /><br />  
	<div class="container" style="width:700px;">  
		<h3 align="center"> Edit Student </h3>  
		<br />  
		<div class="table-responsive">  
			<form role="form" method="post" id = "mainForm" action="">
				<table class="table table-bordered">  
					<tr>  
						 <td width="30%"><label>Student ID</label></td>  
						 <td width="70%"><input type="text" name="StudID" class="studreg" value=<?php echo $StudID;?> readonly></td>  
					</tr>  
					<tr>  
						 <td width="30%"><label>First Name</label></td>  
						 <td width="70%"><input type="text" name="StudFName" class="studreg" value="<?php echo $StudFName;?>"></td>  
					</tr>
					<tr>  
						 <td width="30%"><label>Last Name</label></td>  
						 <td width="70%"><input type="text" name="StudLName" class="studreg" value="<?php echo $StudLName;?>"></td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>Gender</label></td>  
						 <td width="70%"><input type="radio" name="StudGender" value="Male" <?php if($StudGender == 'M') { echo "checked"; } ?>>Male
										 <input type="radio" name="StudGender" value="Female" <?php if($StudGender == 'F') { echo "checked"; } ?>/>Female</td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>Age</label></td>  
						 <td width="70%"><input type="text" name="StudAge" class="studreg" value=<?php echo $StudAge;?>></td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>Email</label></td>  
						 <td width="70%"><input type="text" name="StudEmail" class="studreg" value="<?php echo $StudEmail;?>"></td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>Password</label></td>  
						 <td width="70%"><input type="text" name="StudPass" class="studreg" value="<?php echo $StudPass;?>"></td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>MyKid Number</label></td>  
						 <td width="70%"><input type="text" name="StudMyKid" class="studreg" value="<?php echo $StudMyKid;?>"></td>  
					</tr> 
					<tr>  
						 <td width="30%"><label>Allergies</label></td>  
						 <td width="70%"><input type="text" name="StudAllergies" class="studreg" value="<?php echo $StudAllergies;?>"></td>  
					</tr>
					<tr>  
						 <td width="30%"><label>Class</label></td>  
						 <td width="70%"><input type="text" name="ClassID" class="studreg" value="<?php echo $ClassID;?>" readonly></td>  
					</tr>
				</table>  
				<input type="submit" class="btn btn-default" value="Save"/> 
				<button type="button" class="btn btn-default" onclick="window.location='GDviewStudent.php';" >Back</button>
			</form>
		</div>  
	</div>  
</body> 
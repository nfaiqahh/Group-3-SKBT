<?php
	session_start();

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$databaseName = "group11_db";
	
	$connect  = mysqli_connect($hostname, $username, $password, $databaseName);
	$squery = "SELECT * FROM `student`";
	$cquery = "SELECT class.ClassID FROM class,assignment,teacher WHERE class.ClassID = assignment.ClassID AND assignment.TeachID = teacher.TeachID AND teacher.TeachID = ".$_SESSION['sesh_id'];  
	
	$classopt = mysqli_query($connect, $cquery);
	$stuopt = mysqli_query($connect, $squery);
	
	$classID = "";
	$fName = "";
	$lName = "";
	$studID = "";
	
	
	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if (isset($_GET["class"])) {
			$classID = $_GET['class'];
		}
		if (isset($_GET["stuid"])) {
			$studID = $_GET['stuid'];
			$_SESSION["studID"] = $_GET['stuid'];
		}
	}
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$query = "INSERT INTO `result` (`StudID`, `SubjID`, `SubjMarks`, `ExamDate`) VALUES ('".$_SESSION["studID"]."', 'BM016', '".$_POST['marks1']."', '".$_POST['date']."')";
			$insert = mysqli_query($connect, $query);
			$query = "INSERT INTO `result` (`StudID`, `SubjID`, `SubjMarks`, `ExamDate`) VALUES ('".$_SESSION["studID"]."', 'BI016', '".$_POST['marks2']."', '".$_POST['date']."')";
			$insert = mysqli_query($connect, $query);
			$query = "INSERT INTO `result` (`StudID`, `SubjID`, `SubjMarks`, `ExamDate`) VALUES ('".$_SESSION["studID"]."', 'SC016', '".$_POST['marks3']."', '".$_POST['date']."')";
			$insert = mysqli_query($connect, $query);
			$query = "INSERT INTO `result` (`StudID`, `SubjID`, `SubjMarks`, `ExamDate`) VALUES ('".$_SESSION["studID"]."', 'MT016', '".$_POST['marks4']."', '".$_POST['date']."')";
			$insert = mysqli_query($connect, $query);
			$query = "INSERT INTO `result` (`StudID`, `SubjID`, `SubjMarks`, `ExamDate`) VALUES ('".$_SESSION["studID"]."', 'IT016', '".$_POST['marks5']."', '".$_POST['date']."')";
			$insert = mysqli_query($connect, $query);
		
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head lang = "en">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Fill Marks</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
 
</head>
<body data-spy="scroll" data-target="#menu" class="form">

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
			  <div class="page-header">
					<h2>Marks Form</h2> 
			  </div>
			  <hr>
			  <form role="form" method="get"  id="marksForm" action="">		
						<div>
							<label>Class  </label>
							
								<select name="class" class="mbox">
									<?php while($row = mysqli_fetch_array($classopt)):;?>
									<option value="<?php echo $row[0];?>" <?php if ($row[0] == $classID) { echo "selected"; } ?>><?php echo $row[0];?>	</option>
									<?php endwhile;?> 
								</select>
							<br>
							<button type="submit" class="sb">Select</button>
						</div>
						<div>
							<label>Student ID</label>
								<select name="stuid" class="mbox">
								<?php while($row = mysqli_fetch_array($stuopt)):;?>
								<?php if($row[10]==$classID) {?>
								<option value="<?php echo $row[0];?>" <?php if ($row[0] == $studID) { echo "selected"; $fName = $row[1]; $lName = $row[2];} ?>><?php echo $row[0]; }?>	</option>
								<?php endwhile;?> 
							</select>
							<br>
							<button type="submit" class="sb">Select</button>
						</div>
				</form>
				<form role="form" method="post"  id="marksForm" action="" onsubmit="return validateForm()">		
						<div>
							<label>First name  </label>
							<input class="mbox" type="text" name="firstname" size = "30" class = "tb1" placeholder = "" value = "<?php echo $fName; ?>" readonly>	
						</div>
						<div>
							<label>Last name  </label>
							<input class="mbox" type="text" name="lastname" size = "30" placeholder = "" value = "<?php echo $lName; ?>" readonly>
						</div>
						<div>
							<label>Exam Date  </label>
							<input class="mbox" type="date" name="date">
						</div>
						<div>
							<br>
							<label>Bahasa Malaysia  </label>
							<input id="sbox" class="mbox" type="number" min=0 max=100 name="marks1"/ required>
						</div>
						<div>
							<label>English  </label>
							<input id="sbox" class="mbox" type="number" min=0 max=100 name="marks2"/ required>
						</div>
						<div>
							<label>Science  </label>
							<input id="sbox" class="mbox" type="number" min=0 max=100 name="marks3"/ required>
						</div>
						<div>
							<label>Mathematics  </label>
							<input id="sbox" class="mbox" type="number" min=0 max=100 name="marks4"/ required>
						</div>
						<div>
							<label>Basic IT  </label>
							<input id="sbox" class="mbox" type="number" min=0 max=100 name="marks5"/ required>
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
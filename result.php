<?php
	session_start();

	$_SESSION["examDate"] = "";

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$databaseName = "group11_db";
	
	$connect  = mysqli_connect($hostname, $username, $password, $databaseName);
	$dquery = "SELECT DISTINCT `ExamDate` FROM `result` WHERE `StudID` = ".$_SESSION['stud_id'];
	$dateopt = mysqli_query($connect, $dquery);
	
	$fName = "";
	$lName = "";
	$classID = "";
	
	$marks = ["","","","",""];
	$gpa = 0;
	$grade = ["","","","",""];
	
	$setquery = "SELECT * FROM `student` WHERE `StudID` = ".$_SESSION['stud_id'];
	$setopt = mysqli_query($connect, $setquery);
	$setrow = mysqli_fetch_array($setopt);

	$fName = $setrow[1];
	$lName = $setrow[2];
	$classID = $setrow[10];
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$_SESSION["examDate"] = $_POST['examDate'];
		
		$subjectID = ["BM016", "BI016", "SC016", "MT016", "IT016"];
		
		for($i=0;$i<count($subjectID);$i++) {
			$mquery = "SELECT * FROM `result` WHERE `ExamDate` = '".$_SESSION["examDate"]."' AND `StudID` = ".$_SESSION['stud_id']." AND `SubjID` = '".$subjectID[$i]."'";
			$mopt = mysqli_query($connect, $mquery);
			$mrow = mysqli_fetch_array($mopt);
			$marks[$i] = $mrow[3];
		}

		$y = 0;
		$g = 0;
		$total = 0;
		
		for ($i = 0; $i < count($marks); $i++){			
			if($marks[$i] >= 90 && $marks[$i] <100){
				$grade[$i] ="A+";
				$y = 4;
			}
			if($marks[$i] >= 80 && $marks[$i] < 90){
				$grade[$i] ="A";
				$y = 4;
			}
			if($marks[$i] >= 75 && $marks[$i] < 80){
				$grade[$i] ="A-";
				$y = 3.67;
			}
			if($marks[$i] >= 70 && $marks[$i] < 75){
				$grade[$i] ="B+";
				$y = 3.33;
			}
			if($marks[$i] >= 65 && $marks[$i] < 70){
				$grade[$i] ="B";
				$y = 3;
			}
			if($marks[$i] >= 60 && $marks[$i] < 65){
				$grade[$i] ="B-";
				$y = 2.67;
			}
			if($marks[$i] >= 55 && $marks[$i] < 60){
				$grade[$i] ="C+";
				$y = 2.33;
			}
			if($marks[$i] >= 50 && $marks[$i] < 55){
				$grade[$i] ="C";
				$y = 2;
			}
			if($marks[$i] >= 40 && $marks[$i] <50){
				$grade[$i] ="D";
				$y = 1;
			}
			if($marks[$i] < 40 && $marks[$i] > 0){
				$grade[$i] ="FAIL";
				$y = 0;
			}
			$total = $total + $y;
		}
			$gpa = $total/5;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">
	
	<style>
		#exdate{
			margin-left: 45.0%;
		}
		#edselect{
			margin-left: 48.5%;
		}	
		#desc{
			margin-left: 35.0%;
		}
	</style>
</head>

<body data-spy="scroll" data-target="#menu" class="land">

<!-- Start Navigation Bar -->
<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
<div class="container-fluid">
	<a class="navbar-brand" href="#"><img src="img/nav_logo.png" alt="school logo"></a>
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

<!-- Start of Result Section -->
<div id="result">
	<div class="result-head">
		<div class="col-md-3"></div>
		<div class="col-md-6 text text-center">
			<br><br><br>
			<img src="img/Logo_SKBT.png" alt="school logo">
			<strong>SK Bukit Tinggi, Klang</strong>
			<strong>Examination Result</strong>
			<p>Online Edition</p>
		</div>
	</div>

	<div>
		<form role="form" method="post" action="">
		<label id="exdate">Exam Date  </label>	
			<select name="examDate" class="mbox">
				<?php while($row = mysqli_fetch_array($dateopt)):;?>
					<option value="<?php echo $row[0];?>" <?php if($row[0]==$_SESSION["examDate"]) { echo "selected"; } ?>><?php echo $row[0];?>	</option>
				<?php endwhile;?>
			</select>
		<br>
		<button type="submit" class="sb" id="edselect" onclick="calculate()">Select</button>
	</div>
		 
	<table>
		<tr>
			<th>Student ID</th>
			<td colspan=4>
				<?php echo $_SESSION['stud_id']; ?>
				
			</td>
		</tr>
		</form>
		<tr>
			<th>First Name</th>
			<td colspan=4>
				<?php echo $fName; ?> 
			</td>
		</tr>
		<tr>
			<th>Last Name</th>
			<td colspan=4>
				<?php echo $lName; ?>
			</td>
		</tr>
		<tr>
			<th>Class</th>
			<td colspan=4>
				<?php echo $classID; ?>
			</td>
		</tr>
		<tr>
			<td colspan=5></td>
		</tr>
		<tr>
			<th>No.</th>
			<th>Subject Code</th>
			<th>Subject Name</th>
			<th>Marks</th>
			<th>Grade</th>
		</tr>
		<tr>
			<td>1</td>
			<td>BM016</td>
			<td>Bahasa Malaysia</td>
			<td id="marks1">
				<?php echo $marks[0]; ?>
			</td>
			<td><?php echo $grade[0]; ?></td>
		</tr>
		<tr>
			<td>2</td>
			<td>BI016</td>
			<td>English</td>
			<td id="marks2">
				<?php echo $marks[1]; ?>
			</td>
			<td><?php echo $grade[1]; ?></td>
		</tr>
		<tr>
			<td>3</td>
			<td>MT016</td>
			<td>Mathematics</td>
			<td id="marks3">
				<?php echo $marks[2]; ?>
			</td>
			<td><?php echo $grade[2]; ?></td>
		</tr>
		<tr>
			<td>4</td>
			<td>SC016</td>
			<td>Science</td>
			<td id="marks4">
				<?php echo $marks[3]; ?>
			</td>
			<td><?php echo $grade[3]; ?></td>
		</tr>
		<tr>
			<td>5</td>
			<td>IT016</td>
			<td>Basic IT</td>
			<td id="marks5">
				<?php echo $marks[4]; ?>
			</td>
			<td><?php echo $grade[4]; ?></td>
		</tr>
		<tr>
			<td id="tspace" colspan=5></td>
		</tr>
		<tr>
			<td colspan=3> </td>
			<th>GPA</th>
			<td><?php echo number_format($gpa, 2, '.', ''); ?></td>
		</tr>
		</table>		
		
		<strong id="desc">Pass Grade: A+ to D.</strong>
		<br><br><br>
		<strong id="desc">This is a computer generated slip. No signature is required. </strong>
		<br>
		<strong id="desc">Verification from Examination and Records Unit is required for official use.</strong>
		<br><br><br>
		
		
		<form id="bpb">
			<button type="submit" formaction="MainPageSKBT.php">Back</button>
		</form>
		
</div><!-- End of Result Section -->


<!-- Start of Contact Section -->
<div id="contacts">
	
<div class="container-fluid footer">
<div class="row">
	
	<div class="col-md-3"></div>
	<div class="col-md-6 text text-center">
		<img src="img/Logo_SKBT.png" alt="school logo">
		<p><strong>SK Bukit Tinggi, Klang</strong></p>
		<strong>Location</strong>
		<p>H-12-12A<br>Cyberjaya</p>
		<strong>Contact Info</strong>
		<p>16000 622 066</p>
	</div>
</div>
</div> <!-- End of Container Fluid -->
</div> <!-- End of Contact Section -->

<!--- Script Source Files -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>
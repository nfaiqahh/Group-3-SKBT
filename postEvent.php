<?php
	session_start();
	include 'functions.php';
	date_default_timezone_set("Asia/Kuala_Lumpur");
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		$attribute = "EventTitle, EventSummary, EventContent, EventDate, EventMedia";
		$values = "'".$_POST['EventTitle']."', '".$_POST['EventSummary']."', '".$_POST['EventContent']."', '".$_POST['EventDate']."'";
		$picObj = new Pic();
		$picObj->insertPic("Event", $attribute, $_FILES['EventMedia']['tmp_name'], $values);
		
		header("Location: MainPageSKBT.php"); 
		exit();
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Post Events </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">

<script>
		
		window.onload=function() {
		var eventForm = document.getElementById("eventForm");
		eventForm.onsubmit=function(e) {
			
			var wordsummary = document.forms["eventForm"]["EventSummary"].value;
			var wordcontent = document.forms["eventForm"]["EventContent"].value;
	
			
			if (wordsummary.length > 200){
				alert("Summary is too long");
				e.preventDefault();
				return false
			}
			if (wordcontent.length > 400){
				alert("Content is too long");
				e.preventDefault();
				return false
			}

		  }
		}
</script>
</head>


<body class="form">
	<!--Start Home Section -->
	<div id="home">
		<!-- Start Navigation Bar -->
		<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"><img src="img/nav_logo.png" alt = ""> </a>
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

	</div>
	
	<div class="container" id="formspace">
	<div class="row">
	<div class="col-md-3"></div>
	 <div class="col-md-6" id = "formbackground">
	  <div class="page-header">
		<h2>Add Event</h2> 
       </div>
	   <hr>
		<form method="post"  id="eventForm" action="" onsubmit="return validateForm()" enctype="multipart/form-data">		
				<div class="form-group has-error">
					<label>Title</label>
					<input type="text" class="form-control" name="EventTitle" placeholder="Enter Title" required>
				</div>
				<div class="form-group has-error">
					<label>Summary</label>
					 <textarea name="EventSummary" rows="3" cols="61" class="form-control" placeholder = "Enter summary of event." required></textarea> 
				</div>
				<div class="form-group has-error">
					<label>Content</label>
					 <textarea name="EventContent" rows="5" cols="61" class="form-control" placeholder = "Enter content of event." required></textarea> 
				</div>
				<div class="form-group has-error">
					<label>Start date of event</label>
					 <input type="date" name= "EventDate" id="myDate" value="<?php echo date("Y-m-d"); ?>" >
				</div>
				<div class="form-group has-error">
					  <label>Add Picture</label> <br>
					  <input type="file" id="img" name="EventMedia" accept="image/*">
				</div>
			<br>
			<div class = "row">
				<div class="col-md-10"></div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>	
	</div>
	<div class="col-md-3"></div>
	</div>
	</div>
	
	<!-- Start of Contact Section -->
	<div id="contacts">
		<div class="container-fluid footer">
			<div class="row">
				<div class="col-md-3"></div>
					<div class="col-md-6 text text-center">
						<img src="img/Logo_SKBT.png" alt = " ">
						<p><strong>SK Bukit Tinggi, Klang</strong></p>
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
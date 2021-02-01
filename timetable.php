<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Timetable</title>
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

<!-- Start of Timetable Section -->
<div id="timetable">
	<div class="result-head">
		<div class="col-md-3"></div>
		<div class="col-md-6 text text-center">
			<br><br><br>
            <img src="img/Logo_SKBT.png" alt="school logo">
            <p></p>
			<strong>SK Bukit Tinggi, Klang</strong>
			<strong>Online Edition</strong>
		</div>
    </div>
    <h3 class="heading">Timetable</h3>
        <p style="text-align:center;">
            <img src="img/class_schedule.png" width="50%">
        </p>
        <div class="text-center">
            <button type="submit">Print</button>
            <br><br>
        </div>
</div><!-- End of Timetable Section -->

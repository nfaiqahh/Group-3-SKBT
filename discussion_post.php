<?php
	session_start();
	include 'functions.php';
	
	$connect  = mysqli_connect("localhost", "root", "", "group11_db");
	$query = "SELECT * FROM discussion_topic,teacher WHERE teacher.TeachID = discussion_topic.TeachID AND Topic_id = ".$_SESSION['topic_id'];
	$query2 = "SELECT * FROM discussion_post,teacher WHERE teacher.TeachID = discussion_post.TeachID AND Topic_id = ".$_SESSION['topic_id'];
	$result = mysqli_query($connect, $query);
	$result2 = mysqli_query($connect, $query2);
	$row = mysqli_fetch_array($result);	
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		$attribute = "Topic_id,DPost_text,TeachID";
		$values = "'".$_SESSION['topic_id']."','".$_POST['DPost_text']."',".$_SESSION['sesh_id'];	
		insert("discussion_post", $attribute, $values);
		header("Location: discussion_post.php"); 
		exit();
	}
	
	
	
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Topics Discussion </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">
	<style>
		h2 {text-align: center;}
		th {text-align: center;}
		::placeholder {
			font-style: italic;
		}
		
	</style>
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
	<div class="col-md-1"></div>
	 <div class="col-md-10" id = "formbackground" >
	  <div class="page-header">
		<h2>Discussion Board</h2> 
       </div>
	   <hr>

		<table width=100% cellpadding=3 cellspacing=3 border=2>
				<tr>
					<th>AUTHOR</th>
					<th>POST</th>
				</tr>				
				
				<tr>  
					<td width=35% valign=top><?php echo $row["TeachEmail"]; ?> <br>[<i><?php echo $row["Topic_time"]; ?></i>]</td>
					<td width=65% valign=top><b><i><?php echo $row["Topic_title"]; ?></b></i><br><br><?php echo $row["Topic_text"]; ?><br><br></td>
				</tr>
			<?php  
			while($row3 = mysqli_fetch_array($result2))  
			{  
			?>  
				<tr>  
					<td width=35% valign=top><?php echo $row3["TeachEmail"]; ?> <br>[<i><?php echo $row["Topic_time"]; ?></i>]</td>
					<td width=65% valign=top><?php echo $row3["DPost_text"]; ?><br><br></td>
				</tr>
			<?php  
			}  
			?>
			 
		</table>
		<br>
		<hr>
	
	  <div style = "background:white; 	padding:2em; 	border-radius:15px;  height: 300px;"> 
		<form method="post"  id="discussionForm" action="" enctype="multipart/form-data">						
			<div class="form-group has-error">
				<textarea name="DPost_text" class = "form-control" rows="6" placeholder="Write your reply here.." required></textarea>
			</div>
			<div class = "row">  
				<div class="col-md-10"></div>
				<button type="submit" class="btn btn-primary">Post</button>
			</div>
		</form>
		<br>
	
			<button type="submit" class="menu" name="view_topic" onclick="window.location='discussion.php';" class="btn btn-info btn-xs" >BACK</button></td>
	</div>	
	</div>
	<div class="col-md-1"></div>
	</div>
	</div>
	

<div class="container-fluid footer" id = "contacts">
<div class="row">

	<div class="col-md-3"></div>
	<div class="col-md-6 text text-center">
		<img alt="SKBT Logo" src="img/Logo_SKBT.png">
		<p>SK Bukit Tinggi, Klang</p>
		<strong>Location</strong>
		<p>H-12-12A<br>Cyberjaya</p>
		<strong>Contact Info</strong>
		<p>16000 622 066</p>
	</div>

</div> <!-- End of Container Fluid -->
</div> <!-- End of Contact Section -->

<!--- Script Source Files -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>
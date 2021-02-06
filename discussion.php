<?php
	session_start();
	include 'functions.php';
	
	if(isset($_GET['view_topic']) && $_SERVER['REQUEST_METHOD'] == "GET") {
	$_SESSION['topic_id'] = $_GET['view_topic'];
	
	header("Location: discussion_post.php");
	exit();
	}
	
	$connect  = mysqli_connect("localhost", "root", "", "group11_db");
	$query = "SELECT Topic_id,Topic_title,TeachEmail,Topic_time, Topic_text FROM discussion_topic,teacher WHERE teacher.TeachID = discussion_topic.TeachID";
	$result = mysqli_query($connect, $query);
	$result2 = mysqli_query($connect, $query);
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		
		$attribute = "Topic_title,Topic_text ,TeachID";
		$values = "'".$_POST['Topic_title']."','".$_POST['Topic_text']."' ,".$_SESSION['sesh_id'];			
		insert("discussion_topic", $attribute, $values);
		header("Location: discussion.php"); 
		exit();
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Discussion Board </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">
	
<script>
		
		window.onload=function() { 
		var discussionForm = document.getElementById("discussionForm");
		discussionForm.onsubmit=function(e) {
			
			var word = document.forms["discussionForm"]["Topic_text"].value;
			document.forms["discussionForm"]["Topic_title"].value = displayTime;
			
			if (word.length > 500){
				alert("Content is too long");
				e.preventDefault();
				return false
			}
						
		  }
		}
</script>

<style>
	
	td{
	  text-align: left;
	  padding: 8px;
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
	 <div class="col-md-4" style = "background:white; 	padding:2em; 	border-radius:15px;  height: 550px;">
	  <div class="page-header">
		<h2>Add a topic</h2> 
       </div>
	   <hr>
		<form method="post"  id="discussionForm" action="" enctype="multipart/form-data">						
				<div class="form-group has-error">
					<label>Topic Title</label><br/>
					<textarea name="Topic_title" class = "form-control" rows="1" placeholder="Enter your announcement" required></textarea>
				</div>
				
				<div class="form-group has-error">
					<label>Post Text</label><br>	
					<textarea name="Topic_text" class = "form-control" rows="8" placeholder="Enter your Content" required></textarea>	
				</div>
				<br>
			<br>
			<div class = "row">  
				<div class="col-md-10"></div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>	
	</div>	
	
	<?php
		$row = mysqli_fetch_array($result);
		if(empty($row)) {
	?>
			<div class="col-md-8">
			<div class="card text-center">
			<div class = "container">
			<br>
			<div class="page-header">
				<h2>No Topics Available</h2> 
			</div>
			</div>
			</div>
			</div>
			<hr>
		<?php
		}
		else{
		?>
				<div class="col-md-8">
				<div class="card text-center">
				<div class = "container">
				<br>
				<div class="page-header">
					<h2>Topics Available</h2> 
				</div>
				<hr>
				
				<table width=100% cellpadding=5 cellspacing=5 border=3>
				<tr>
					<th>AUTHOR</th>
					<th>POST</th>
				</tr>				
				<?php  
				while($row = mysqli_fetch_array($result2))  
				{  
				?>  
					<tr>  
						<td width=35% valign=top><?php echo $row["TeachEmail"]; ?>[<i><?php echo $row["Topic_time"]; ?></i>]</td>
						<td width=65% valign=top><b><i><?php echo $row["Topic_title"]; ?></b></i><br><br><?php echo $row["Topic_text"]; ?><br><br>
						<form role="form" method="get" action="">
							<button type="submit" name="view_topic" value="<?php echo $row["Topic_id"]; ?>" id="<?php echo $row["Topic_id"]; ?>" class="btn btn-info btn-xs" ><strong>VIEW TOPIC</strong></button></td>  
						</form>
					</tr>
				<?php  
				}  
				?>
				</table>
				<br>
				<br>		
				</div>
				</div>
				</div>			
		<?php  
		}
		?>

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
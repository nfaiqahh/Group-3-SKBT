<?php
	session_start();
	include 'functions.php';
	
	$connect  = mysqli_connect("localhost", "root", "", "group11_db");
	$cquery = "SELECT * FROM `class`";
	$classopt = mysqli_query($connect, $cquery);
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		if (isset($_POST['isClass'])) {
			$attribute = "AnnounceTitle, AnnounceContent, IsClass, TeachID, AnnounceMedia";
			$values = "'".$_POST['AnnouncementTitle']."', '".$_POST['AnnouncementContent']."', '".$_POST['isClass']."', ".$_SESSION['sesh_id'];
			$picObj = new Pic();
			$picObj->insertPic("Announcement", $attribute, $_FILES['AnnouncementMedia']['tmp_name'], $values);
			
			$announceID = select("Announcement", "AnnounceTitle", "'".$_POST['AnnouncementTitle']."'", "AnnounceID");
			$attribute = "AnnounceID, ClassID";
			$values = $announceID.", '".$_POST['ClassID']."'";
			insert("ClassAnnouncement", $attribute, $values);
		}
		else {
			$attribute = "AnnounceTitle, AnnounceContent, TeachID, AnnounceMedia";
			$values = "'".$_POST['AnnouncementTitle']."', '".$_POST['AnnouncementContent']."', ".$_SESSION['sesh_id'];
			$picObj = new Pic();
			$picObj->insertPic("Announcement", $attribute, $_FILES['AnnouncementMedia']['tmp_name'], $values);
			
			$announceID = select("Announcement", "AnnounceTitle", "'".$_POST['AnnouncementTitle']."'", "AnnounceID");
			$attribute = "AnnounceID";
			$values = $announceID;
			insert("PublicAnnouncement", $attribute, $values);
		}
		
		header("Location: MainPageSKBT.php"); 
		exit();
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Subject Announcement </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">
	
<script>
function showClass()
{
	if (document.getElementById("isClass").checked){
		 document.getElementById("allClassdiv").style.display='block';
	} else{
		  document.getElementById("allClassdiv").style.display='none';
		}
	
}
		
		window.onload=function() { 
		var announcementForm = document.getElementById("announcementForm");
		announcementForm.onsubmit=function(e) {
			
			var word = document.forms["announcementForm"]["AnnouncementContent"].value;
			document.forms["announcementForm"]["AnnouncementTitle"].value = displayTime;
			
			if (word.length > 500){
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
		<h2>Announcement</h2> 
       </div>
	   <hr>
		<form method="post"  id="announcementForm" action="" enctype="multipart/form-data">		
				<div class="form-group has-error">
					<label>Title</label>
					<input type="text" name="AnnouncementTitle" class = "form-control" placeholder="Enter your subject" />   
				</div>
				
				<div class="form-group has-error">
					<label>Content</label><br/>
					<textarea name="AnnouncementContent" class = "form-control" rows="5" placeholder="Enter your announcement" required></textarea>
				</div>
				
				<div class="box">
						<label>Add Picture</label><br>	
						<input type="file" id="img" name="AnnouncementMedia" accept="image/*">	
				</div>
				<br>
				<div class="form-group has-error">
					<label>Post Time</label>
					 <input type="date" name= "AnnouncementDate" id="myDate" value="<?php echo date("Y-m-d"); ?>" >
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
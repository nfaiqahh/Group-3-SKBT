<?php
session_start();
$sql1 = "SELECT * FROM `announcement` order by AnnounceID desc limit 4";
$conn1 = mysqli_connect("localhost","root","","group11_db") or die("Connection failed: " . mysqli_connect_error());
$resultset1 = mysqli_query($conn1, $sql1) or die("database error:". mysqli_error($conn1));
$j = 0;
$announcement = [];
while( $record1 = mysqli_fetch_assoc($resultset1)) {
	$announcement[$j] = array($record1['AnnounceID'],$record1['AnnounceTitle'],$record1['AnnounceContent'], $record1['AnnounceMedia'], $record1['AnnouncePostTime']);
	$j++;
}

$sql = "SELECT * FROM `event` where EventDate > date_add(curdate(), interval 1 day) order by EventDate";
$conn = mysqli_connect("localhost","root","","group11_db") or die("Connection failed: " . mysqli_connect_error());
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$i = 0;
$event = [];
while( $record = mysqli_fetch_assoc($resultset)  ) {
	$event[$i] = array($record['EventID'],$record['EventTitle'],$record['EventDate'], $record['EventSummary'], $record['EventMedia'], $record['EventContent']);
	$i++;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SK Bukit Tinggi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheet.css">
</head>

<body data-spy="scroll" data-target="#menu" class="land">

<!-- Start Navigation Bar -->
<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
<div class="container-fluid">
	<a class="navbar-brand" href="#top"><img alt="SK Bukit Tinggi Logo" src="img/nav_logo.png"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
		<span class ="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="menu">
		<ul class="navbar-nav ml-auto">
			<?php if (isset($_SESSION['sesh_user']) && $_SESSION['sesh_type'] == "tc")
				{
					echo '<li class="nav-item">
						<a class="nav-link" href="#home">HOME</a>
					</li>';
					echo '<li class="nav-item"><a class="nav-link" href="TCviewStudent.php">STUDENT</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="announcement.php">POST AN ANNOUNCEMENT</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="discussion.php">DISCUSSION BOARD</a></li>';
				}
			?>
			<?php if (isset($_SESSION['sesh_user']) && $_SESSION['sesh_type'] == "tc" && $_SESSION['is_admin'] == 'y')
				{ echo '<li class="nav-item"><a class="nav-link" href="postEvent.php">POST AN EVENT</a></li>'; }
			?>
			<?php if (isset($_SESSION['sesh_user']) && $_SESSION['sesh_type'] == "gd")
				{
					echo '<li class="nav-item"><a class="nav-link" href="GDviewStudent.php">STUDENT</a></li>';
					echo '<li class="nav-item">
						<a class="nav-link" href="#home">HOME</a>
					</li>';
					echo '
					<li class="nav-item">
						<a class="nav-link" href="#about">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#announcement">Announcement</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#events">EVENTS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#management">MANAGEMENT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contacts">CONTACT</a>
					</li>';
				}
			?>
			<?php if (isset($_SESSION['sesh_user']) && $_SESSION['sesh_type'] == "st")

				{
					echo '<li class="nav-item"><a class="nav-link" href="timetable.php">TIMETABLE</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="result.php">RESULT</a></li>';
					echo '<li class="nav-item">
						<a class="nav-link" href="#home">HOME</a>
					</li>';
					echo '<li class="nav-item">
						<a class="nav-link" href="#about">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#announcement">Announcement</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#events">EVENTS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#management">MANAGEMENT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contacts">CONTACT</a>
					</li>';
				}
			?>
			<?php if (empty($_SESSION['sesh_user']))
				{
					echo '<li class="nav-item">
						<a class="nav-link" href="#home">HOME</a>
					</li>';
					echo '<li class="nav-item">
						<a class="nav-link" href="#about">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#announcement">Announcement</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#events">EVENTS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#management">MANAGEMENT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contacts">CONTACT</a>
					</li>';
				}
			?>
			<li class="nav-item">
                <?php $param = isset($_SESSION['sesh_user']) ? "logout.php" : "login.php";?>
				<a class="nav-link" href="<?=$param; ?>">
                <?php $param = isset($_SESSION['sesh_user']) ? "LOGOUT" : "LOGIN";?>
                <?=$param; ?>
                </a>
			</li>
			<li class="nav-item">
				<?php
                if (isset($_SESSION['sesh_user']))
                    $param = '<img id="useric" alt="User Icon" src="img/user.png" style="height:15px;width:15px;margin-top:10px;">'.$_SESSION['sesh_type'].'</a>';
                else
                    $param = '<a class="nav-link" href="formreg.php">REGISTER</a>';
                ?>
                <?= $param; ?>
			</li>
		</ul>
	</div>
</div>
</nav>

<!-- Start Landing Page Section -->
<div class="landing">
	<div class="home-wrap">
		<div class="home-inner">
	</div>
</div>
<!-- Start Landing Page Caption -->
<div class="caption center-block text-center" id = "home">
	<h3><b>Welcome to<br>
	Sekolah Kebangsaan Bukit Tinggi</b></h3>
</div>
<!-- End Landing Page Section -->

</div><!-- End Home Section -->

<!-- Start About Section -->
<div id="about">
<div class="jumbotron">
	<h3 class="heading">About</h3>
<div class="row">
	<div class="col-md-4 text-center">
		<h4><b>Vision</b></h4>
		<p > <i>Our vision is to develop well rounded, confident and responsible individuals who aspire to achieve
		their full potential. We will do this by providing a welcoming, happy, safe, and supportive learning
		environment in which everyone is equal and all achievements are celebrated.</i></p>
	</div>
	<div class="col-md-4 text-center">
		<h4><b>Mission</b></h4>
		<p><i>Our school empowers all students to embrace learning, achieve their personal best and build their emotional, social and physical well-being.</i></p>
	</div>
	<div class="col-md-4 text-center">
		<h4><b>Slogan</b></h4>
		<p><i>DREAM, BELIEVE, ACHIEVE</i></p>
	</div>

</div><!-- End Row-->
</div><!-- End Jumbotron -->
</div><!-- End About Section -->

<!-- Start of Announcement -->
<div id="announcement">
<div class="container-fluid padding">
	<h3 class ="heading">Announcement</h3>

<div class="row padding">
	<div class="col-md-3">
		<div class="card text-center">

			<div class="card-body">
				<h4><?php echo $announcement[0][1]; ?></h4>
				<p><?php echo $announcement[0][4]; ?></p>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#aModal1">See more..</button>


			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card text-center">

			<div class="card-body">
				<h4><?php echo $announcement[1][1]; ?></h4>
				<p><?php echo $announcement[1][4]; ?></p>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#aModal2">See more..</button>


			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card text-center">

			<div class="card-body">
				<h4><?php echo $announcement[2][1]; ?></h4>
				<p><?php echo $announcement[2][4]; ?></p>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#aModal3">See more..</button>


			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card text-center">

			<div class="card-body">
				<h4><?php echo $announcement[3][1]; ?></h4>
				<p><?php echo $announcement[3][4]; ?></p>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#aModal4">See more..</button>


			</div>
		</div>
	</div>

</div><!--End of Row -->
</div><!--End of Container Fluid -->
</div><!--End of Announcement -->

	<div class="container">
	  <!-- Modal -->
	  <div class="modal fade" id="aModal1" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	        	<h4 class="modal-title">Announcement Details</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <img alt=<?php echo $announcement[0][0]; ?>" class="card-img-top" src="source2.php?id=<?php echo $announcement[0][0]; ?>">
	          <p></p>
	          <h4><?php echo $announcement[0][1]; ?></h4>
	          <em>Announcement Date: <?php echo $announcement[0][4]; ?></em>
	          <p></p>
	          <p><?php echo $announcement[0][2]; ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>

	    </div>
	  </div>

	</div>

	<div class="container">
	  <!-- Modal -->
	  <div class="modal fade" id="aModal2" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	        	<h4 class="modal-title">Announcement Details</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <img alt=<?php echo $announcement[1][0]; ?>" class="card-img-top" src="source2.php?id=<?php echo $announcement[1][0]; ?>">
	          <p></p>
	          <h4><?php echo $announcement[1][1]; ?></h4>
	          <em>Announcement Date: <?php echo $announcement[1][4]; ?></em>
	          <p></p>
	          <p><?php echo $announcement[1][2]; ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>

	    </div>
	  </div>

	</div>

	<div class="container">
	  <!-- Modal -->
	  <div class="modal fade" id="aModal3" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	        	<h4 class="modal-title">Announcement Details</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <img alt=<?php echo $announcement[2][0]; ?>" class="card-img-top" src="source2.php?id=<?php echo $announcement[2][0]; ?>">
	          <p></p>
	          <h4><?php echo $announcement[2][1]; ?></h4>
	          <em>Announcement Date: <?php echo $announcement[2][4]; ?></em>
	          <p></p>
	          <p><?php echo $announcement[2][2]; ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>

	    </div>
	  </div>

	</div>

	<div class="container">
	  <!-- Modal -->
	  <div class="modal fade" id="aModal4" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	        	<h4 class="modal-title">Announcement Details</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <img alt=<?php echo $announcement[3][0]; ?>" class="card-img-top" src="source2.php?id=<?php echo $announcement[3][0]; ?>">
	          <p></p>
	          <h4><?php echo $announcement[3][1]; ?></h4>
	          <em>Announcement Date: <?php echo $announcement[3][4]; ?></em>
	          <p></p>
	          <p><?php echo $announcement[3][2]; ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>

	    </div>
	  </div>

	</div>


<!-- Start of Events -->
<div id="events">
<div class="container-fluid padding">
	<h3 class ="heading">Events</h3>
<?php
$i = 0;
	foreach($event as $e){
		if($i%3==0){
			echo '<div class="row padding">';
		}
		?>
		<div class="col-md-4">
			<div class="card text-center">
				<img alt=<?php echo $event[$i][0]; ?>" class="card-img-top" src="source.php?id=<?php echo $event[$i][0]; ?>">
				<div class="card-body">
					<h4><?php echo $event[$i][1]; ?></h4>
					<p><?php echo $event[$i][2]; ?></p>
					<p><?php echo $event[$i][3]; ?></p>
					<?php $c = $i+1 ?>
					<?php $c = (string)$c ?>
					<?php $m= "#myModal".$c ?>
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="<?php echo $m ?>">See more..</button>
				</div>
			</div>
		</div>
		<?php
		if($i%3==2){
			echo '</div><!--End of Row -->';
		}
		$i++;
	}
	?>


</div><!--End of Container Fluid -->
</div><!--End of Events -->

	<?php
		$i= 0;
		foreach ($event as $e) {
			$c = $i+1;
			$c = (string)$c;
		$m = "myModal".$c;
	?>
	<div class="container">
		<!-- Modal -->
		<div class="modal fade" id="<?php echo $m ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Event Details</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<img alt=<?php echo $event[$i][0]; ?>" class="card-img-top" src="source.php?id=<?php echo $event[$i][0]; ?>">
						<p></p>
						<h4><?php echo $event[$i][1]; ?></h4>
						<em>Event Date: <?php echo $event[$i][2]; ?></em>
						<p></p>
						<p><?php echo $event[$i][5]; ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

	</div>
	<?php
		$i++;
		}
	?>

<!-- Start of Management Section -->
<div id="management">
	<h3 class="heading">Management</h3>

<div class="row padding">

	<div class="col-md-3">
		<div class="card text-center">
				<div class = "containerH"><img class="card-img-top imageH" alt="Mr. Ikhmal Hisham Bin Md Ismail Portrait" src="img/headmaster.jpg">
					<div class="middleH">
						<div class="textH"> BR001 <br> icam@gmail.com <br> 013-0010101 </div>
					</div>
				</div>
			<div class="card-body">
				<h4>Mr. Ikhmal Hisham Bin Md Ismail</h4>
				<p>Headmaster of SK Bukit Tinggi</p>
				<p>" I have 10 years experience in managing this school "</p>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card text-center">
			<div class = "containerH"><img class="card-img-top imageH" alt="Mr. Wan Izz Naeem Portrait" src="img/hek.jpg">
				<div class="middleH">
						<div class="textH"> BR002 <br> naeem@gmail.com <br> 013-0380101 </div>
				</div>
			</div>
			<div class="card-body">
				<h4>Mr. Wan Izz Naeem </h4>
				<p>Deputy Director of Academic Affairs</p>
				<p>" Go to your class "</p>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card text-center">
			<div class = "containerH"><img class="card-img-top imageH" alt="Mr. Syamil Anuar Portrait" src="img/tphep.jpg">
				<div class="middleH">
					<div class="textH"> BR003 <br> syamil@gmail.com <br> 013-0380999 </div>
				</div>
			</div>
			<div class="card-body">
				<h4>Mr. Syamil Anuar </h4>
				<p>Deputy Director of Student Affairs</p>
				<p>" Dicipline is key "</p>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card text-center">
			<div class = "containerH">
				<img class="card-img-top imageH" alt="Mr. Faris Portrait" src="img/tpcocu.jpeg">
				<div class="middleH">
							<div class="textH"> BR004 <br> fabash@gmail.com <br> 013-0384547 </div>
				</div>
			</div>
			<div class="card-body">
				<h4>Mr. Faris Bashir </h4>
				<p>Deputy Director of Cocurricular Activies</p>
				<p>" Patience is always the key "</p>
			</div>
		</div>
	</div>

</div><!--End of Row -->
</div><!-- End of Management Section -->

<!-- Start of Contact Section -->
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

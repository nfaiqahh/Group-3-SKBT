<?php
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "group11_db");  
 $query = "SELECT * FROM student WHERE GuardID = '".$_SESSION['sesh_id']."'";  
 $result = mysqli_query($connect, $query);  
 
 if(isset($_GET['edit']) && $_SERVER['REQUEST_METHOD'] == "GET") {
	$_SESSION['stud_id'] = $_GET['edit'];
	
	header("Location: edit.php");
	exit();
 }
  if(isset($_GET['view']) && $_SERVER['REQUEST_METHOD'] == "GET") {
	$_SESSION['stud_id'] = $_GET['view'];
	
	header("Location: result.php");
	exit();
 }
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Bootstrap Modal with Dynamic MySQL Data using Ajax & PHP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center"> View Student </h3>  
                <br />  
                <div class="table-responsive">  
				
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="60%">Student Name</th>  
                               <th width="20%" colspan=2>Details</th> 
							   <th width="20%">Results</th>
                          </tr>  
                          <?php  
							  while($row = mysqli_fetch_array($result))  
							  {  
								  ?>  
								  <tr>  
									   <td><?php echo $row["StudFName"]; ?></td>  
									   <td><input type="button" name="view" value="view" id="<?php echo $row["StudID"]; ?>" class="btn btn-info btn-xs view_data" /></td>
											<form role="form" method="get" action="">
												<td><button type="submit" name="edit" value="<?php echo $row["StudID"]; ?>" id="<?php echo $row["StudID"]; ?>" class="btn btn-info btn-xs" >edit</button></td>  
											
									   <td><input type="submit" name="view" value="<?php echo $row["StudID"]; ?>" id="<?php echo $row["StudID"]; ?>" class="btn btn-info btn-xs"/></td>  
											</form>
								  </tr>  
								  <?php  
							  }  
							  ?>  
                     </table>  
					 <button type="button" class="btn btn-default" onclick="window.location='registerstudent.php';" >Register New Student</button>
					 <button type="button" class="btn btn-default" onclick="window.location='MainPageSKBT.php';" >Back</button>
                </div>  
           </div>
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Student Details</h4>  
                </div>  
                <div class="modal-body" id="student_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var StudID = $(this).attr("id");  
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{StudID:StudID},  
                success:function(data){  
                     $('#student_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
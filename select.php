<?php  
 if(isset($_POST["StudID"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "group11_db");  
      $query = "SELECT StudID,StudFName,StudLName,StudGender,StudAge,StudEmail,StudPass,StudMyKid,StudAllergies,ClassGrade,ClassName FROM student, class WHERE student.ClassID = class.ClassID AND StudID  = '".$_POST["StudID"]."'" ; 
      $result = mysqli_query($connect, $query);  
	  $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  	
			if ($row["StudGender"] == 'M'){
				$gender = "Male";
			}
			else {
				$gender = "Female";
			}
           $output .= '  
                <tr>  
                     <td width="30%"><label>Student ID</label></td>  
                     <td width="70%">'.$row["StudID"].'</td>  
                </tr>  
				<tr>  
                     <td width="30%"><label>First Name</label></td>  
                     <td width="70%">'.$row["StudFName"].'</td>  
                </tr>
				<tr>  
                     <td width="30%"><label>Last Name</label></td>  
                     <td width="70%">'.$row["StudLName"].'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">'.$gender.'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%">'.$row["StudAge"].'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">'.$row["StudEmail"].'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>Password</label></td>  
                     <td width="70%">'.$row["StudPass"].'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>MyKid Number</label></td>  
                     <td width="70%">'.$row["StudMyKid"].'</td>  
                </tr> 
				<tr>  
                     <td width="30%"><label>Allergies</label></td>  
                     <td width="70%">'.$row["StudAllergies"].'</td>  
                </tr>
				<tr>  
                     <td width="30%"><label>Class</label></td>  
                     <td width="70%">'.$row["ClassGrade"]." ".$row["ClassName"].'</td>  
                </tr> 	 				
                
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
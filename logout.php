<?php   
session_start();  
unset($_SESSION['sesh_user']);  
unset($_SESSION['sesh_type']);  
session_destroy();  
header("location:MainPageSKBT.php");
?> 

<?php
echo '<script type="text/javascript">';
echo ' 	alert("You have successfully logged out.")';
echo '</script>';
?>
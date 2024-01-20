<?php
include'db.php';
if(!session_id()){
  session_start();
  

}
$allowedAdmins = ['Ahwan', 'Nabina']; 

if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], $allowedAdmins)) {
    header('Location: /moviehunt-test/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'header.php'?>
	<title>Admin</title>
	
	
	<style>
		 .row{
  margin-top: 50px;
  margin-bottom: 300px;

 }
  
  .myButton {
    display:flex;
    margin-left: 30%;
   width: 50%;
    text-align: center;
    margin-top: 1vw;
    text-decoration: none;
    padding: 10px;
    background-color: #bf34db;
    color: #fff;
    border-radius: 5px;
  
  }
  
  .myButton:hover {
    background-color: #299ab9; 
  }
	</style>

</head>
<body >
	
		
	
			<div class="row">
			
					<a  href="addmovie.php" class="myButton">Add Movie</a>
				
				
					<a  href="addthreater.php" class="myButton">Add Theater </a>
			
				
					<a  href="addtimeslot.php" class="myButton"> Add Time Slot </a>
				
					<a  href="delete.php" class="myButton"> Delete Movie</a>
				
			 
		</div>
		
	
	</body>
	<?php include 'footer.php';  ?>
	</html>

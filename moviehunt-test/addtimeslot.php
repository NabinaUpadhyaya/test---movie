<!DOCTYPE html>
<html>
<?php include 'header.php' ?>
<head>

	<link rel="stylesheet" type="text/css" href="registration.css">
	<link rel="icon" href="glassicon.png" type="glassicon">

	
	<title>Admin\addtimeslot</title>
	<style type="text/css">
		.boxStyle{
			width: 100%;
			border: 1px solid #ccc;
			margin: 0 0 5px;
			padding: 10px;
            line-height: 16px;
			}
		.wrapper{
			text-align: center;
			
			

		}
		.bg{

			height: 100%; 
		

background-position: center;
background-repeat: no-repeat;
background-size: cover;
		}
		body, html {
			height: 100%;
			margin: 0;
		}

		
		body{ 
			/* The image used */
			background-image: url("ad.jpg");

			
		
		}
		.btn{
 background-color: rgb(170, 238, 216);
 padding: 10px;
 
 font-family: cursive;
 font-weight: bold;


 border-radius: 4px;
 cursor: pointer;
 
}
.btn:hover{
  color: rgb(9, 142, 47);
  
}
	</style>
</head>
<body >
	
	<div class="bg" >
		
		<div class="container">  
			<form id="contact" action="addTimeSlot.php" method="post" enctype="multipart/form-data">

				<input  name="timeSlot" placeholder="Time Slot" type="text" tabindex="1" required autofocus>
				<input style="font-size: larger;background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
				class="boxStyle" type="submit" name="submit" value="Add Time Slot"> 
				<p class="copyright"></p>

			</form>
			<div class="wrapper">
				<button style="text-align: center;" class="btn " onclick="document.location.href='adminpage.php'" ><span class='back'> </span>BACK TO THE ADMIN PAGE</button>
			</div>
		</div>
	</div>

</body>
<?php include 'footer.php' ?>
</html>

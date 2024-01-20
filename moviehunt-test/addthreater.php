
<!DOCTYPE html>
<html>
<head>
<?php include 'header.php' ?>
	<link rel="stylesheet" type="text/css" href="registration.css">
	<link rel="icon" href="glassicon.png" type="glassicon">
	<title>Admin\addtheater</title>
	<style type="text/css">
		.boxStyle
		{
			width: 100%;
			border: 1px solid #ccc;
			background: #FFF;
			margin: 0 0 5px;
			padding: 10px;
			font-weight: 400;
			font-size: 12px;
			line-height: 16px;
			font-family: Roboto, Helvetica, Arial, sans-serif;
			
		}
		
		.wrapper{
			text-align: center;
		}
		body, html {
			height: 100%;
			margin: 0;
		}

		body{
			
			background-image: url("ad.jpg");

			
		}
		*{
			margin: 0px;
		}
		.bg { 
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
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
			<form id="contact" action="addtheater.php" method="post" enctype="multipart/form-data">

				<input  name="TheaterName" placeholder="Theater Name" type="text" tabindex="1" required autofocus>
				<input style="font-size: larger;background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
				class="boxStyle" type="submit" name="submit" value="Add Theater"> 
				<p class="copyright"></p>

			</form>
			<div class="wrapper">
				<button class="btn" onclick="document.location.href='adminpage.php'" ><span class='back'> </span>BACK TO THE ADMIN PAGE</button>
			</div>
		</div>
	</div>
</body>
<?php include 'footer.php' ?>
</html>
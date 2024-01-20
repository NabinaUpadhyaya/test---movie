<?php
  include'connect.php';
  session_start();
  if(!isset($_SESSION['signUp'])|| $_SESSION['signUp']!= true){
    header('location:/moviehunt-test/signup.php');
    exit;
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>moviehunt\about</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="about.css">
    <link rel="icon" href="glassicon.png" type="glassicon">
</head>

<body>
    <div class="about-section">
        <h1>About Us</h1>
        <p id="subab">Nepal College of Information Technology</p>
      
  
    </div>

    <h1 style="text-align:center">Our team</h1>
    <div class="row">
        <div class="column">
            <div class="card">
                <img class="photo" src="nabs.jpg" id="nabimg" alt="" style="width:100%">

                <div class="container">
                    <h3>Nabina Upadhyaya</h3>
                    <p class="rollno">211420</p>
                    <p>nabinasilwal13@gmail.com</p>
                    <p>9749496529</p>
                    <div class="icons">
                        <a href="https://www.instagram.com/inabs___/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/nabina.silwal.94"> <i class="fab fa-facebook"></i></a>
                        <a href="https://youtu.be/G3e-cpL7ofc"><i class="fab fa-youtube"></i></a>

                    </div>

                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <img class="photo" src="ahwan.jpg" id="ahimg" alt="" style="width:100%">
                <div class="container">
                    <h3>Ahwan Poudyal</h3>
                    <p class="rolno">211402</p>
                    <p>ahpoudyal07@gmail.com</p>
                    <p>9865705276</p>
                    <div class="icons">
                        <a href="https://www.instagram.com/ahwanpoudyal/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/ahwan.poudyal.1234"> <i class="fab fa-facebook"></i></a>
                        <a href="https://youtu.be/G3e-cpL7ofc"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
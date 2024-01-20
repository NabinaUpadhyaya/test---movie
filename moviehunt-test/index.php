<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
  
  header('Location: signup.php');
  exit;
}



 ?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
        <link rel="icon" href="img/glassicon.png" type="glassicon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    
    <title>MovieHunt</title>
    
</head>

<body>
<?php 
  if (!empty($_SESSION['msg'])) {
    echo "
    <p style='font-family: cursive; text-align: center; color: #5c865c; font-size: 2vw;'>".$_SESSION['msg']."</p>
    ";
    $_SESSION['msg']="";
    $_SESSION['movieId']="";
  }

  ?>
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <h1 class="logo">MovieHunt</h1>
            </div>
            
          
               
                <div class="header-top-left">
                <ul>
                    <?php 
                    $userId = $_SESSION['user'];
                    $query = "SELECT * FROM user WHERE userId='$userId';";
                    $res = $conn->query($query);

                    // Check if the query was successful
                    if (!$res) {
                        echo "Error executing query: " . $conn->error;
                        exit();
                    }

                    // Check if the query returned any results
                    if ($res->num_rows > 0) {
                        $row = $res->fetch_object();
                        echo "<li><span class='glyphicon-user'></span>" . strtoupper($row->userName) . "</li>";
                    } else {
                      echo "<div class='user'><i class='fas fa-user-alt'></i> <a class='userid'>$userId<a></div>";
                    }
                    ?>
                </ul>
            </div>
            <div class="profile-container">
                <div class="profile-text-container">
                <a href="signup.php"><button><span class="profile-text">Login as admin</span></button></a> 
                <a href="logout.php"><button><span class="profile-text">Logout</span></button></a>
                   </button> 
                </div>
                <div class="toggle">
                    <i class="fas fa-moon toggle-icon"></i>
                    <i class="fas fa-sun toggle-icon"></i>
                    <div class="toggle-ball"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
  
       <a href="index.php"> <button> <i class="left-menu-icon fas fa-home"></i></button></a>
      <a href="about\about.php"> <button> <i class="left-menu-icon fas fa-address-card"></i></button></a>
 
      
    </div>
    <div class="featured-content"
      style="background: linear-gradient(to bottom, rgba(249, 253, 250, 0), #151515), url('cinemaa.jpg'); background-size:cover">
      <!-- <img class="featured-title" src="cinema2.jpg" > -->
     
  </div>
  <div class="panel-heading">
              <ul class='nav-tabs' >
                <a>Showing Now</a>
              </ul>
</div>
<div class='all'>
<div  class="container">
      
  
        <div  class=" panel-success">
               
        <div class="tab-content">
             
      
                <?php 
          $count=0;
          $res=$conn->query("select * from movielist;");
          while ($row=$res->fetch_object()) {
            

            if ($count==4) {
              echo "<div class='row'>";
              $count=0;
            }

            echo " 
         
              <div class='card-container'>
                <div class='card'>

                  <div class='front'>
                
                    <img class='photo' src='uploadimages/".$row->image."'/>
                  
              
                    <div class='content'>
                      <div class='main'>
                        <h3 class='name'>".$row->Name ."</h3>

                        <p><b>IMDB: </b>".$row->imdb."</p>

                        <p ><b>Genre: </b>".$row->Genre ."</p>

                        <p ><b>Director: </b> " .$row->Director ."</p>
                        <div style='margin-top: 5vw;' class='buy_ticket'>

                          <form action='ticketProcessing.php' method='post' >
                         <input type='hidden' name='movieId' value='".$row->movieId."' >
                         <input type='submit'  class=' btn-primary' type='submit' value='Click to book ticket' name='submit'>
                          </form>
 
                        </div>
                      </div>
                   </div>
                 </div> 
              
</div>
                  
                  </div>
                 
          ";

          $count++;
        } ?>
        </div>
    </div>
  </div>
      </div>
      </div>
        

      
   
<script src="index.js"></script>

</body>

</html>
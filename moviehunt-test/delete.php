<?php
include 'db.php';

if(isset($_GET['movieId'])){
  // Validate and sanitize the input
  $movieId = intval($_GET['movieId']);

  // Prepare and execute the DELETE query
  $query = "DELETE FROM movielist WHERE movieId = ?";
  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $movieId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($ok) {
      echo "<font color='blue' class='pop'>Movie Deleted</font>";
    } else {
      echo "<font color='red' class='pop'>Failed to Delete movie</font>";
    }
  } else {
    echo "<span style='color: rgb(247, 2, 2);' class='pop'>Failed to prepare statement: " . mysqli_error($conn) . "</span>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Movie</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #9e9898;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-image: url("ad.jpg");
    }

    .container {
      background: #b4c7d1;
      padding: 20px;
      border-radius: 8px;

      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
 

    table {
      width: 100%;
  
      margin-top: 20px;
      
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #120808;
      background: #FFF;
    }
    h2{
      text-align: center;
      color: #1a1a1a;
      font-family: cursive;
      font-weight: bold;
      font-size: larger;
      
    }

    th {
      background-color: #f2f4f2;
    }

    .delete-btn {
     background-color: #c2fbb8;
      color: #000;
    
      font-weight: bold;
      font-size: larger;
   
      padding: 10px 30px;
      border-radius: 4px;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: #375dbcb7;
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
.wrapper{
			text-align: center;
		}
  
  </style>
</head>
<body>
<div class="container">
  <h2>Delete Movie</h2>
  
  <table>
    <thead>
      <tr>
        <th>S.N</th>
        <th>Movie Name</th>
        <th>Genre</th>
        <th>Operation</th>
       
      
       
      </tr>
    </thead>
    <tbody>
      <?php 
      $count=0;
      $res=$conn->query("select * from movielist;");
      while ($row=$res->fetch_object()) {
        

        if ($count==4) {
          echo "<div class='row'>";
          $count=0;
        }

        echo " <tr>
          <td>".$row->movieId."</td>
                <td>".$row->Name ."</td>
                <td>".$row->Genre ."</td>deletemovie
                <td class='delete-btn'><a href='delete.php?movieId={$row->movieId}'>Delete</a></td>
               



         
               
              </tr>"
              ;

              $count++;
            } ?>
    </tbody>
  </table>
  <div class="wrapper">
				<button class="btn" onclick="document.location.href='adminpage.php'" ><span class='back'> </span>BACK TO THE ADMIN PAGE</button>
			</div>

</div>

<script>
  function deletemovie(movieId) {
    
    if (confirm("Are you sure you want to delete this movie?"):1) {
      window.location.href='delete.php?movieId='+movieId;
    }
  }
      
     
</script>



</body>
</html>
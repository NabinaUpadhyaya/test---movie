<?php 
if (!session_id()) {
    session_start();
} 
include 'db.php';
if (empty($_SESSION['user'])) {
    header('Location: signup.php');
    exit(); }

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
    <title>Moviehunt</title>
</head>

<body>
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
                    <a href="logout.php"><button><span class="profile-text">Logout</span></button></a>
                </div>
                <div class="toggle">
                    <i class="fas fa-moon toggle-icon"></i>
                    <i class="fas fa-sun toggle-icon"></i>
                    <div class="toggle-ball"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="index.js"></script>
</body>

</html>

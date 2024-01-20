<?php
session_start();
include 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $MovieName = $_POST['MovieName'];
    $Genre = $_POST['Genre'];
    $imdb = $_POST['imdb'];
    $Director = $_POST['directorName'];

    if (!empty($MovieName) && !empty($Genre) && !empty($Director) && !empty($imdb)) {
        $addMovie = new AddProduct();
        $addMovie->productAdd($conn);
    } else {
        echo "<script>alert('Please fill in all the fields.');</script>";
    }
}

class AddProduct {
    public function productAdd($conn) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $sql = "INSERT INTO movielist(Name, Genre, Director, image, imdb) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $Name = $_POST['MovieName'];
            $Genre = $_POST['Genre'];
            $Director = $_POST['directorName'];
            $imdb = $_POST['imdb'];

            $target = "uploadimages/" . basename($_FILES['image']['name']);
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            $stmt->bind_param("sssss", $Name, $Genre, $Director, $image, $imdb);

            if (move_uploaded_file($image_tmp, $target)) {
                if ($stmt->execute()) {
                    $_SESSION['msg'] = "Movie Successfully Added";
                } else {
                    echo "Error adding movie: " . $stmt->error;
                    $_SESSION['msg'] = "Error adding movie: " . $stmt->error;
                }
            } else {
                echo "Failed to move uploaded file.";
                $_SESSION['msg'] = "Failed to move uploaded file.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
            $_SESSION['msg'] = "Error preparing statement: " . $conn->error;
        }

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>    
    <?php include 'header.php' ?>

    <link rel="stylesheet" type="text/css" href="registration.css">
    <link rel="icon" href="glassicon.png" type="glassicon">
    <title>Admin\addmovie</title>
    <style type="text/css">
       *{
            margin: 0px;
        }
        
        .MovieGenre{
            width: 100%;
            border: 1px solid #ccc;
            margin: 0 0 5px;
            padding: 10px;
            line-height: 16px;
            
        }
        body, html {
            height: 100%;
            
            /* The image used */
            background-image: url("ad.jpg");
        
        }
        .wrapper{
            text-align: center;
        }
        .bg { 
            
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
    </style>
    
</head>
<body>
    <div class="bg">
        <div class="container">  
            <form id="contact" method="POST" enctype="multipart/form-data">
                <h2 style="text-align: center; font-family: cursive"><b>Add Movie</b></h2>

                <input name="MovieName" placeholder="Movie Name" type="text" required autofocus>

                <select class="MovieGenre" name="Genre">
                    <option value="Action">Action</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Crime">Crime</option>
                    <option value="Drama">Drama</option>
                    <option value="Romantic">Romantic</option>
                </select>

                <input name="imdb" placeholder="imdb rating" type="text" required autofocus>

                <input name="directorName" placeholder="Director" type="text" required autofocus>
                            
                <input style="padding: 10px;" type="file" name="image" required autofocus>

                <input style="font-size: larger;background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
                    class="MovieGenre" type="submit" name="submit"> 
            </form>
            <div class="wrapper">
                <button class="btn btn-default" onclick="document.location.href='adminpage.php'"> <span class='back'> </span>BACK TO THE ADMIN PAGE</button>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php' ?>
</html>


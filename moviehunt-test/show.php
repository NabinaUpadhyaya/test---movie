<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header('Location: signup.php');
    exit;
}

// Handle movie addition form submission
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $MovieName = $_POST['MovieName'];
    $Genre = $_POST['Genre'];
    $imdb = $_POST['imdb'];
    $Director = $_POST['directorName'];

    if (!(empty($MovieName) || empty($Genre) || empty($Director) || empty($imdb))) {
        echo "<script>alert('Movie Added');</script>";
        $var = new AddProduct();
        $var->productAdd($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <link rel="icon" href="glassicon.png" type="glassicon">
    <title>Admin\addmovie</title>
    <style type="text/css">
        * {
            margin: 0px;
        }
        
        .MovieGenre {
            width: 100%;
            border: 1px solid #ccc;
            margin: 0 0 5px;
            padding: 10px;
            line-height: 16px;
        }

        body, html {
            height: 100%;
            background-image: url("ad.jpg");
        }

        .wrapper {
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
            <form id="contact" method="post" enctype="multipart/form-data">
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
                <input style="font-size: larger; background-color: #c2fbb8; font-family: cursive; font-weight: bold;" 
                       class="MovieGenre" type="submit" name="submit">
            </form>
            <div class="wrapper">
                <button class="btn btn-default" onclick="document.location.href='adminpage.php'">
                    <span class='back'> </span>BACK TO THE ADMIN PAGE
                </button>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php' ?>
</html>

<?php 
class AddProduct {
    public function productAdd($conn) {
        $sql = "INSERT INTO movielist (movieId, Name, Genre, Director, image, imdb) VALUES ('', ?, ?, ?, ?, ?);";

        if (($stmt = $conn->prepare($sql))) {
            $stmt->bind_param("sssssi", $Name, $Genre, $Director, $image, $imdb);
        } else {
            var_dump($conn->error);
        }

        $Name = $_POST['MovieName'];
        $Genre = $_POST['Genre'];
        $Director = $_POST['directorName'];
        $imdb = $_POST['imdb'];

        $target = "uploadimages/" . basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if ($stmt->execute()) {
            if (move_uploaded_file($image_tmp, $target)) {
                // echo "<script>alert('Movie Successfully Added');</script>";
            } else {
                echo "<script>alert('Movie failed to add');</script>";
            }
        }

        $stmt->close();
        $_SESSION['msg'] = "Movie Successfully Added";
        header("Location: adminpage.php");
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" href="images/glassicon.png" type="glassicon">


    <title>moviehunt/Signup</title>
</head>

<body>
    <?php
        if(isset($_POST["Create an account"])){
            $full_name=$_POST["full_name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $confirmPassword=$_POST["confirmPassword"];
               
        $password_hash=password_hash($password, PASSWORD_DEFAULT);
        $errors= array();
        if (empty($full_name) OR empty($email) OR empty($password) OR empty($confirmPassword)){
            array_push($errors,"You must fill all sections");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email not valid");
                }
                if(strlen($password)<8){
                    array_push($errors,"Password must contail atleast 8 letters");
                }
                if($password!=$confirmPassword){
                    array_push($errors,"Passwords do not match");
                    }
                 require_once "connect.php";
                 $sql="SELECT *FROM users WHERE email='$email'";
                 $result= mysqli_query($conn,$sql);
                 $rowCount=mysqli_num_rows($result);
                 if($rowCount>0){
                    array_push($errors,"Email exists");
                 }
                 if(Count($errors)>0){
                    foreach ($errors as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                        }
                    }
                    else{
                        $sql="INSERT INTO users (full_name,email,password)VALUES(?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
                        if($prepareStmt){
                            mysqli_stmt_bind_param($stmt,"sss",$full_name,$email,$password_hash);
                           mysqli_stmt_execute($stmt);
                            echo"<div class='alert alert-success'>Your account has been created.</div>";
                        }
                        else{
                            die("ERROR");
                        }  
                    }
                }
            ?>

    <div class="main">
        <div class="form-wrapper" id="form">
            <h1>Sign Up</h1>
            <form method="post" action="signup.php">
                
              <div class="form-group">  <input type="text" class="form-control" name="full_name" placeholder="full name" required>
                <input type="email" class="form-control" name="email" placeholder="Enter email or phone" required>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                <input type="confirmPassword" class="form-control" name="confirmPassword" placeholder="confirm password" required>
            </div>
            <div class="form-btn">
                <input id="log" class="btn btn-primary" type="submit" value="Create an account"></div>
                <div class="form-bottom">
                    <div class="sign">
                        <p>Already have an account?</p> <a id="signup" href="login.html">Log In</a>
                    </div>
            </form>
</body>

</html>
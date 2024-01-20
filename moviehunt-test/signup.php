<?php
if (!session_id()) {
    session_start();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['signUp'])) {
       
        if (isset($_POST['username']) && isset($_POST['password'])) {
            
            $username = $_POST['username'];
            $password = $_POST['password'];

           
            if (empty($username) || empty($password)) {
                echo "Please fill in all fields.";
            } else {
                
                $checkStmt = $conn->prepare("SELECT username FROM user WHERE username = ?");
                $checkStmt->bind_param("s", $username);
                $checkStmt->execute();
                $checkStmt->store_result();

                if ($checkStmt->num_rows > 0) {
                    echo "Username already exists. Please choose a different username.";
                    $checkStmt->close();
                    $conn->close();
                    exit; 
                }

                $checkStmt->close();

                
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                
                $stmt = $conn->prepare("INSERT INTO user (username, password, status) VALUES (?, ?, 202)");

                
                if ($stmt) {
                   
                    $stmt->bind_param("ss", $username, $hashedPassword);

                    
                    if ($stmt->execute());
                     else {
                        echo "Error during registration: " . $stmt->error;
                    }

                   
                    $stmt->close();
                } else {
                    
                    echo "Error during registration: " . $conn->error;
                }

                
                $conn->close();
            }
        }
    } elseif (isset($_POST['login_form'])) {
       
        if (isset($_POST['username']) && isset($_POST['password'])) {
           
            $user = $_POST['username'];
            $pass = $_POST['password'];

            
            if (empty($user) || empty($pass)) {
                echo "Please fill in all fields.";
            } else {
                
                $stmt = $conn->prepare("SELECT password, status FROM user WHERE username = ?");
                $stmt->bind_param("s", $user);

                
                $stmt->execute();

               
                $stmt->bind_result($hashedPassword, $status);

                
                $stmt->fetch();

                
                $stmt->close();

               
             if (trim($hashedPassword) !== null) {
                if ($hashedPassword == $pass || password_verify($pass, $hashedPassword)) {
                    $_SESSION['user'] = $user;
                    if ($status == 101) {
                        header('Location: /moviehunt-test/adminpage.php');
                        exit;
                    } elseif ($status == 202) {
                        header('Location: /moviehunt-test/index.php');
                        exit;
                    } else {
                        echo "Invalid status for user";
                    }
                } else {
                    echo "Password verification failed!";
                }
            } else {
                echo "Invalid hashed password fetched from the database";
            }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="glassicon.png" type="glassicon">
    <title>Moviehunt/Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="signUp" value="1">
                <h2>Create an Account</h2>
                <span>Use your email for registration</span>
                <input id="usernameSignUp" type="text" placeholder="Enter your username" name="username" />
                <input id="passwordSignUp" name="password" type="password" placeholder="Enter your password" />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="login_form" value="1">
                <input id="usernameSignIn" type="text" placeholder="Enter your username" name="username" />
                <input id="passwordSignIn" type="password" placeholder="Enter your password" name="password" />
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>Already have an account?</h2>
                    <p>Enter your login info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>Don't have an account?</h2>
                    <p>Register your personal info to get started</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <p>
            <a>MovieHunt</a>
            - Created by Nabina Upadhyaya and Ahwan Poudyal
            <a target="_blank" href="about\about.php">Learn more...</a>
        </p>
    </footer>
    <script src="signup.js"></script>
</body>

</html>

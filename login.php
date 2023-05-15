<?php

    include 'config/db_connect.php';

    $errors = array('email' => '', 'password' => '', 'submit' => '');

    if(isset($_POST['submit'])){

        // Check Email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required. <br />';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address. <br />';
            }
        }

        // Check Password
        if(empty($_POST['password'])){
            $errors['password'] = 'A password is required. <br />';
        }
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE user_email = '".$email."' AND user_password = '".$password."' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        print_r($row);
        echo $row;

        switch(isset($row['role_id'])) {
            case 1:
                $_SESSION['email']=$email;
                $_SESSION['role_id']="1";
                header("Location: index.php");
                break;
            case 2:
                $_SESSION['email']=$email;
                $_SESSION['role_id']="2";
                header("Location: index.php");
                break;
            case 3:
                $_SESSION['email']=$email;
                $_SESSION['role_id']="3";
                header("Location: index.php");
                break;
            case 4:
                $_SESSION['email']=$email;
                $_SESSION['role_id']="4";
                header("Location: index.php");
                break;
            case 5:
                $_SESSION['email']=$email;
                $_SESSION['role_id']="5";
                header("Location: index.php");
                break;
            default:
                $message= "username or password do not match";

                $_SESSION['loginMessage']=$message;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    
    <?php require 'templates/header.php'?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h2 text-gray-900 mb-1">City of Imus</h2>
                                        <h3 class="h6 text-gray-900 mb-4">Office Supplies Inventory Management System</h3>
                                        <h5 class="h5 text-gray-900 mb-3">Welcome Back!</h5>
                                    </div>
                                    <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Email Address" name="email" autocomplete="off">
                                            <div class="mt-2 text-danger"> <?php echo $errors['email'] ?></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off">
                                            <div class="mt-2 text-danger"> <?php echo $errors['password'] ?></div>
                                        </div>
                                        <div class="mt-2 text-danger"> <?php echo $errors['submit'] ?></div>
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center mb-2">
                                        <a class="" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center small">
                                        <span>Don't have an account? Contact your admin for access</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php require 'templates/plugins.php'?>

</body>

</html>
<?php

    if(isset($_POST['submit'])){
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['password']);

        // Check Email
        if(empty($_POST['email'])){
            echo 'A email is required <br />';
        } else {
            // echo htmlspecialchars($_POST['company-name']);
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo 'Email must be a valid email address';
            }
        }

        // Check Password
        if(empty($_POST['password'])){
            echo 'A password is required <br />';
        } else {
            
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
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="inputPassword" placeholder="Enter Password">
                                        </div>
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">
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
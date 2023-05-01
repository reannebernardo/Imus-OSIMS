<?php

    include 'config/db_connect.php';
    
    $user_name = $user_email = $role_id = '';
    $errors = array('user-name' => '', 'user-email' => '', 'role-id' => '');

    $sql ="SELECT role_id, role_name FROM user_role";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows> 0){
        $roles= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // POST check
    if(isset($_POST['submit'] ) ) {

        // Check Name
        if(empty($_POST['user-name']) ) {
            $errors['user-name'] = 'A name is required. <br />';
        } else {
            $user_name = $_POST['user-name'];
        }

        // Check Email
        if(empty($_POST['user-email']) ) {
            $errors['user-email'] = 'An email is required. <br />';
        } else {
            $user_email = $_POST['user-email'];
            if(!filter_var($user_email, FILTER_VALIDATE_EMAIL) ) {
                $errors['user-email'] = 'Email must be a valid email address <br />';
            }
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $user_name = mysqli_real_escape_string($conn, $_POST['user-name']);
            $user_email = mysqli_real_escape_string($conn, $_POST['user-email']);
            $role_id = mysqli_real_escape_string($conn, $_POST['selectRole']);

            // Create SQL
            $sql = "INSERT INTO user(user_name, user_email, role_id) 
                    VALUES('$user_name', '$user_email', '$role_id')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: users.php');
                exit;
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }
    // End of POST check

?>

<!DOCTYPE html>
<html lang="en">
    
<?php require 'templates/header.php'?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'templates/sidebar.php'?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'templates/topbar.php'?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4"></p>

                    <!-- Add User Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-user.php" method="POST">

                                <div class="mb-3">
                                    <label for="insertUserName" class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="user-name" id="user-name" value="<?php echo $user_name ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['user-name'] ?></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="insertUserEmail" class="form-label">Email *</label>
                                    <input type="text" class="form-control" name="user-email" id="user-email" value="<?php echo $user_email ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['user-email'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="selectRole" class="form-label">Role *</label>

                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectRole">
                                        <?php 
                                        foreach ($roles as $role) {
                                        ?>
                                            <option value="<?php echo $role['role_id']?>" name="role-id"> <?php echo $role['role_name']; ?> </option>
                                        <?php } ?>
                                    </select>

                                    <div class="mt-2 text-danger"> <?php echo $errors['role-id'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="users.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Add User Form-->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'templates/footer.php'?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include 'templates/scroll-to-top.php'?>
    <?php require 'templates/logout-modal.php'?>
    <?php require 'templates/plugins.php'?>

</body>

</html>
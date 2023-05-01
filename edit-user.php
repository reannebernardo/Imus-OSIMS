<?php

    include 'config/db_connect.php';

    $sql ="SELECT role_id, role_name FROM user_role";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows> 0){
        $roles= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Check GET request ID parameter
    if(isset($_GET['user_id']) ) {
        
        // Escape SQL characters
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        // Make SQL
        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('user-name' => '', 'user-email' => '', 'role-id' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

        // Check User Name
        if(empty($_POST['user-name']) ) {
            $errors['user-name'] = 'A name is required. <br />';
        } else {
            $user_name = $_POST['user-name'];
        }

        // Check User Email
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

            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);

            $sql = "UPDATE user
                    SET user_name = '$user_name', user_email = '$user_email', role_id = '$role_id'
                    WHERE user_id = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: users.php');
                exit;
            } else {
                echo 'Query error: ' . mysqli_error($conn);
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

                    <!-- Edit LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                        </div>
                        <div class="card-body">
                            <?php if($user): ?>
                                <form class="needs-validation" action="edit-user.php" method="POST">
                                    <div class="mb-3">
                                        <label for="insertUserName" class="form-label">Name *</label>
                                        <input type="text" class="form-control" name="user-name" id="user-name" value="<?php echo htmlspecialchars($user['user_name']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['user-name'] ?></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="insertUserEmail" class="form-label">Email *</label>
                                        <input type="text" class="form-control" name="user-email" id="user-email" value="<?php echo htmlspecialchars($user['user_email']) ?>">
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
                                        <form action="edit-user.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $user['user_id'] ?>">
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </form>
                                    </div>
                                </form>
                            <?php else: ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- End of Edit LGU Form-->

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
<?php

    include 'config/db_connect.php';
    
    $role_name = '';
    $errors = array('role-name' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {
        // Check LGU Name
        if(empty($_POST['role-name']) ) {
            $errors['role-name'] = 'A role name is required. <br />';
        } else {
            $role_name = $_POST['role-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $role_name = mysqli_real_escape_string($conn, $_POST['role-name']);

            // Create SQL
            $sql = "INSERT INTO user_role(role_name) 
                    VALUES('$role_name')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: user-roles.php');
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
                    <h1 class="h3 mb-2 text-gray-800">User Roles</h1>
                    <p class="mb-4"></p>

                    <!-- Add LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Role</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-role.php" method="POST">

                                <div class="mb-3">
                                    <label for="insertRoleName" class="form-label">Role Name *</label>
                                    <input type="text" class="form-control" name="role-name" id="role-name" value="<?php echo $role_name ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['role-name'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="roles.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Add LGU Form-->

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
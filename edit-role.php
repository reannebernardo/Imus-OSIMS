<?php

    include 'config/db_connect.php';

    // Check GET request ID parameter
    if(isset($_GET['role_id']) ) {
        
        // Escape SQL characters
        $role_id = mysqli_real_escape_string($conn, $_GET['role_id']);
        // Make SQL
        $sql = "SELECT * FROM user_role WHERE role_id = $role_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $role = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('role-name' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

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

            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);

            $sql = "UPDATE user_role
                    SET role_name = '$role_name'
                    WHERE role_id = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: user-roles.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Roles</h1>
                    <p class="mb-4"></p>

                    <!-- Edit LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
                        </div>
                        <div class="card-body">
                            <?php if($role): ?>
                                <form class="needs-validation" action="edit-role.php" method="POST">
                                    <div class="mb-3">
                                        <label for="inputLGUName" class="form-label">Role Name *</label>
                                        <input type="text" class="form-control" name="role-name" id="role-name" value="<?php echo htmlspecialchars($role['role_name']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['role-name'] ?></div>
                                    </div>
                                    
                                    <hr class="hr" />

                                    <div class="mb-3">
                                        <a class="btn btn-secondary" href="user-roles.php">Cancel</a>
                                        <form action="edit-role.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $role['role_id'] ?>">
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
<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM user WHERE user_id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: users.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['user_id'])){
        
        // Escape SQL characters
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        // Make SQL
        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $users = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all users
    $sql = 'SELECT * FROM user ORDER BY user_id';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // // Free result from memory
    // mysqli_free_result($result);

    // // Close DB connection
    // mysqli_close($conn);

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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form class="d-none d-sm-inline-block form-inline mr-2 my-2 my-md-0 navbar-search" action="purchase-requests.php" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-white border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Search" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                            
                            <a href="add-user.php" class="btn btn-success" role="button">Add User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $user) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($user['user_id']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['user_name']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['user_email']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $role_id = htmlspecialchars($user['role_id']);
                                                        $sql = "SELECT role_name FROM user_role WHERE role_id = $role_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $roles = mysqli_fetch_assoc($result);
                                                        foreach($roles as $role) {
                                                            echo $role;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-user.php?user_id=<?php echo $user['user_id'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="users.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $user['user_id'] ?>">
                                                            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
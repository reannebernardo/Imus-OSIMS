<?php

    include 'config/db_connect.php';

    // Check GET request ID parameter
    if(isset($_GET['office_id']) ) {
        
        // Escape SQL characters
        $office_id = mysqli_real_escape_string($conn, $_GET['office_id']);
        // Make SQL
        $sql = "SELECT * FROM office WHERE office_id = $office_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $office = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('office-name' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

        // Check LGU Name
        if(empty($_POST['office-name']) ) {
            $errors['office-name'] = 'An office name is required. <br />';
        } else {
            $office_name = $_POST['office-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $office_name = mysqli_real_escape_string($conn, $_POST['office-name']);

            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);

            $sql = "UPDATE office
                    SET office_name = '$office_name'
                    WHERE office_id = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: offices.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Offices</h1>
                    <p class="mb-4"></p>

                    <!-- Edit LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Office</h6>
                        </div>
                        <div class="card-body">
                            <?php if($office): ?>
                                <form class="needs-validation" action="edit-office.php" method="POST">
                                    <div class="mb-3">
                                        <label for="inputLGUName" class="form-label">Office Name *</label>
                                        <input type="text" class="form-control" name="office-name" id="office-name" value="<?php echo htmlspecialchars($office['office_name']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['office-name'] ?></div>
                                    </div>
                                    
                                    <hr class="hr" />

                                    <div class="mb-3">
                                        <a class="btn btn-secondary" href="offices.php">Cancel</a>
                                        <form action="edit-office.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $office['office_id'] ?>">
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
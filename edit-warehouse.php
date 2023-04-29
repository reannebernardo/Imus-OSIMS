<?php

    include 'config/db_connect.php';

    // Check GET request ID parameter
    if(isset($_GET['wr_code']) ) {
        
        // Escape SQL characters
        $wr_code = mysqli_real_escape_string($conn, $_GET['wr_code']);
        // Make SQL
        $sql = "SELECT * FROM warehouse WHERE wr_code = $wr_code";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $warehouse = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('wr-name' => '', 'wr-address' => '', 'wr-remaining-capacity' => '', 'wr-manager' => '', 'wr-phone' => '', 'wr-email' => '');

    if(isset($_POST['update'] ) ) {

        // Check Warehouse Name
        if(empty($_POST['wr-name']) ) {
            $errors['wr-name'] = 'A warehouse name is required. <br />';
        } else {
            $wr_name = $_POST['wr-name'];
        }

        // Check Address
        if(empty($_POST['wr-address']) ) {
            $errors['wr-address'] = 'An address is required. <br />';
        } else {
            $wr_address = $_POST['wr-address'];
        }

        // Check Remaining Capacity
        if(empty($_POST['wr-remaining-capacity']) ) {
            $errors['wr-remaining-capacity'] = 'A number is required. <br />';
        } else {
            $wr_remaining_capacity = $_POST['wr-remaining-capacity'];
            // if (!preg_match('^(\d{9}|\d{12})$^', $tin) ) {
            //     $errors['tin'] = 'A TIN number is should be at least 9 digits and no more than 12 digits.';
            // }
        }

        // Check Manager Name
        if(empty($_POST['wr-manager']) ) {
            $errors['wr-manager'] = 'A manager name is required. <br />';
        } else {
            $wr_manager = $_POST['wr-manager'];
            // if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $products) ) {
            //     $errors['products'] = 'Products must be a comma separated list.';
            // }
        }

        // Check Manager Phone
        if(empty($_POST['wr-phone']) ) {
            $errors['wr-phone'] = 'A phone number is required. <br />';
        } else {
            $wr_phone = $_POST['wr-phone'];
        }

        // Check Manager Email
        if(empty($_POST['wr-email']) ) {
            $errors['wr-email'] = 'An email is required. <br />';
        } else {
            $wr_email = $_POST['wr-email'];
            // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            //     $errors['appointed-date'] = 'Date format is invalid. <br />';
            // } else {
            //     $appointed_date = $_POST['appointed-date'];
            // }
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $wr_name = mysqli_real_escape_string($conn, $_POST['wr-name']);
            $wr_address = mysqli_real_escape_string($conn, $_POST['wr-address']);
            $wr_remaining_capacity = mysqli_real_escape_string($conn, $_POST['wr-remaining-capacity']);
            $wr_manager = mysqli_real_escape_string($conn, $_POST['wr-manager']);
            $wr_phone = mysqli_real_escape_string($conn, $_POST['wr-phone']);
            $wr_email = mysqli_real_escape_string($conn, $_POST['wr-email']);
            
            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);

            // Create SQL
            $sql = "UPDATE warehouse
                    SET wr_name = '$wr_name', wr_address = '$wr_address', wr_remaining_capacity = '$wr_remaining_capacity', wr_manager = '$wr_manager', wr_phone = '$wr_phone', wr_email = '$wr_email'
                    WHERE wr_code = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: warehouses.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Warehouses</h1>
                    <p class="mb-4"></p>

                    <!-- Edit Warehouse Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Warehouse</h6>
                        </div>
                        <div class="card-body">
                            <?php if($warehouse): ?>
                                <form class="needs-validation" action="edit-warehouse.php" method="POST">

                                    <legend>WAREHOUSE</legend>

                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Warehouse Name</label>
                                        <input type="text" name="wr-name" class="form-control" id="inputName" value="<?php echo htmlspecialchars($warehouse['wr_name']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-name'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <input type="text" name="wr-address" class="form-control" id="inputAddress" value="<?php echo htmlspecialchars($warehouse['wr_address']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-address'] ?></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="inputRemainingCap" class="form-label">Remaining Capacity</label>
                                        <input type="text" name="wr-remaining-capacity" class="form-control" id="inputRemainingCap" value="<?php echo htmlspecialchars($warehouse['wr_remaining_capacity']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-remaining-capacity'] ?></div>
                                    </div>
                                    
                                    <hr class="divider d-none d-sm-block"></hr>

                                    <legend>MANAGER</legend>

                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" name="wr-manager" class="form-control" id="inputName" value="<?php echo htmlspecialchars($warehouse['wr_manager']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-manager'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPhone" class="form-label">Phone</label>
                                        <input type="text" name="wr-phone" class="form-control" id="inputPhone" value="<?php echo htmlspecialchars($warehouse['wr_phone']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-phone'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="text" name="wr-email" class="form-control" id="inputEmail" value="<?php echo htmlspecialchars($warehouse['wr_email']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['wr-email'] ?></div>
                                    </div>
                                    
                                    <hr class="hr" />

                                    <div class="mb-3">
                                        <a class="btn btn-secondary" href="warehouses.php">Cancel</a>
                                        <form action="edit-warehouse.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $warehouse['wr_code'] ?>">
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </form>
                                    </div>
                                </form>
                            <?php else: ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- End of Edit Warehouse Form-->

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
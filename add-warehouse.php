<?php
    include 'config/db_connect.php';
        
    $wr_name = $wr_address = $wr_manager = $wr_phone = $wr_email = $wr_remaining_capacity = '';
    $errors = array('wr-name' => '', 'wr-address' => '', 'wr-remaining-capacity' => '', 'wr-manager' => '', 'wr-phone' => '', 'wr-email' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {
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

            // Create SQL
            $sql = "INSERT INTO warehouse(wr_name, wr_address, wr_remaining_capacity, wr_manager, wr_phone, wr_email) 
                    VALUES('$wr_name', '$wr_address', '$wr_remaining_capacity', '$wr_manager', '$wr_phone', '$wr_email')";

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

                    <!-- Add Warehouse Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Warehouse</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-warehouse.php" method="POST">

                                <legend>WAREHOUSE</legend>

                                <div class="mb-3">
                                    <label for="inputName" class="form-label">Warehouse Name</label>
                                    <input type="text" name="wr-name" class="form-control" id="inputName" <?php echo $wr_name ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-name'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" name="wr-address" class="form-control" id="inputAddress" <?php echo $wr_address ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-address'] ?></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputRemainingCap" class="form-label">Remaining Capacity</label>
                                    <input type="text" name="wr-remaining-capacity" class="form-control" id="inputRemainingCap" <?php echo $wr_remaining_capacity ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-remaining-capacity'] ?></div>
                                </div>
                                
                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>MANAGER</legend>

                                <div class="mb-3">
                                    <label for="inputName" class="form-label">Name</label>
                                    <input type="text" name="wr-manager" class="form-control" id="inputName" <?php echo $wr_manager ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-manager'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <input type="text" name="wr-phone" class="form-control" id="inputPhone" <?php echo $wr_phone ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-phone'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="text" name="wr-email" class="form-control" id="inputEmail" <?php echo $wr_email ?>>
                                    <div class="mt-2 text-danger"> <?php echo $errors['wr-email'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="warehouses.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Add Warehouse Form-->
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
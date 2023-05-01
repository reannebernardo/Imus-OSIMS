<?php

    include 'config/db_connect.php';
    
    $lgu = '';
    $errors = array('lgu-name' => '', 'office-name' => '', 'item-id' => '', 'purpose' => '', 'requested-by' => '');

    $sql ="SELECT lgu_id, lgu_name FROM lgu";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows> 0){
        $lgus= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // POST check
    if(isset($_POST['submit'] ) ) {
        // Check LGU Name
        if(empty($_POST['lgu-name']) ) {
            $errors['lgu-name'] = 'An LGU is required. <br />';
        } else {
            $lgu_name = $_POST['lgu-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $office_name = mysqli_real_escape_string($conn, $_POST['office-name']);

            // Create SQL
            $sql = "INSERT INTO office(office_name) 
                    VALUES('$office_name')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: offices.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Requests</h1>
                    <p class="mb-4">The PR is a form used by the <b>Supply and/or Property Custodian</b> for purchasing goods/supplies/property if the item/s requested is/are not available on stock.</p>

                    <!-- Create PR Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Purchase Request</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="create-pr.php" method="GET">

                                <legend>INFORMATION</legend>

                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                        <option selected>Select LGU</option>
                                        <?php 
                                        foreach ($lgus as $lgu) {
                                        ?>
                                            <option value="<?php echo $lgu['lgu_id']?>"><?php echo $lgu['lgu_name']; ?> </option>
                                            <?php 
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Office</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice">
                                        <option selected>Select Office</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="itemGroup">

                                    <hr class="divider d-none d-sm-block"></hr>

                                    <legend>ITEM</legend>

                                    <div class="mb-3">
                                        <label for="inputItemNo" class="form-label">Item No.</label>
                                        <input type="text" class="form-control" name="inputItemNo" id="inputItemNo" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputUnit" class="form-label">Unit</label>
                                        <input type="text" class="form-control" name="inputUnit" id="inputUnit" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputDesc" class="form-label">Item Description</label>
                                        <textarea type="text" class="form-control" name="inputDesc" id="inputDesc" required></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="inputQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="inputQuantity" id="inputQuantity" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputUnitCost" class="form-label">Unit Cost</label>
                                        <input type="text" class="form-control" name="inputUnitCost" id="inputUnitCost" required>
                                    </div>

                                    <fieldset disabled>
                                        <div class="mb-3">
                                            <label for="inputTotalCost" class="form-label">Total Cost</label>
                                            <input type="text" class="form-control" name="inputTotalCost" id="inputTotalCost" required>
                                        </div>
                                    </fieldset>

                                    <div class="mb-3">
                                        <label for="inputPurpose" class="form-label">Purpose</label>
                                        <textarea type="text" class="form-control" name="inputPurpose" id="inputPurpose" required></textarea>
                                    </div>

                                </div>
                                <a href="#" class="btn btn-primary" id="addItem">Add Another Item</a>

                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="purchase-requests.php">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
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
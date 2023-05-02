<?php

    include 'config/db_connect.php';
    
    $item_name = $item_unit = $item_desc = $item_qty = $unit_cost = $pr_purpose ='';
    $errors = array('item-name' => '', 'item-unit' => '', 'item-desc' => '', 'item-qty' => '', 'unit-cost' => '', 'pr-purpose' => '');

    $sqlLgu ="SELECT lgu_id, lgu_name FROM lgu";
    $resultLgu = mysqli_query($conn, $sqlLgu);
    if($resultLgu->num_rows> 0){
        $lgus= mysqli_fetch_all($resultLgu, MYSQLI_ASSOC);
    }

    $sqlOffice ="SELECT office_id, office_name FROM office";
    $resultOffice = mysqli_query($conn, $sqlOffice);
    if($resultOffice->num_rows> 0){
        $offices= mysqli_fetch_all($resultOffice, MYSQLI_ASSOC);
    }

    // POST check
    if(isset($_POST['submit'] ) ) {
        
        // Check Item Name
        if(empty($_POST['item-name']) ) {
            $errors['item-name'] = 'An item name is required. <br />';
        } else {
            $item_name = $_POST['item-name'];
        }
        // Check Item Unit
        if(empty($_POST['item-unit']) ) {
            $errors['item-unit'] = 'An item unit is required. <br />';
        } else {
            $item_unit = $_POST['item-unit'];
        }
        // Check Item Description
        if(empty($_POST['item-desc']) ) {
            $errors['item-desc'] = 'An item desc is required. <br />';
        } else {
            $item_desc = $_POST['item-desc'];
        }
        // Check Item Quantity
        if(empty($_POST['item-qty']) ) {
            $errors['item-qty'] = 'An item quantity is required. <br />';
        } else {
            $item_qty = $_POST['item-qty'];
        }
        // Check Unit Cost
        if(empty($_POST['unit-cost']) ) {
            $errors['unit-cost'] = 'A unit cost is required. <br />';
        } else {
            $unit_cost = $_POST['unit-cost'];
        }
        // Check Item Name
        if(empty($_POST['pr-purpose']) ) {
            $errors['pr-purpose'] = 'A purpose is required. <br />';
        } else {
            $pr_purpose = $_POST['pr-purpose'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);
            $office_id = mysqli_real_escape_string($conn, $_POST['selectOffice']);
            $item_name = mysqli_real_escape_string($conn, $_POST['item-name']);
            $item_unit = mysqli_real_escape_string($conn, $_POST['item-unit']);
            $item_desc = mysqli_real_escape_string($conn, $_POST['item-desc']);
            $item_qty = mysqli_real_escape_string($conn, $_POST['item-qty']);
            $unit_cost = mysqli_real_escape_string($conn, $_POST['unit-cost']);
            $pr_purpose = mysqli_real_escape_string($conn, $_POST['pr-purpose']);

            // multiply stock quantity and unit cost to get the total cost
            $total_cost = $item_qty * $unit_cost;
            
            // Create SQL
            $sqlReqItem = "INSERT INTO requested_item(item_name, item_unit, item_desc, item_qty, unit_cost, total_cost) 
                VALUES('$item_name', '$item_unit', '$item_desc', '$item_qty', '$unit_cost', '$total_cost')";

            mysqli_query($conn, $sqlReqItem);

            $item_id = mysqli_insert_id($conn);

            $sqlPR = "INSERT INTO purchase_request(lgu_id, office_id, item_id, pr_purpose) 
                VALUES('$lgu_id', '$office_id', '$item_id', '$pr_purpose')";

            // Save to DB and check
            if(mysqli_query($conn, $sqlPR)) {
                header('Location: purchase-requests.php');
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
                            <form class="needs-validation" action="create-pr.php" method="POST">

                                <legend>INFORMATION</legend>

                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                        <?php 
                                        foreach ($lgus as $lgu) {
                                        ?>
                                            <option value="<?php echo $lgu['lgu_id']?>"><?php echo $lgu['lgu_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Office</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice" name="selectOffice">
                                        <?php 
                                        foreach ($offices as $office) {
                                        ?>
                                            <option value="<?php echo $office['office_id']?>"><?php echo $office['office_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="itemGroup">

                                    <hr class="divider d-none d-sm-block"></hr>

                                    <legend>ITEM</legend>

                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Item Name</label>
                                        <input type="text" class="form-control" name="item-name" id="inputName" value="<?php echo $item_name ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['item-name'] ?></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="inputUnit" class="form-label">Unit</label>
                                        <input type="text" class="form-control" name="item-unit" id="inputUnit" value="<?php echo $item_unit ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['item-unit'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputDesc" class="form-label">Item Description</label>
                                        <textarea type="text" class="form-control" name="item-desc" id="inputDesc" value="<?php echo $item_desc ?>"></textarea>
                                        <div class="mt-2 text-danger"> <?php echo $errors['item-desc'] ?></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="inputQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="item-qty" id="inputQuantity" value="<?php echo $item_qty ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['item-qty'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputUnitCost" class="form-label">Unit Cost</label>
                                        <input type="text" class="form-control" name="unit-cost" id="inputUnitCost" value="<?php echo $unit_cost ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['unit-cost'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPurpose" class="form-label">Purpose</label>
                                        <textarea type="text" class="form-control" name="pr-purpose" id="inputPurpose" value="<?php echo $pr_purpose ?>"></textarea>
                                        <div class="mt-2 text-danger"> <?php echo $errors['pr-purpose'] ?></div>
                                    </div>

                                </div>

                                <a href="#" class="btn btn-primary">Add Another Item</a>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="purchase-requests.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>
                            </form>
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
<?php

    include 'config/db_connect.php';
    
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

    // Check GET request ID parameter
    if(isset($_GET['pr_no']) ) {
        
        // Escape SQL characters
        $pr_no = mysqli_real_escape_string($conn, $_GET['pr_no']);
        // Make SQL
        $sql = "SELECT * FROM purchase_request WHERE pr_no = $pr_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $purchase_request = mysqli_fetch_assoc($result);
    }
    
    // Check GET request ID parameter
    if(isset($_GET['item_id']) ) {
        
        // Escape SQL characters
        $item_id = mysqli_real_escape_string($conn, $_GET['item_id']);
        // Make SQL
        $sql = "SELECT * FROM requested_item WHERE item_id = $item_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $requested_item = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);   
    }

    $errors = array('item-name' => '', 'item-unit' => '', 'item-desc' => '', 'item-qty' => '', 'unit-cost' => '', 'pr-purpose' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

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

            $total_cost = $item_qty * $unit_cost;

            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
            
            $sqlReqItem = "UPDATE requested_item
                        SET item_name = '$item_name', item_unit = '$item_unit', item_desc = '$item_desc', item_qty = '$item_qty', unit_cost = '$unit_cost', total_cost = '$total_cost'
                        WHERE item_id = $id_to_update";

            mysqli_query($conn, $sqlReqItem);

            $no_to_update = mysqli_real_escape_string($conn, $_POST['no_to_update']);

            $sqlPR = "UPDATE purchase_request
                        SET lgu_id = '$lgu_id', office_id = '$office_id', pr_purpose = '$pr_purpose'
                        WHERE pr_no = $no_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sqlPR)) {
                header('Location: purchase-requests.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Requests</h1>
                    <p class="mb-4"></p>

                    <!-- Edit Purchase Request Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Purchase Request</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="edit-pr.php" method="POST">

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
                                    <input type="text" class="form-control" name="item-name" id="inputName" value="<?php echo htmlspecialchars($requested_item['item_name']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['item-name'] ?></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputUnit" class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="item-unit" id="inputUnit" value="<?php echo htmlspecialchars($requested_item['item_unit']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['item-unit'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDesc" class="form-label">Item Description</label>
                                    <textarea type="text" class="form-control" name="item-desc" id="inputDesc"><?php echo htmlspecialchars($requested_item['item_desc']) ?></textarea>
                                    <div class="mt-2 text-danger"> <?php echo $errors['item-desc'] ?></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputQuantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="item-qty" id="inputQuantity" value="<?php echo htmlspecialchars($requested_item['item_qty']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['item-qty'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputUnitCost" class="form-label">Unit Cost</label>
                                    <input type="text" class="form-control" name="unit-cost" id="inputUnitCost" value="<?php echo htmlspecialchars($requested_item['unit_cost']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['unit-cost'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputPurpose" class="form-label">Purpose</label>
                                    <textarea type="text" class="form-control" name="pr-purpose" id="inputPurpose"><?php echo htmlspecialchars($purchase_request['pr_purpose']) ?></textarea>
                                    <div class="mt-2 text-danger"> <?php echo $errors['pr-purpose'] ?></div>
                                </div>

                            </div>

                                <a href="#" class="btn btn-primary">Add Another Item</a>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                        <a class="btn btn-secondary" href="purchase-requests.php">Cancel</a>
                                        <form action="edit-pr.php" method="POST" class="mr-1">
                                            <input type="hidden" name="no_to_update" value="<?php echo $purchase_request['pr_no'] ?>">
                                            <input type="hidden" name="id_to_update" value="<?php echo $requested_item['item_id'] ?>">
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </form>
                                    </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Edit Purchase Request Form-->

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
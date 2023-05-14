<?php

    include 'config/db_connect.php';
    
    $sqlLgu ="SELECT lgu_id, lgu_name FROM lgu";
    $resultLgu = mysqli_query($conn, $sqlLgu);
    if($resultLgu->num_rows> 0){
        $lgus= mysqli_fetch_all($resultLgu, MYSQLI_ASSOC);
    }

    $sqlSupplier ="SELECT supplier_id, supplier_name FROM supplier";
    $resultSupplier = mysqli_query($conn, $sqlSupplier);
    if($resultSupplier->num_rows> 0){
        $suppliers= mysqli_fetch_all($resultSupplier, MYSQLI_ASSOC);
    }

    $sqlWarehouse ="SELECT wr_code, wr_name FROM warehouse";
    $resultWarehouse = mysqli_query($conn, $sqlWarehouse);
    if($resultWarehouse->num_rows> 0){
        $warehouses= mysqli_fetch_all($resultWarehouse, MYSQLI_ASSOC);
    }

    $sqlMode ="SELECT mode_id, mode_name FROM procurement_mode";
    $resultMode = mysqli_query($conn, $sqlMode);
    if($resultMode->num_rows> 0){
        $modes= mysqli_fetch_all($resultMode, MYSQLI_ASSOC);
    }

    $sqlPayment ="SELECT payment_id, payment_name FROM payment_term";
    $resultPayment = mysqli_query($conn, $sqlPayment);
    if($resultPayment->num_rows> 0){
        $payments= mysqli_fetch_all($resultPayment, MYSQLI_ASSOC);
    }

    // Check GET order ID parameter
    if(isset($_GET['po_no']) ) {
        
        // Escape SQL characters
        $po_no = mysqli_real_escape_string($conn, $_GET['po_no']);
        // Make SQL
        $sql = "SELECT * FROM purchase_order WHERE po_no = $po_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $purchase_order = mysqli_fetch_assoc($result);
    }

    $errors = array('pr-no' => '', 'card-no' => '', 'date-of-delivery' => '', 'amount' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

        // Check PR No
        if(empty($_POST['pr-no']) ) {
            $errors['pr-no'] = 'A PR No is required. <br />';
        } else {
            $pr_no = $_POST['pr-no'];
        }
        // Check Stock Card
        if(empty($_POST['card-no']) ) {
            $errors['card-no'] = 'A Stock Card is required. <br />';
        } else {
            $card_no = $_POST['card-no'];
        }
        // Check Date of Delivery
        if(empty($_POST['date-of-delivery']) ) {
            $errors['date-of-delivery'] = 'A date is required. <br />';
        } else {
            $date_of_delivery = $_POST['date-of-delivery'];
        }
        // Check Amount
        if(empty($_POST['amount']) ) {
            $errors['amount'] = 'An amount is required. <br />';
        } else {
            $amount = $_POST['amount'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to poevent sql injection
            $pr_no = mysqli_real_escape_string($conn, $_POST['pr-no']);
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);
            $card_no = mysqli_real_escape_string($conn, $_POST['card-no']);
            $supplier_id = mysqli_real_escape_string($conn, $_POST['selectSupplier']);
            $mode_id = mysqli_real_escape_string($conn, $_POST['selectMode']);
            $warehouse_id = mysqli_real_escape_string($conn, $_POST['selectWarehouse']);
            $date_of_delivery = mysqli_real_escape_string($conn, $_POST['date-of-delivery']);
            $payment_id = mysqli_real_escape_string($conn, $_POST['selectPayment']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);


            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
            
            $sql = "UPDATE purchase_order
                        SET 
                        pr_no = '$pr_no', 
                        lgu_id = '$lgu_id', 
                        card_no = '$card_no', 
                        supplier_id = '$supplier_id', 
                        mode_of_payment = '$mode_id', 
                        wr_code = '$warehouse_id', 
                        date_of_delivery = '$date_of_delivery', 
                        payment_term = '$payment_id', 
                        amount = '$amount'
                        WHERE po_no = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: purchase-orders.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Orders</h1>
                    <p class="mb-4">The PO is a form/document used by the agency/entity, addressed to a supplier, to deliver specific quantities of supplies/goods/pooperty subject to the terms and conditions contained in the PO.</p>

                    <!-- Edit Purchase Order Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-poimary">Edit Purchase Order</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="edit-po.php" method="POST">

                            <div class="mb-3">
                                    <label for="inputPR" class="form-label">PR No. *</label>
                                    <input type="text" class="form-control" name="pr-no" id="inputPR" value="<?php echo htmlspecialchars($purchase_order['pr_no']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['pr-no'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                        <?php 
                                        foreach ($lgus as $lgu) {
                                        ?>
                                            <option value="<?php echo $lgu['lgu_id']?>"><?php echo $lgu['lgu_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inputCard" class="form-label">Stock Card No. *</label>
                                    <input type="text" class="form-control" name="card-no" id="inputCard" value="<?php echo htmlspecialchars($purchase_order['card_no']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['card-no'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="selectSupplier" class="form-label">Supplier *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectSupplier" name="selectSupplier">
                                        <?php 
                                        foreach ($suppliers as $supplier) {
                                        ?>
                                            <option value="<?php echo $supplier['supplier_id']?>"><?php echo $supplier['supplier_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectMode" class="form-label">Mode of Payment *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectMode" name="selectMode">
                                        <?php 
                                        foreach ($modes as $mode) {
                                        ?>
                                            <option value="<?php echo $mode['mode_id']?>"><?php echo $mode['mode_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectWarehouse" class="form-label">Place of Delivery (Warehouse) *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectWarehouse" name="selectWarehouse">
                                        <?php 
                                        foreach ($warehouses as $warehouse) {
                                        ?>
                                            <option value="<?php echo $warehouse['wr_code']?>"><?php echo $warehouse['wr_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectPayment" class="form-label">Payment Term *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectPayment" name="selectPayment">
                                        <?php 
                                        foreach ($payments as $payment) {
                                        ?>
                                            <option value="<?php echo $payment['payment_id']?>"><?php echo $payment['payment_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDate" class="form-label">Date of Delivery (Format: YYYY-MM-DD) *</label>
                                    <input type="text" class="form-control" name="date-of-delivery" id="inputDate" value="<?php echo htmlspecialchars($purchase_order['date_of_delivery']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['date-of-delivery'] ?></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputAmount" class="form-label">Amount *</label>
                                    <input type="text" class="form-control" name="amount" id="inputAmount" value="<?php echo htmlspecialchars($purchase_order['amount']) ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['amount'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                        <a class="btn btn-secondary" href="purchase-orders.php">Cancel</a>
                                        <form action="edit-po.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $purchase_order['po_no'] ?>">
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </form>
                                    </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Edit Purchase Order Form-->

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
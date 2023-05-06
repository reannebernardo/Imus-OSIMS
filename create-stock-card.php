<?php

    include 'config/db_connect.php';
    
    $reorder_point = $receipt_qty = $issue_qty = $balance_qty = '';
    $errors = array('reorder-point' => '', 'receipt-qty' => '', 'issue-qty' => '', 'balance-qty' => '' );

    // for options dropdown
    $sqlLgu ="SELECT lgu_id, lgu_name FROM lgu";
    $resultLgu = mysqli_query($conn, $sqlLgu);
    if($resultLgu->num_rows> 0){
        $lgus= mysqli_fetch_all($resultLgu, MYSQLI_ASSOC);
    }
    $sqlItem ="SELECT stock_id, stock_name, stock_desc, stock_unit FROM stock_item";
    $resultItem = mysqli_query($conn, $sqlItem);
    if($resultItem->num_rows> 0){
        $stock_items= mysqli_fetch_all($resultItem, MYSQLI_ASSOC);
    }
    $sqlOffice ="SELECT office_id, office_name FROM office";
    $resultOffice = mysqli_query($conn, $sqlOffice);
    if($resultOffice->num_rows> 0){
        $offices= mysqli_fetch_all($resultOffice, MYSQLI_ASSOC);
    }

    // POST check
    if(isset($_POST['submit'] ) ) {
        
        // Check Re-order Point
        if(empty($_POST['reorder-point']) ) {
            $errors['reorder-point'] = 'A re-order point is required. <br />';
        } else {
            $reorder_point = $_POST['reorder-point'];
        }

        // Check Receipt Quantity
        if(empty($_POST['receipt-qty']) ) {
            $errors['receipt-qty'] = 'A receipt quantity is required. <br />';
        } else {
            $receipt_qty = $_POST['receipt-qty'];
        }

        // Check Issue Quantity
        if(empty($_POST['issue-qty']) ) {
            $errors['issue-qty'] = 'An issue quantity is required. <br />';
        } else {
            $issue_qty = $_POST['issue-qty'];
        }

        // Check Balance Quantity
        if(empty($_POST['balance-qty']) ) {
            $errors['balance-qty'] = 'A balance quantity is required. <br />';
        } else {
            $balance_qty = $_POST['balance-qty'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);
            $stock_id = mysqli_real_escape_string($conn, $_POST['selectItem']);
            $stock_name = mysqli_real_escape_string($conn, $stock_items['stock_name']);
            $stock_desc = mysqli_real_escape_string($conn, $stock_items['stock_desc']);
            $unit_measurement = mysqli_real_escape_string($conn, $stock_items['stock_unit']);
            $reorder_point = mysqli_real_escape_string($conn, $_POST['reorder-point']);
            $receipt_qty = mysqli_real_escape_string($conn, $_POST['receipt-qty']);
            $issue_qty = mysqli_real_escape_string($conn, $_POST['issue-qty']);
            $issue_office = mysqli_real_escape_string($conn, $_POST['selectOffice']);
            $balance_qty = mysqli_real_escape_string($conn, $_POST['balance-qty']);

            // Create SQL
            $sql = "INSERT INTO stock_card(lgu_id, stock_id, stock_name, stock_desc, unit_measurement, reorder_point, receipt_qty, issue_qty, issue_office, balance_qty) 
                    VALUES('$lgu_id', '$stock_id', '$stock_name', '$stock_desc', '$unit_measurement', '$reorder_point', '$receipt_qty', '$issue_qty', '$issue_office', '$balance_qty')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: stock-cards.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Stock Cards</h1>
                    <p class="mb-4"></p>

                    <!-- Add LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Stock Card</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="create-stock-card.php" method="POST">

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
                                    <label for="selectItem" class="form-label">Stock Item *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectItem">
                                        <?php 
                                        foreach ($stock_items as $stock_item) {
                                        ?>
                                            <option value="<?php echo $stock_item['stock_id']?>"><?php echo $stock_item['stock_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="insertReorder" class="form-label">Re-order Point *</label>
                                    <input type="text" class="form-control" name="reorder-point" id="reorder-point" value="<?php echo $reorder_point ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['reorder-point'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="insertReceiptQty" class="form-label">Receipt Quantity *</label>
                                    <input type="text" class="form-control" name="receipt-qty" id="receipt-qty" value="<?php echo $receipt_qty ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['receipt-qty'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="insertIssueQty" class="form-label">Issue Quantity *</label>
                                    <input type="text" class="form-control" name="issue-qty" id="issue-qty" value="<?php echo $issue_qty ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['issue-qty'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Issue Office *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice" name="selectOffice">
                                        <?php 
                                        foreach ($offices as $office) {
                                        ?>
                                            <option value="<?php echo $office['office_id']?>"><?php echo $office['office_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="insertBalanceQty" class="form-label">Balance Quantity *</label>
                                    <input type="text" class="form-control" name="balance-qty" id="balance-qty" value="<?php echo $balance_qty ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['balance-qty'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="stock-cards.php">Cancel</a>
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
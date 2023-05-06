<?php

    include 'config/db_connect.php';

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

    // Check GET request ID parameter
    if(isset($_GET['card_no']) ) {
        
        // Escape SQL characters
        $card_no = mysqli_real_escape_string($conn, $_GET['card_no']);
        // Make SQL
        $sql = "SELECT * FROM stock_card WHERE card_no = $card_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $stock_card = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('reorder-point' => '', 'receipt-qty' => '', 'issue-qty' => '', 'balance-qty' => '' );

    // POST check
    if(isset($_POST['update'] ) ) {

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
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);;
            $stock_id = mysqli_real_escape_string($conn, $_POST['selectItem']);
            
            $stock_name = mysqli_real_escape_string($conn, $stock_items['stock_name']);
            $stock_desc = mysqli_real_escape_string($conn, $stock_items['stock_desc']);
            $unit_measurement = mysqli_real_escape_string($conn, $stock_items['stock_unit']);

            $reorder_point = mysqli_real_escape_string($conn, $_POST['reorder-point']);
            $receipt_qty = mysqli_real_escape_string($conn, $_POST['receipt-qty']);
            $issue_qty = mysqli_real_escape_string($conn, $_POST['issue-qty']);
            $issue_office = mysqli_real_escape_string($conn, $_POST['selectOffice']);
            $balance_qty = mysqli_real_escape_string($conn, $_POST['balance-qty']);

            $card_to_update = mysqli_real_escape_string($conn, $_POST['card_to_update']);

            $sqlCard = "UPDATE stock_card
                    SET lgu_id = '$lgu_id', reorder_point = '$reorder_point', receipt_qty = '$receipt_qty', issue_qty = '$issue_qty', balance_qty = '$balance_qty'
                    WHERE card_no = $card_to_update";

            mysqli_query($conn, $sqlCard);

            $stock_to_update = mysqli_real_escape_string($conn, $_POST['stock_to_update']);

            $sqlStock = "UPDATE stock_card
                        SET stock_id = '$stock_id', stock_name = '$stock_name', stock_desc = '$stock_desc', unit_measurement = '$unit_measurement'
                        WHERE stock_id = $stock_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sqlStock)) {
                header('Location: stock-cards.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Stock Cards</h1>
                    <p class="mb-4"></p>

                    <!-- Edit Stock Item Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Stock Card</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="edit-stock-card.php" method="POST">

                            <div class="mb-3">
                                <label for="selectLGU" class="form-label">LGU *</label>
                                <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                    <?php 
                                    foreach ($lgus as $lgu) {
                                    ?>
                                        <option value="<?php echo $lgu['lgu_id'] ?>"><?php echo $lgu['lgu_name']; ?> </option>
                                        
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="selectItem" class="form-label">Stock Item *</label>
                                <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectItem">
                                    <?php 
                                    foreach ($stock_items as $stock_item) {
                                    ?>
                                        <option value="<?php echo $stock_item['stock_id'] ?>"><?php echo $stock_item['stock_name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="insertReorder" class="form-label">Re-order Point *</label>
                                <input type="text" class="form-control" name="reorder-point" id="reorder-point" value="<?php echo htmlspecialchars($stock_card['reorder_point']) ?>">
                                <div class="mt-2 text-danger"> <?php echo $errors['reorder-point'] ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="insertReceiptQty" class="form-label">Receipt Quantity *</label>
                                <input type="text" class="form-control" name="receipt-qty" id="receipt-qty" value="<?php echo htmlspecialchars($stock_card['receipt_qty']) ?>">
                                <div class="mt-2 text-danger"> <?php echo $errors['receipt-qty'] ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="insertIssueQty" class="form-label">Issue Quantity *</label>
                                <input type="text" class="form-control" name="issue-qty" id="issue-qty" value="<?php echo htmlspecialchars($stock_card['issue_qty']) ?>">
                                <div class="mt-2 text-danger"> <?php echo $errors['issue-qty'] ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="selectOffice" class="form-label">Issue Office *</label>
                                <select class="form-select custom-select form-control form-control" aria-label="selectOffice" name="selectOffice">
                                    <?php 
                                    foreach ($offices as $office) {
                                    ?>
                                        <option value="<?php echo htmlspecialchars($office['office_id']) ?>"><?php echo $office['office_name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="insertBalanceQty" class="form-label">Balance Quantity *</label>
                                <input type="text" class="form-control" name="balance-qty" id="balance-qty" value="<?php echo htmlspecialchars($stock_card['balance_qty']) ?>">
                                <div class="mt-2 text-danger"> <?php echo $errors['balance-qty'] ?></div>
                            </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="stock-cards.php">Cancel</a>
                                    <form action="edit-stock-card.php" method="POST" class="mr-1">
                                        <input type="hidden" name="card_to_update" value="<?php echo $stock_card['card_no'] ?>">
                                        <input type="hidden" name="stock_to_update" value="<?php echo $stock_card['stock_id'] ?>">
                                        <input type="submit" name="update" value="Update" class="btn btn-success">
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of Edit Stock Item Form-->

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
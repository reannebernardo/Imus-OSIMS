<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM purchase_order WHERE po_no = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: purchase-orders.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['po_no'])){
        
        // Escape SQL characters
        $po_no = mysqli_real_escape_string($conn, $_GET['po_no']);
        // Make SQL
        $sql = "SELECT * FROM purchase_order WHERE po_no = $po_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $purchase_order = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all purchase orders
    $sql = 'SELECT * FROM purchase_order ORDER BY po_no';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $purchase_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Orders</h1>
                    <p class="mb-4">The PO is a form/document used by the agency/entity, addressed to a supplier, to deliver specific quantities of supplies/goods/pooperty subject to the terms and conditions contained in the PO.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-poimary">DataTables Example</h6> -->
                            <a href="create-po.php" class="btn btn-success" role="button">Create Purchase Order</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>PO No.</th>
                                            <th>PO Date</th>
                                            <th>PR No.</th>
                                            <th>LGU</th>
                                            <th>Stock Card</th>
                                            <th>Supplier</th>
                                            <th>Mode of Payment</th>
                                            <th>Place of Delivery</th>
                                            <th>Date of Delivery</th>
                                            <th>Payment Term</th>
                                            <th>Amount</th>
                                            <th>Date Approved</th>
                                            <th>Date Requested</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($purchase_orders as $purchase_order) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['po_no']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['po_date']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['pr_no']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $lgu_id = htmlspecialchars($purchase_order['lgu_id']);
                                                        $sql = "SELECT lgu_name FROM lgu WHERE lgu_id = $lgu_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $lgu_names = mysqli_fetch_assoc($result);
                                                        foreach($lgu_names as $lgu_name) {
                                                            echo $lgu_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['card_no']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $supplier_id = htmlspecialchars($purchase_order['supplier_id']);
                                                        $sql = "SELECT supplier_name FROM supplier WHERE supplier_id = $supplier_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $supplier_names = mysqli_fetch_assoc($result);
                                                        foreach($supplier_names as $supplier_name) {
                                                            echo $supplier_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $mode_id = htmlspecialchars($purchase_order['mode_of_payment']);
                                                        $sql = "SELECT mode_name FROM procurement_mode WHERE mode_id = $mode_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $mode_names = mysqli_fetch_assoc($result);
                                                        foreach($mode_names as $mode_name) {
                                                            echo $mode_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $wr_code = htmlspecialchars($purchase_order['place_of_delivery']);
                                                        $sql = "SELECT wr_name FROM warehouse WHERE wr_code = $wr_code";
                                                        $result = mysqli_query($conn, $sql);
                                                        $warehouse_names = mysqli_fetch_assoc($result);
                                                        foreach($warehouse_names as $warehouse_name) {
                                                            echo $warehouse_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['date_of_delivery']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $payment_id = htmlspecialchars($purchase_order['payment_term']);
                                                        $sql = "SELECT payment_name FROM payment_term WHERE payment_id = $payment_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $payment_names = mysqli_fetch_assoc($result);
                                                        foreach($payment_names as $payment_name) {
                                                            echo $payment_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['amount']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['date_approved']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_order['date_requested']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-po.php?po_no=<?php echo $purchase_order['po_no'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="purchase-orders.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $purchase_order['po_no'] ?>">
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
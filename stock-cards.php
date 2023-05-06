<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM stock_card WHERE card_no = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: stock-cards.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['card_no'])){
        
        // Escape SQL characters
        $pr_no = mysqli_real_escape_string($conn, $_GET['card_no']);
        // Make SQL
        $sql = "SELECT * FROM stock_card WHERE card_no = $pr_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $stock_card = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all stock cards
    $sql = 'SELECT * FROM stock_card ORDER BY card_no';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $stock_cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
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
                    <h1 class="h3 mb-2 text-gray-800">Stock Cards</h1>
                    <p class="mb-4">The SC is a form used in the <b>Supply and/or Property Division/Unit</b> for each type of supplies to record all receipts and issues made. It shall be maintained by fund cluster.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                            <a href="create-stock-card.php" class="btn btn-success" role="button">Create Stock Card</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Card No.</th>
                                            <th>LGU</th>
                                            <th>Stock ID</th>
                                            <th>Stock Item</th>
                                            <th>Stock Description</th>
                                            <th>Unit of Measurement</th>
                                            <th>Re-order Point</th>
                                            <th>Stock Date</th>
                                            <th>Receipt Qty.</th>
                                            <th>Issue Qty</th>
                                            <th>Issue Office</th>
                                            <th>Balance Qty</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($stock_cards as $stock_card) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['card_no']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $lgu_id = htmlspecialchars($stock_card['lgu_id']);
                                                        $sql = "SELECT lgu_name FROM lgu WHERE lgu_id = $lgu_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $lgu_names = mysqli_fetch_assoc($result);
                                                        foreach($lgu_names as $lgu_name) {
                                                            echo $lgu_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['stock_id'])?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $stock_id = htmlspecialchars($stock_card['stock_id']);
                                                        $sql = "SELECT stock_name FROM stock_item WHERE stock_id = $stock_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $stock_names = mysqli_fetch_assoc($result);
                                                        foreach($stock_names as $stock_name) {
                                                            echo $stock_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $stock_id = htmlspecialchars($stock_card['stock_id']);
                                                        $sql = "SELECT stock_desc FROM stock_item WHERE stock_id = $stock_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $stock_descs = mysqli_fetch_assoc($result);
                                                        foreach($stock_descs as $stock_desc) {
                                                            echo $stock_desc;
                                                        }
                                                    ?>                                                
                                                </td>
                                                <td>
                                                    <?php 
                                                        $stock_id = htmlspecialchars($stock_card['stock_id']);
                                                        $sql = "SELECT stock_unit FROM stock_item WHERE stock_id = $stock_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $stock_units = mysqli_fetch_assoc($result);
                                                        foreach($stock_units as $stock_unit) {
                                                            echo $stock_unit;
                                                        }
                                                    ?>                                                 
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['reorder_point']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['stock_date']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['receipt_qty']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['issue_qty']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $issue_office = htmlspecialchars($stock_card['issue_office']);
                                                        $sql = "SELECT office_name FROM office WHERE office_id = $issue_office";
                                                        $result = mysqli_query($conn, $sql);
                                                        $issue_offices = mysqli_fetch_assoc($result);
                                                        foreach($issue_offices as $issue_office) {
                                                            echo $issue_office;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_card['balance_qty']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-stock-card.php?card_no=<?php echo $stock_card['card_no'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="stock-cards.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $stock_card['card_no'] ?>">
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

    <?php
        // // Free result from memory
        mysqli_free_result($result);

        // // Close DB connection
        mysqli_close($conn);
    ?>
    <?php include 'templates/scroll-to-top.php'?>
    <?php require 'templates/logout-modal.php'?>
    <?php require 'templates/plugins.php'?>

</body>

</html>
<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM stock_item WHERE stock_id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: stock-items.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['stock_id'])){
        
        // Escape SQL characters
        $stock_id = mysqli_real_escape_string($conn, $_GET['stock_id']);
        // Make SQL
        $sql = "SELECT * FROM stock_item WHERE stock_id = $stock_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $stock_item = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all stock_items
    $sql = 'SELECT * FROM stock_item ORDER BY stock_id';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $stock_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result from memory
    mysqli_free_result($result);

    // Close DB connection
    mysqli_close($conn);

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
                    <h1 class="h3 mb-2 text-gray-800">Stock Items</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                            <a href="add-stock-item.php" class="btn btn-success">Add Stock Item</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>SKU</th>
                                            <th>Stock Name</th>
                                            <th>Unit</th>
                                            <th>Description</th>
                                            <th>Stock Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Total Cost</th>
                                            <th>Date Encoded</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach($stock_items as $stock_item) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_id']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_sku']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_name']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_unit']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_desc']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['stock_qty']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['unit_cost']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['total_cost']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($stock_item['date_encoded']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-stock-item.php?stock_id=<?php echo $stock_item['stock_id'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="stock-items.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $stock_item['stock_id'] ?>">
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
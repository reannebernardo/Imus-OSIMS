<?php

    include 'config/db_connect.php';

    // Write query for all suppliers
    $sql = 'SELECT * FROM supplier ORDER BY supplier_id';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Suppliers</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                            <a href="add-supplier.php" class="btn btn-success">Add Supplier</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>TIN</th>
                                            <th>Products</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach($suppliers as $supplier) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($supplier['supplier_id']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($supplier['supplier_name']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($supplier['supplier_address']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($supplier['supplier_tin']) ?>
                                                </td>
                                                <td>
                                                    
                                                    <ul class="list-unstyled">
                                                        <?php foreach(explode(',', $supplier['supplier_prod']) as $product ) : ?>
                                                            <li> <?php echo htmlspecialchars($product) ?> </li>

                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                            
                                                <td>
                                                    <button type="button" class="btn btn-warning">Edit</button>
                                                    <button type="button" class="btn btn-danger">Delete</button>
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
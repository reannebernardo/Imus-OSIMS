<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM warehouse WHERE wr_code = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: warehouses.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['wr_code'])){
        
        // Escape SQL characters
        $wr_code = mysqli_real_escape_string($conn, $_GET['wr_code']);
        // Make SQL
        $sql = "SELECT * FROM warehouse WHERE wr_code = $wr_code";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $warehouse = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all suppliers
    $sql = 'SELECT * FROM warehouse ORDER BY wr_code';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $warehouses = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Warehouses</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                            <a href="add-warehouse.php" class="btn btn-success" role="button">Add Warehouse</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Warehouse Name</th>
                                            <th>Address</th>
                                            <th>Remaining Capacity</th>
                                            <th>Manager Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($warehouses as $warehouse) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_code']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_name']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_address']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_remaining_capacity']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_manager']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_phone']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($warehouse['wr_email']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-warehouse.php?wr_code=<?php echo $warehouse['wr_code'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="warehouses.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $warehouse['wr_code'] ?>">
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
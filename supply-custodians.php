<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM supply_custodian WHERE sc_id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: supply-custodians.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['sc_id'])){
        
        // Escape SQL characters
        $sc_id = mysqli_real_escape_string($conn, $_GET['sc_id']);
        // Make SQL
        $sql = "SELECT * FROM sc WHERE sc_id = $sc_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $sc = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all scs
    $sql = 'SELECT * FROM supply_custodian ORDER BY sc_id';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $scs = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Supply Custodians</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form class="d-none d-sm-inline-block form-inline mr-2 my-2 my-md-0 navbar-search" action="purchase-requests.php" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Search" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                            
                            <a href="add-sc.php" class="btn btn-success" role="button">Add Supply Custodian</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>LGU</th>
                                            <th>Office</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($scs as $sc) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($sc['sc_id']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($sc['sc_name']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $lgu_id = htmlspecialchars($sc['lgu_id']);
                                                        $sql = "SELECT lgu_name FROM lgu WHERE lgu_id = $lgu_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $lgu_names = mysqli_fetch_assoc($result);
                                                        foreach($lgu_names as $lgu_name) {
                                                            echo $lgu_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $office_id = htmlspecialchars($sc['office_id']);
                                                        $sql = "SELECT office_name FROM office WHERE office_id = $office_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $office_names = mysqli_fetch_assoc($result);
                                                        foreach($office_names as $office_name) {
                                                            echo $office_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-sc.php?sc_id=<?php echo $sc['sc_id'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="supply-custodians.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $sc['sc_id'] ?>">
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
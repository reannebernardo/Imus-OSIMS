<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM ris WHERE ris_no = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: ris.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['ris_no'])){
        
        // Escape SQL characters
        $ris_no = mysqli_real_escape_string($conn, $_GET['ris_no']);
        // Make SQL
        $sql = "SELECT * FROM ris WHERE ris_no = $ris_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $ris = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all purchase orders
    $sql = 'SELECT * FROM ris ORDER BY ris_no';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $riss = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Requisition and Issuance</h1>
                    <p class="mb-4">The RIS shall be used by the <b>Requisitioning Division/Office</b> to request supplies/goods/ equipment/property carried in stock and by the <b>Supply and/or Property Division/Unit</b> to issue the item/s requested.</p>

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
                            
                            <a href="create-ris.php" class="btn btn-success" role="button">Create RIS</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>RIS No.</th>
                                            <th>LGU</th>
                                            <th>Office</th>
                                            <th>Date</th>
                                            <th>Stock No.</th>
                                            <th>Issuance Quantity</th>
                                            <th>Issuance Remarks</th>
                                            <th>Purpose</th>
                                            <th>Requested By</th>
                                            <th>Approved By</th>
                                            <th>Issued By</th>
                                            <th>Received By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($riss as $ris) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_no']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $lgu_id = htmlspecialchars($ris['lgu_id']);
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
                                                        $office_id = htmlspecialchars($ris['office_id']);
                                                        $sql = "SELECT office_name FROM office WHERE office_id = $office_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $office_names = mysqli_fetch_assoc($result);
                                                        foreach($office_names as $office_name) {
                                                            echo $office_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_date']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['card_no']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['issuance_quantity']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['issuance_remarks']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_purpose']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_requested_by']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_approved_by']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_issued_by']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($ris['ris_received_by']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-ris.php?ris_no=<?php echo $ris['ris_no'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="ris.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $ris['ris_no'] ?>">
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
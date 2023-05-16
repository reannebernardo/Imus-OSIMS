<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete']) ) {
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE purchase_request, requested_item FROM purchase_request 
                INNER JOIN requested_item
                ON purchase_request.pr_no = requested_item.item_id
                WHERE purchase_request.item_id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: purchase-requests.php');
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['pr_no'])){
        
        // Escape SQL characters
        $pr_no = mysqli_real_escape_string($conn, $_GET['pr_no']);
        // Make SQL
        $sql = "SELECT * FROM purchase_request WHERE pr_no = $pr_no";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $purchase_request = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    if(isset($_GET['item_id'])){
        
        // Escape SQL characters
        $item_id = mysqli_real_escape_string($conn, $_GET['item_id']);
        // Make SQL
        $sql = "SELECT * FROM requested_item WHERE item_id = $item_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $requested_item = mysqli_fetch_assoc($result);
        // Free result from memory
        mysqli_free_result($result);
        // Close DB connection
        mysqli_close($conn);
    }

    // Write query for all purchase requests
    $sql = 'SELECT * FROM purchase_request ORDER BY pr_no';

    // Make the query and get results
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $purchase_requests = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Requests</h1>
                    <p class="mb-4">The PR is a form used by the <b>Supply and/or Property Custodian</b> for purchasing goods/supplies/property if the item/s requested is/are not available on stock.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">                            
                            <form class="d-none d-sm-inline-block form-inline mr-2 my-2 my-md-0 navbar-search" action="livesearch.php" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-white border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Search" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                            
                            <a href="create-pr.php" class="btn btn-success" role="button">Create Purchase Request</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <div id="searchresult"></div>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>PR No.</th>
                                            <th>PR Date</th>
                                            <th>LGU</th>
                                            <th>Office</th>
                                            <th>Items</th>
                                            <th>Purpose</th>
                                            <th>Requested By</th>
                                            <th>Approved By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($purchase_requests as $purchase_request) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_request['pr_no']) ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_request['pr_date']) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $lgu_id = htmlspecialchars($purchase_request['lgu_id']);
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
                                                        $office_id = htmlspecialchars($purchase_request['office_id']);
                                                        $sql = "SELECT office_name FROM office WHERE office_id = $office_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $office_names = mysqli_fetch_assoc($result);
                                                        foreach($office_names as $office_name) {
                                                            echo $office_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $item_id = htmlspecialchars($purchase_request['item_id']);
                                                        $sql = "SELECT item_name FROM requested_item WHERE item_id = $item_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $item_names = mysqli_fetch_assoc($result);
                                                        foreach($item_names as $item_name) {
                                                            echo $item_name;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_request['pr_purpose']) ?>
                                                </td>
                                                <td>
                                                    <?php echo $user ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($purchase_request['approved_by']) ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex w-100">
                                                        <a href="edit-pr.php?item_id=<?php echo $purchase_request['item_id'] ?>&pr_no=<?php echo $purchase_request['pr_no'] ?>" class="btn btn-warning">Edit</a>
                                                        <form action="purchase-requests.php" method="POST" class="ml-1">
                                                            <input type="hidden" name="id_to_delete" value="<?php echo $purchase_request['item_id'] ?>">
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
    
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $("#live_search").keyup(function(){

                var input = $(this).val();
                // alert(input);

                if(input != ""){
                    $.ajax({
                        url: "livesearch.php",
                        method: "POST",
                        data:{input:input},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    });
                } else {
                    $("#searchresult").css("display", "none");
                }
            });
        });
    </script> -->
</body>

</html>
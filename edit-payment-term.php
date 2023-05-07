<?php

    include 'config/db_connect.php';

    // Check GET request ID parameter
    if(isset($_GET['payment_id']) ) {
        
        // Escape SQL characters
        $payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);
        // Make SQL
        $sql = "SELECT * FROM payment_term WHERE payment_id = $payment_id";
        // Get the query result
        $result = mysqli_query($conn, $sql);
        // Fetch result in array format
        $payment = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        
    }

    $errors = array('payment-name' => '');

    // POST check
    if(isset($_POST['update'] ) ) {

        // Check Payment Term Name
        if(empty($_POST['payment-name']) ) {
            $errors['payment-name'] = 'A name is required. <br />';
        } else {
            $payment_name = $_POST['payment-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $payment_name = mysqli_real_escape_string($conn, $_POST['payment-name']);

            $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);

            $sql = "UPDATE payment_term
                    SET payment_name = '$payment_name'
                    WHERE payment_id = $id_to_update";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: payment-terms.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Payment Terms</h1>
                    <p class="mb-4"></p>

                    <!-- Edit Payment Term Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Payment Term</h6>
                        </div>
                        <div class="card-body">
                            <?php if($payment): ?>
                                <form class="needs-validation" action="edit-payment-term.php" method="POST">
                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Payment Term Name *</label>
                                        <input type="text" class="form-control" name="payment-name" id="payment-name" value="<?php echo htmlspecialchars($payment['payment_name']) ?>">
                                        <div class="mt-2 text-danger"> <?php echo $errors['payment-name'] ?></div>
                                    </div>
                                    
                                    <hr class="hr" />

                                    <div class="mb-3">
                                        <a class="btn btn-secondary" href="payment-terms.php">Cancel</a>
                                        <form action="edit-payment-term.php" method="POST" class="mr-1">
                                            <input type="hidden" name="id_to_update" value="<?php echo $payment['payment_id'] ?>">
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </form>
                                    </div>
                                </form>
                            <?php else: ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- End of Edit Payment Term Form-->

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
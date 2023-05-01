<?php

    include 'config/db_connect.php';
    
    $sc_name = '';
    $errors = array('sc-name' => '');

    $sqlLgu ="SELECT lgu_id, lgu_name FROM lgu";
    $resultLgu = mysqli_query($conn, $sqlLgu);
    if($resultLgu->num_rows> 0){
        $lgus= mysqli_fetch_all($resultLgu, MYSQLI_ASSOC);
    }

    $sqlOffice ="SELECT office_id, office_name FROM office";
    $resultOffice = mysqli_query($conn, $sqlOffice);
    if($resultOffice->num_rows> 0){
        $offices= mysqli_fetch_all($resultOffice, MYSQLI_ASSOC);
    }

    // POST check
    if(isset($_POST['submit'] ) ) {
        
        // Check SC Name
        if(empty($_POST['sc-name']) ) {
            $errors['sc-name'] = 'A name is required. <br />';
        } else {
            $sc_name = $_POST['sc-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $sc_name = mysqli_real_escape_string($conn, $_POST['sc-name']);
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);
            $office_id = mysqli_real_escape_string($conn, $_POST['selectOffice']);

            // Create SQL
            $sql = "INSERT INTO supply_custodian(sc_name, lgu_id, office_id) 
                    VALUES('$sc_name', '$lgu_id', '$office_id')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: supply-custodians.php');
                exit;
            } else {
                echo 'query error: ' . mysqli_error($conn);
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
                    <h1 class="h3 mb-2 text-gray-800">Supply Custodians</h1>
                    <p class="mb-4"></p>

                    <!-- Add LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Supply Custodian</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-sc.php" method="POST">

                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                        <?php 
                                        foreach ($lgus as $lgu) {
                                        ?>
                                            <option value="<?php echo $lgu['lgu_id']?>"><?php echo $lgu['lgu_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Office</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice" name="selectOffice">
                                        <?php 
                                        foreach ($offices as $office) {
                                        ?>
                                            <option value="<?php echo $office['office_id']?>"><?php echo $office['office_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="insertLGUName" class="form-label">Supply Custodian Name *</label>
                                    <input type="text" class="form-control" name="sc-name" id="sc-name" value="<?php echo $sc_name ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['sc-name'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="scs.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Add LGU Form-->

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
<?php

    include 'config/db_connect.php';
    
    $lgu_name = '';
    $errors = array('lgu-name' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {
        // Check LGU Name
        if(empty($_POST['lgu-name']) ) {
            $errors['lgu-name'] = 'An LGU name is required. <br />';
        } else {
            $lgu_name = $_POST['lgu-name'];
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $lgu_name = mysqli_real_escape_string($conn, $_POST['lgu-name']);

            // Create SQL
            $sql = "INSERT INTO lgu(lgu_name) 
                    VALUES('$lgu_name')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: lgus.php');
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
                    <h1 class="h3 mb-2 text-gray-800">LGUs</h1>
                    <p class="mb-4"></p>

                    <!-- Add LGU Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add LGU</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-lgu.php" method="POST">

                                <div class="mb-3">
                                    <label for="insertLGUName" class="form-label">LGU Name *</label>
                                    <input type="text" class="form-control" name="lgu-name" id="lgu-name" value="<?php echo $lgu_name ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['lgu-name'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="lgu.php">Cancel</a>
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
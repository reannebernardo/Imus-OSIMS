<?php

    if(isset($_POST['submit'])){
        echo $_POST['company-name'];
        echo $_POST['address'];
        echo $_POST['tin'];
        echo $_POST['products'];
    }
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

                    <!-- Add Supplier Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Supplier</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="add-supplier.php" method="POST">

                                <div class="mb-3">
                                    <label for="inputCompanyName" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company-name" id="company-name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputTIN" class="form-label">TIN</label>
                                    <input type="text" class="form-control" name="tin" id="tin" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProducts" class="form-label">Products</label>
                                    <input type="text" class="form-control" name="products" id="products" required>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="suppliers.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
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
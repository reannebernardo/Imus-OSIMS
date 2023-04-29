<?php

    include 'config/db_connect.php';
    
    $supplierName = $address = $tin = $products = $industry = $appointed_date = '';
    $errors = array('supplier-name' => '', 'address' => '', 'tin' => '', 'products' => '', 'industry' => '', 'appointed-date' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {
        // Check Supplier Name
        if(empty($_POST['supplier-name']) ) {
            $errors['supplier-name'] = 'A supplier name is required. <br />';
        } else {
            $supplierName = $_POST['supplier-name'];
        }

        // Check Address
        if(empty($_POST['address']) ) {
            $errors['address'] = 'An address is required. <br />';
        } else {
            $address = $_POST['address'];
        }

        // Check TIN Number
        if(empty($_POST['tin']) ) {
            $errors['tin'] = 'A TIN number is required. <br />';
        } else {
            $tin = $_POST['tin'];
            // if (!preg_match('^(\d{9}|\d{12})$^', $tin) ) {
            //     $errors['tin'] = 'A TIN number is should be at least 9 digits and no more than 12 digits.';
            // }
        }

        // Check Products
        if(empty($_POST['products']) ) {
            $errors['products'] = 'At least one product is required. <br />';
        } else {
            $products = $_POST['products'];
            // if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $products) ) {
            //     $errors['products'] = 'Products must be a comma separated list.';
            // }
        }

        // Check Industry
        if(empty($_POST['industry']) ) {
            $errors['industry'] = 'An industry is required. <br />';
        } else {
            $industry = $_POST['industry'];
        }

        // Check Appointed Date
        if(empty($_POST['appointed-date']) ) {
            $errors['appointed-date'] = 'A date is required. <br />';
        } else {
            $products = $_POST['appointed-date'];
            // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            //     $errors['appointed-date'] = 'Date format is invalid. <br />';
            // } else {
            //     $appointed_date = $_POST['appointed-date'];
            // }
        }

        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $supplierName = mysqli_real_escape_string($conn, $_POST['supplier-name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $tin = mysqli_real_escape_string($conn, $_POST['tin']);
            $products = mysqli_real_escape_string($conn, $_POST['products']);
            $industry = mysqli_real_escape_string($conn, $_POST['industry']);
            $appointed_date = mysqli_real_escape_string($conn, $_POST['appointed-date']);

            // Create SQL
            $sql = "INSERT INTO supplier(supplier_name, supplier_address, supplier_tin, supplier_products, supplier_industry, appointed_date) 
                    VALUES('$supplierName', '$address', '$tin', '$products', '$industry', '$appointed_date')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: suppliers.php');
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
                                    <label for="inputsupplierName" class="form-label">Supplier Name *</label>
                                    <input type="text" class="form-control" name="supplier-name" id="supplier-name" value="<?php echo $supplierName ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['supplier-name'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Address *</label>
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['address'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputTIN" class="form-label">TIN Number *</label>
                                    <input type="text" class="form-control" name="tin" id="tin" value="<?php echo $tin ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['tin'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProducts" class="form-label">Products <i> (comma separated) </i>*</label>
                                    <input type="text" class="form-control" name="products" id="products" value="<?php echo $products ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['products'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputIndustry" class="form-label">Industry *</label>
                                    <input type="text" class="form-control" name="industry" id="industry" value="<?php echo $industry ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['industry'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAppointedDate" class="form-label">Appointed Date <i> (Format: YYYY-MM-DD) </i>*</label>
                                    <input type="text" class="form-control" name="appointed-date" id="appointed-date" value="<?php echo $products ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['appointed-date'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="suppliers.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End of Add Supplier Form-->

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
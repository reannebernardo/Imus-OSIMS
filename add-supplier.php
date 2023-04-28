<?php

    $companyName = $address = $tin = $products = '';
    $errors = array('company-name' => '', 'address' => '', 'tin' => '', 'products' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {
        // Check Company Name
        if(empty($_POST['company-name']) ) {
            $errors['company-name'] = 'A company name is required. <br />';
        } else {
            // echo htmlspecialchars($_POST['company-name']);
            $companyName = $_POST['company-name'];
        }

        // Check Address
        if(empty($_POST['address']) ) {
            $errors['address'] = 'An address is required. <br />';
        } else {
            // echo htmlspecialchars($_POST['address']);
            $address = $_POST['address'];
        }

        // Check TIN Number
        if(empty($_POST['tin']) ) {
            $errors['tin'] = 'A TIN number is required. <br />';
        } else {
            // echo htmlspecialchars($_POST['tin']);
            $tin = $_POST['tin'];
            if (!preg_match('^(\d{9}|\d{12})$^', $tin) ) {
                $errors['tin'] = 'A TIN number is should be at least 9 digits and no more than 12 digits.';
            }
        }

        // Check Products
        if(empty($_POST['products']) ) {
            $errors['products'] = 'At least one product is required. <br />';
        } else {
            // echo htmlspecialchars($_POST['product']);
            $products = $_POST['products'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $products) ) {
                $errors['products'] = 'Products must be a comma separated list.';
            }
        }

        // Page Redirect
        if(! array_filter($errors) ) {
            header('Location: suppliers.php');
            exit;
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
                                    <label for="inputCompanyName" class="form-label">Company Name *</label>
                                    <input type="text" class="form-control" name="company-name" id="company-name" value="<?php echo $companyName ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['company-name'] ?></div>
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
                                    <label for="inputProducts" class="form-label">Products (comma separated) *</label>
                                    <input type="text" class="form-control" name="products" id="products" value="<?php echo $products ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['products'] ?></div>
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
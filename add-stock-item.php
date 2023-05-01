<?php

    include 'config/db_connect.php';
    
    $stock_sku = $stock_name = $stock_unit = $stock_desc = $stock_qty = $unit_cost = '';
    $errors = array('stock-sku' => '', 'stock-name' => '', 'stock-unit' => '', 'stock-desc' => '', 'stock-qty' => '', 'unit-cost' => '');

    // POST check
    if(isset($_POST['submit'] ) ) {

        // Check Stock SKU
        if(empty($_POST['stock-sku']) ) {
            $errors['stock-sku'] = 'An SKU is required. <br />';
        } else {
            $stock_sku = $_POST['stock-sku'];
        }

        // Check Stock Name
        if(empty($_POST['stock-name']) ) {
            $errors['stock-name'] = 'A name is required. <br />';
        } else {
            $stock_name = $_POST['stock-name'];
        }

        // Check Stock Unit
        if(empty($_POST['stock-unit']) ) {
            $errors['stock-unit'] = 'A unit is required. <br />';
        } else {
            $stock_unit = $_POST['stock-unit'];
        }

        // Check Stock Desc
        if(empty($_POST['stock-desc']) ) {
            $errors['stock-desc'] = 'A description is required. <br />';
        } else {
            $stock_desc = $_POST['stock-desc'];
        }

        // Check Stock Qty
        if(empty($_POST['stock-qty']) ) {
            $errors['stock-qty'] = 'A quantity is required. <br />';
        } else {
            $stock_qty = $_POST['stock-qty'];
        }

        // Check Unit Cost
        if(empty($_POST['unit-cost']) ) {
            $errors['unit-cost'] = 'A unit cost is required. <br />';
        } else {
            $unit_cost = $_POST['unit-cost'];
        }


        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to prevent sql injection
            $stock_sku = mysqli_real_escape_string($conn, $_POST['stock-sku']);
            $stock_name = mysqli_real_escape_string($conn, $_POST['stock-name']);
            $stock_unit = mysqli_real_escape_string($conn, $_POST['stock-unit']);
            $stock_desc = mysqli_real_escape_string($conn, $_POST['stock-desc']);
            $stock_qty = mysqli_real_escape_string($conn, $_POST['stock-qty']);
            $unit_cost = mysqli_real_escape_string($conn, $_POST['unit-cost']);

            $total_cost = $stock_qty * $unit_cost;
            // Create SQL
            $sql = "INSERT INTO stock_item(stock_sku, stock_name, stock_unit, stock_desc, stock_qty, unit_cost, total_cost) 
                    VALUES('$stock_sku', '$stock_name', '$stock_unit', '$stock_desc', '$stock_qty', '$unit_cost', '$total_cost')";

            // Save to DB and check
            if(mysqli_query($conn, $sql) ) {
                header('Location: stock-items.php');
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
                            <form class="needs-validation" action="add-stock-item.php" method="POST">

                                <div class="mb-3">
                                    <label for="inputStockSKU" class="form-label">Stock SKU *</label>
                                    <input type="text" class="form-control" name="stock-sku" id="stock-sku" value="<?php echo $stock_sku ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['stock-sku'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputStockName" class="form-label">Stock Name *</label>
                                    <input type="text" class="form-control" name="stock-name" id="stock-name" value="<?php echo $stock_name ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['stock-name'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputStockUnit" class="form-label">Stock Unit *</label>
                                    <input type="text" class="form-control" name="stock-unit" id="stock-unit" value="<?php echo $stock_unit ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['stock-unit'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputStockDesc" class="form-label">Stock Description *</label>
                                    <input type="text" class="form-control" name="stock-desc" id="stock-desc" value="<?php echo $stock_desc ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['stock-desc'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputStockQty" class="form-label">Stock Quantity *</label>
                                    <input type="text" class="form-control" name="stock-qty" id="stock-qty" value="<?php echo $stock_qty ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['stock-qty'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputUnitCost" class="form-label">Stock Unit Cost *</label>
                                    <input type="text" class="form-control" name="unit-cost" id="unit-cost" value="<?php echo $unit_cost ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['unit-cost'] ?></div>
                                </div>
                                
                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="stock-items.php">Cancel</a>
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
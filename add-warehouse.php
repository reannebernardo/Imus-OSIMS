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
                    <h1 class="h3 mb-2 text-gray-800">Warehouses</h1>
                    <p class="mb-4"></p>

                    <!-- Add Warehouse Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Warehouse</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation">

                                <legend>WAREHOUSE</legend>

                                <div class="mb-3">
                                    <label for="inputName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputRemainingCap" class="form-label">Remaining Capacity</label>
                                    <input type="text" class="form-control" id="inputRemainingCap" required>
                                </div>
                                
                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>MANAGER</legend>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">First Name</span>
                                    <input type="text" aria-label="First Name" class="form-control">
                                    <span class="input-group-text">Last Name</span>
                                    <input type="text" aria-label="Last Name" class="form-control">
                                  </div>

                                <div class="mb-3">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="inputPhone" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" required>
                                </div>


                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="warehouses.php">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
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
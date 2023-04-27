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

                    <!-- Create RIS Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create RIS</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation">

                                <legend>INFORMATION</legend>

                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" required>
                                        <option selected>Select LGU</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Office</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice" required>
                                        <option selected>Select Office</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>REQUISITION</legend>

                                <div class="mb-3">
                                    <label for="inputStockNo" class="form-label">Stock No.</label>
                                    <input type="text" class="form-control" id="inputStockNo" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputUnit" class="form-label">Unit</label>
                                    <input type="text" class="form-control" id="inputUnit" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDescription" class="form-label">Item Description</label>
                                    <input type="text" class="form-control" id="inputDescription" required>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>ISSUANCE</legend>

                                <div class="mb-3">
                                    <label for="inputQuantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" id="inputQuantity" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputRemarks" class="form-label">Remarks</label>
                                    <textarea type="text" class="form-control" id="inputUnitCost" required></textarea>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="ris.php">Cancel</a>
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
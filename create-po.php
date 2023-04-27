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
                    <h1 class="h3 mb-2 text-gray-800">Purchase Order</h1>
                    <p class="mb-4">The PO is a form/document used by the agency/entity, addressed to a supplier, to deliver specific quantities of supplies/goods/property subject to the terms and conditions contained in the PO.</p>

                    <!-- Create PO Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Purchase Order</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation">

                                <legend>INFORMATION</legend>

                                <div class="mb-3">
                                    <label for="selectSupplier" class="form-label">Supplier</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectSupplier" required>
                                        <option selected>Select Supplier</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectMOP" class="form-label">Mode of Procurement</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectMOP" required>
                                        <option selected>Select Mode of Procurement</option>
                                        <option value="1">Procurement Service</option>
                                        <option value="3">Limited Source Bidding</option>
                                        <option value="3">Direct Contracting</option>
                                        <option value="3">Negotiated Procurement</option>
                                        <option value="3">Repeat Order</option>
                                        <option value="2">Shopping</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inputPRNos" class="form-label">PR No./s</label>
                                    <input type="text" class="form-control" id="inputPRNos" required>
                                </div>
                                
                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>DELIVERY</legend>

                                <div class="mb-3">
                                    <label for="inputPlaceOfDelivery" class="form-label">Place of Delivery</label>
                                    <input type="text" class="form-control" id="inputPlaceOfDelivery" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDateOfDelivery" class="form-label">Date of Delivery</label>
                                    <input type="date" class="form-control" id="inputDateOfDelivery" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDeliveryTerm" class="form-label">Delivery Term</label>
                                    <input type="text" class="form-control" id="inputDeliveryTerm" required>
                                </div>

                                <div class="mb-3">
                                    <label for="selectPT" class="form-label">Payment Term</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectPT" required>
                                        <option selected>Select Payment Term</option>
                                        <option value="1">FOB shipping point</option>
                                        <option value="2">FOB destination</option>
                                    </select>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>ITEM</legend>

                                <div class="mb-3">
                                    <label for="inputUnit" class="form-label">Unit</label>
                                    <input type="text" class="form-control" id="inputUnit" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDescription" class="form-label">Item Description</label>
                                    <textarea type="text" class="form-control" id="inputDescription" required></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputQuantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" id="inputQuantity" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputUnitCost" class="form-label">Unit Cost</label>
                                    <input type="text" class="form-control" id="inputUnitCost" required>
                                </div>
                                <fieldset disabled>
                                    <div class="mb-3">
                                        <label for="inputTotalCost" class="form-label">Amount</label>
                                        <input type="text" class="form-control" id="inputTotalCost" required>
                                    </div>
                                </fieldset>

                                <a href="#" class="btn btn-primary" id="addItem">Add Another Item</a>

                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="purchase-orders.php">Cancel</a>
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
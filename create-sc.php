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
                    <h1 class="h3 mb-2 text-gray-800">Stock Cards</h1>
                    <p class="mb-4">The SC is a form used in the <b>Supply and/or Property Division/Unit</b> for each type of supplies to record all receipts and issues made. It shall be maintained by fund cluster.</p>
                    
                    <!-- Create PO Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Stock Card</h6>
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
                                    <label for="selectWarehouse" class="form-label">Warehouse</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectWarehouse" required>
                                        <option selected>Select Warehouse</option>
                                        <option value="1">1</option>
                                        <option value="3">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>ITEM</legend>

                                <div class="mb-3">
                                    <label for="inputItem" class="form-label">Item</label>
                                    <input type="text" class="form-control" id="inputItem" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputDescription" class="form-label">Item Description</label>
                                    <input type="text" class="form-control" id="inputDescription" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputUnit" class="form-label">Unit of Measurement</label>
                                    <input type="text" class="form-control" id="inputUnit" required>
                                </div>

                                <div class="mb-3">
                                    <label for="input" class="form-label">Re-order Point</label>
                                    <input type="text" class="form-control" id="inputUnit" required>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>RECEIPT</legend>

                                <div class="mb-3">
                                    <label for="inputReceiptQty" class="form-label">Receipt Quantity</label>
                                    <input type="text" class="form-control" id="inputReceiptQty" required>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>
                                
                                <legend>ISSUE</legend>

                                <div class="mb-3">
                                    <label for="inputIssueQty" class="form-label">Issue Qty</label>
                                    <input type="text" class="form-control" id="inputIssueQty" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputIssueOffice" class="form-label">Issue Office</label>
                                    <input type="text" class="form-control" id="inputIssueOffice" required>
                                </div>

                                <hr class="divider d-none d-sm-block"></hr>

                                <legend>BALANCE</legend>
                                
                                <div class="mb-3">
                                    <label for="inputBalanceQty" class="form-label">Balance Qty</label>
                                    <input type="text" class="form-control" id="inputBalanceQty" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputDaysToConsume" class="form-label">No. of Days to Consume</label>
                                    <input type="text" class="form-control" id="inputDaysToConsume" required>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="stock-cards.php">Cancel</a>
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
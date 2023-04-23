<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>City of Imus | SIMS</title>

    <link rel="icon" href="img/logo.ico"> 
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- DateTime Picker-->
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-  datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="purchase_requests.php">
                    <i class="fas fa-solid fa-file"></i>
                    <span>Purchase Requests</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="purchase_orders.php">
                    <i class="fas fa-solid fa-file"></i>
                    <span>Purchase Orders</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stock_cards.php">
                    <i class="fas fa-solid fa-box"></i>
                    <span>Stock Cards</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ris.php">
                    <i class="fas fa-solid fa-file"></i>
                    <span>Requisition and Issuance</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administration
            </div>

            <li class="nav-item">
                <a class="nav-link" href="suppliers.php">
                    <i class="fas fa-solid fa-truck"></i>
                    <span>Suppliers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="warehouses.php">
                    <i class="fas fa-solid fa-warehouse"></i>
                    <span>Warehouses</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                    <i class="fas fa-solid fa-chart-line"></i>
                    <span>Generate Report</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Users</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <h1 class="h2 mb-0 text-gray-800">Supply Inventory Management System</h1>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">User</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

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
                            <a class="btn btn-secondary" href="purchase_orders.php">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; City Government of Imus 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
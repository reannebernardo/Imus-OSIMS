<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="img/logo.png" alt="City of Imus Logo" width="50" height="50">
        </div>
        <!-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/logo.png" alt="..."> -->
        <!-- <div class="sidebar-brand-text mx-3">City of Imus</div> -->
    </a>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider my-0"> -->

    <!-- Heading -->
    <div class="sidebar-heading mt-3">
        Navigation
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-search"></i>
            <span>Search</span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="for-approval.php">
            <i class="fas fa-fw fa-check"></i>
            <span>For Approval <sup class="badge badge-pill badge-danger">2</sup></span></a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="purchase-requests.php">
            <i class="fas fa-solid fa-cart-plus"></i>
            <span>Purchase Requests</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="purchase-orders.php">
            <i class="fas fa-solid fa-cart-arrow-down"></i>
            <span>Purchase Orders</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="stock-cards.php">
            <i class="fas fa-solid fa-box"></i>
            <span>Stock Cards</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="ris.php">
            <i class="fas fa-solid fa-box-open"></i>
            <span>Requisition and Issuance</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administration
    </div>
        
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-solid fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <a class="collapse-item" href="lgus.php">
                    <i class="fas fa-solid fa-landmark"></i>
                    <span>LGUs</span>
                </a>
                <a class="collapse-item" href="offices.php">
                    <i class="fas fa-solid fa-building"></i>
                    <span>Offices</span></a>
                </a>
                <a class="collapse-item" href="stock-items.php">
                    <i class="fas fa-solid fa-truck"></i>
                    <span>Stock Items</span></a>
                </a>
                <a class="collapse-item" href="suppliers.php">
                    <i class="fas fa-solid fa-truck"></i>
                    <span>Suppliers</span></a>
                </a>
                <a class="collapse-item" href="warehouses.php">
                    <i class="fas fa-solid fa-warehouse"></i>
                    <span>Warehouses</span></a>
                </a>
                <a class="collapse-item" href="procurement-modes.php">
                    <i class="fas fa-solid fa-receipt"></i>
                    <span>Mode of Procurement</span></a>
                </a>
                <a class="collapse-item" href="payment-terms.php">
                    <i class="fas fa-solid fa-coins"></i>
                    <span>Payment Terms</span></a>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-solid fa-user"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <a class="collapse-item" href="supply-custodians.php">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Supply Custodians</span></a>
                </a>
                <a class="collapse-item" href="users.php">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Users</span></a>
                </a>
                <a class="collapse-item" href="user-roles.php">
                    <i class="fas fa-solid fa-users"></i>
                    <span>User Roles</span></a>
                </a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
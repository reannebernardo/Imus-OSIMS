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
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4"></p>

                    <!-- Add User Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation">

                                <div class="mb-3">
                                    <label for="inputName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" required>
                                </div>

                                <div class="mb-3">
                                    <label for="selectRole" class="form-label">Role</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectRole" required>
                                        <option selected>Select Role</option>
                                        <option value="1">Supply Custodian</option>
                                        <option value="3">Supply Division Approver</option>
                                        <option value="3">Supplier</option>
                                        <option value="3">Supply Division</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="users.php">Cancel</a>
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

    <?php include 'templates/scroll-to-top.php'?>
    <?php require 'templates/logout-modal.php'?>
    <?php require 'templates/plugins.php'?>

</body>

</html>
<?php

    include 'config/db_connect.php';
    
    $card_no = $issuance_quantity = $issuance_remarks = $ris_purpose = $ris_requested_by = $ris_approved_by = $ris_issued_by = $ris_received_by ='';
    $errors = array('card-no' => '', 'issuance-quantity' => '', 'issuance-remarks' => '', 'ris-purpose' => '', 'ris-requested-by' => '', 'ris-approved-by' => '', 'ris-issued-by' => '', 'ris-received-by' => '');

    $sqlLgu ="SELECT lgu_id, lgu_name FROM lgu";
    $resultLgu = mysqli_query($conn, $sqlLgu);
    if($resultLgu->num_rows> 0){
        $lgus= mysqli_fetch_all($resultLgu, MYSQLI_ASSOC);
    }

    $sqlSupplier ="SELECT supplier_id, supplier_name FROM supplier";
    $resultSupplier = mysqli_query($conn, $sqlSupplier);
    if($resultSupplier->num_rows> 0){
        $suppliers= mysqli_fetch_all($resultSupplier, MYSQLI_ASSOC);
    }

    $sqlOffice ="SELECT office_id, office_name FROM office";
    $resultOffice = mysqli_query($conn, $sqlOffice);
    if($resultOffice->num_rows> 0){
        $offices= mysqli_fetch_all($resultOffice, MYSQLI_ASSOC);
    }

    $sqlCard ="SELECT card_no FROM stock_card";
    $resultCard = mysqli_query($conn, $sqlCard);
    if($resultCard->num_rows> 0){
        $cards= mysqli_fetch_all($resultCard, MYSQLI_ASSOC);
    }
    
    // POST check
    if(isset($_POST['submit'] ) ) {
        
        // Check Issuance Quantity
        if(empty($_POST['issuance-quantity']) ) {
            $errors['issuance-quantity'] = 'A quantity is required. <br />';
        } else {
            $issuance_quantity = $_POST['issuance-quantity'];
        }
        // Check Issuance Remarks
        if(empty($_POST['issuance-remarks']) ) {
            $errors['issuance-remarks'] = 'An remark is required. <br />';
        } else {
            $issuance_remarks = $_POST['issuance-remarks'];
        }
        // Check Purpose
        if(empty($_POST['ris-purpose']) ) {
            $errors['ris-purpose'] = 'A purpose is required. <br />';
        } else {
            $ris_purpose = $_POST['ris-purpose'];
        }
        // Check Requested By
        if(empty($_POST['ris-requested-by']) ) {
            $errors['ris-requested-by'] = 'A name is required. <br />';
        } else {
            $ris_requested_by = $_POST['ris-requested-by'];
        }
        // Check Issued By
        if(empty($_POST['ris-issued-by']) ) {
            $errors['ris-issued-by'] = 'A name is required. <br />';
        } else {
            $ris_issued_by = $_POST['ris-issued-by'];
        }
        // Check Approved By
        if(empty($_POST['ris-approved-by']) ) {
            $errors['ris-approved-by'] = 'A name is required. <br />';
        } else {
            $ris_approved_by = $_POST['ris-approved-by'];
        }
        // Check Received By
        if(empty($_POST['ris-received-by']) ) {
            $errors['ris-received-by'] = 'A name is required. <br />';
        } else {
            $ris_received_by = $_POST['ris-received-by'];
        }


        // Page Redirect
        if(! array_filter($errors) ) {

            // reassign variables to poevent sql injection
            $lgu_id = mysqli_real_escape_string($conn, $_POST['selectLGU']);
            $office_id = mysqli_real_escape_string($conn, $_POST['selectOffice']);
            $card_no = mysqli_real_escape_string($conn, $_POST['selectCard']);
            $issuance_quantity = mysqli_real_escape_string($conn, $_POST['issuance-quantity']);
            $issuance_remarks = mysqli_real_escape_string($conn, $_POST['issuance-remarks']);
            $ris_purpose = mysqli_real_escape_string($conn, $_POST['ris-purpose']);
            $ris_requested_by = mysqli_real_escape_string($conn, $_POST['ris-requested-by']);
            $ris_approved_by = mysqli_real_escape_string($conn, $_POST['ris-approved-by']);
            $ris_issued_by = mysqli_real_escape_string($conn, $_POST['ris-issued-by']);
            $ris_received_by = mysqli_real_escape_string($conn, $_POST['ris-received-by']);
            
            // Create SQL
            $sql = "INSERT INTO ris(lgu_id, office_id, card_no, issuance_quantity, issuance_remarks, ris_purpose, ris_requested_by, ris_approved_by, ris_issued_by, ris_received_by) 
                VALUES('$lgu_id', '$office_id', '$card_no', '$issuance_quantity', '$issuance_remarks', '$ris_purpose', '$ris_requested_by', '$ris_approved_by', '$ris_issued_by', '$ris_received_by')";

            // Save to DB and check
            if(mysqli_query($conn, $sql)) {
                header('Location: ris.php');
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
                    <h1 class="h3 mb-2 text-gray-800">Requisition and Issuance</h1>
                    <p class="mb-4">The RIS shall be used by the <b>Requisitioning Division/Office</b> to request supplies/goods/ equipment/property carried in stock and by the <b>Supply and/or Property Division/Unit</b> to issue the item/s requested.</p>

                    <!-- Create PR Form-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-poimary">Create RIS</h6>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="create-ris.php" method="POST">
                                
                                <div class="mb-3">
                                    <label for="selectLGU" class="form-label">LGU *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectLGU" name="selectLGU">
                                        <?php 
                                        foreach ($lgus as $lgu) {
                                        ?>
                                            <option value="<?php echo $lgu['lgu_id']?>"><?php echo $lgu['lgu_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectOffice" class="form-label">Office *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectOffice" name="selectOffice">
                                        <?php 
                                        foreach ($offices as $office) {
                                        ?>
                                            <option value="<?php echo $office['office_id']?>"><?php echo $office['office_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="selectCard" class="form-label">Stock Card No. *</label>
                                    <select class="form-select custom-select form-control form-control" aria-label="selectCard" name="selectCard">
                                        <?php 
                                        foreach ($cards as $card) {
                                        ?>
                                            <option value="<?php echo $card['card_no']?>"><?php echo $card['card_no']?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inputQty" class="form-label">Issuance Quantity *</label>
                                    <input type="text" class="form-control" name="issuance-quantity" id="inputQty" value="<?php echo $issuance_quantity ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['issuance-quantity'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputRemarks" class="form-label">Issuance Remarks *</label>
                                    <input type="text" class="form-control" name="issuance-remarks" id="inputRemarks" value="<?php echo $issuance_remarks ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['issuance-remarks'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputPurpose" class="form-label">RIS Purpose *</label>
                                    <input type="text" class="form-control" name="ris-purpose" id="inputPurpose" value="<?php echo $ris_purpose ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['ris-purpose'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputRequestedBy" class="form-label">RIS Requested By *</label>
                                    <input type="text" class="form-control" name="ris-requested-by" id="inputRequestedBy" value="<?php echo $ris_requested_by ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['ris-requested-by'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputIssuedBy" class="form-label">RIS Issued By *</label>
                                    <input type="text" class="form-control" name="ris-issued-by" id="inputIssuedBy" value="<?php echo $ris_issued_by ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['ris-issued-by'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputApprovedBy" class="form-label">RIS Approved By *</label>
                                    <input type="text" class="form-control" name="ris-approved-by" id="inputApprovedBy" value="<?php echo $ris_approved_by ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['ris-approved-by'] ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputReceivedBy" class="form-label">RIS Received By *</label>
                                    <input type="text" class="form-control" name="ris-received-by" id="inputReceivedBy" value="<?php echo $ris_received_by ?>">
                                    <div class="mt-2 text-danger"> <?php echo $errors['ris-received-by'] ?></div>
                                </div>

                                <hr class="hr" />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="ris.php">Cancel</a>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>
                            </form>
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
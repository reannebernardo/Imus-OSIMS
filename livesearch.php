<?php

include 'config/db_connect.php';

if(isset($_POST['input'])){
        $input = $_POST['input'];
        
        $sql = "SELECT * FROM purchase_request WHERE pr_no LIKE '{$input}%' OR pr_date LIKE '{$input}%' OR lgu_id LIKE '{$input}%' OR office_id LIKE '{$input}%' OR item_id LIKE '{$input}%' OR pr_purpose LIKE '{$input}%' OR pr_requested_by LIKE '{$input}%' OR approved_by LIKE '{$input}%'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>PR No.</th>
                        <th>PR Date</th>
                        <th>LGU</th>
                        <th>Office</th>
                        <th>Items</th>
                        <th>Purpose</th>
                        <th>Requested By</th>
                        <th>Approved By</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            $pr_no = $row['pr_no'];
                            $pr_date = $row['pr_date'];
                            $lgu_id = $row['lgu_id'];
                            $office_id = $row['office_id'];
                            $item_id = $row['item_id'];
                            $pr_purpose = $row['pr_purpose'];
                            $pr_requested_by = $row['pr_requested_by'];
                            $approved_by = $row['approved_by'];

                            ?>

                            <tr>
                                <td><?php echo $pr_no; ?></td>
                                <td><?php echo $pr_date; ?></td>
                                <td><?php echo $lgu_id; ?></td>
                                <td><?php echo $office_id; ?></td>
                                <td><?php echo $item_id; ?></td>
                                <td><?php echo $pr_purpose; ?></td>
                                <td><?php echo $pr_requested_by; ?></td>
                                <td><?php echo $approved_by; ?></td>
                            </tr>
                            
                            <?php
                        }
                    ?>
                </tbody>
            </table>

            <?php
        } else {
            echo "<h6 class='text-danger text-center mt-3'>No record found</h6>";
        }
        
    }
?>
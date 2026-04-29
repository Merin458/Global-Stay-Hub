<?php
include('header.php');
include('../dboperation.php');
$obj = new dboperation();

// Fetch counts
$studentCount = mysqli_num_rows($obj->executequery("SELECT * FROM tbl_student"));
$ownerCount   = mysqli_num_rows($obj->executequery("SELECT * FROM tbl_houseowner"));
$houseCount   = mysqli_num_rows($obj->executequery("SELECT * FROM tbl_housedetails"));
$requestCount = mysqli_num_rows($obj->executequery("SELECT * FROM tbl_homerequest"));
$paymentCount = mysqli_num_rows($obj->executequery("SELECT * FROM tbl_payment"));

// Recent 5 requests
$requests = $obj->executequery("
    SELECT r.request_id, s.student_name, h.house_name, r.request_date, r.status 
    FROM tbl_homerequest r
    JOIN tbl_student s ON r.student_id = s.student_id
    JOIN tbl_housedetails h ON r.house_id = h.house_id
    ORDER BY r.request_date DESC LIMIT 5
");
?>

    <div class="row clearfix">
        <!-- Students -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Students</h6>
                            <h2><?php echo $studentCount; ?></h2>
                        </div>
                        <div class="icon"><i class="ik ik-user"></i></div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Registered Students</small>
                </div>
                <div class="progress progress-sm"><div class="progress-bar bg-primary" role="progressbar" style="width:100%"></div></div>
            </div>
        </div>

        <!-- Owners -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Owners</h6>
                            <h2><?php echo $ownerCount; ?></h2>
                        </div>
                        <div class="icon"><i class="ik ik-home"></i></div>
                    </div>
                    <small class="text-small mt-10 d-block">Total House Owners</small>
                </div>
                <div class="progress progress-sm"><div class="progress-bar bg-success" role="progressbar" style="width:100%"></div></div>
            </div>
        </div>

        <!-- Houses -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Houses</h6>
                            <h2><?php echo $houseCount; ?></h2>
                        </div>
                        <div class="icon"><i class="ik ik-layers"></i></div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Registered Houses</small>
                </div>
                <div class="progress progress-sm"><div class="progress-bar bg-warning" role="progressbar" style="width:100%"></div></div>
            </div>
        </div>

        <!-- Payments -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Payments</h6>
                            <h2><?php echo $paymentCount; ?></h2>
                        </div>
                        <div class="icon"><i class="ik ik-credit-card"></i></div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Payments Received</small>
                </div>
                <div class="progress progress-sm"><div class="progress-bar bg-danger" role="progressbar" style="width:100%"></div></div>
            </div>
        </div>
    </div>

    <!-- Recent Requests -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Recent Home Requests</h3></div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>House</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($requests)) { ?>
                            <tr>
                                <td><?php echo $row['request_id']; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <td><?php echo $row['house_name']; ?></td>
                                <td><?php echo $row['request_date']; ?></td>
                                <td>
                                    <span class="badge <?php echo ($row['status']=='accepted'?'bg-success':($row['status']=='rejected'?'bg-danger':'bg-secondary')); ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Report -->
    <div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>Payment Report (Admin Profit)</h3></div>
            <div class="card-body">
                <form method="POST">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>From Date:</label>
                            <input type="date" name="fromdate" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label>To Date:</label>
                            <input type="date" name="todate" class="form-control" required>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <button type="submit" name="btnfilter" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <?php
                if(isset($_POST['btnfilter'])){
                    $fromdate = $_POST['fromdate'];
                    $todate = $_POST['todate'];

                    // ✅ Updated query: Admin profit = 10% of full rate (not advance)
                    $sql = "
                        SELECT 
                            p.payment_id,
                            s.student_name,
                            h.house_name,
                            h.rate AS full_amount,
                            p.advance_amount AS amount_paid,
                            p.payment_date,
                            (h.rate * 0.10) AS admin_profit
                        FROM tbl_payment p
                        JOIN tbl_homerequest r ON p.request_id = r.request_id
                        JOIN tbl_student s ON r.student_id = s.student_id
                        JOIN tbl_housedetails h ON r.house_id = h.house_id
                        WHERE p.payment_date BETWEEN '$fromdate' AND '$todate'
                        ORDER BY p.payment_date DESC
                    ";

                    $res = $obj->executequery($sql);

                    if(mysqli_num_rows($res) > 0){
                        echo "<table class='table table-bordered table-striped mt-3'>";
                        echo "<thead class='table-dark'>
                                <tr>
                                    <th>No.</th>
                                    <th>Student</th>
                                    <th>House</th>
                                    <th>Full Amount</th>
                                    <th>Amount Paid</th>
                                    <th>Admin Profit (10%)</th>
                                    <th>Payment Date</th>
                                </tr>
                              </thead><tbody>";

                        $total_full = 0;
                        $total_paid = 0;
                        $total_profit = 0;
                        $i = 1;

                        while($row = mysqli_fetch_assoc($res)){
                            $total_full += $row['full_amount'];
                            $total_paid += $row['amount_paid'];
                            $total_profit += $row['admin_profit'];

                            echo "<tr>
                                    <td>".$i++."</td>
                                    <td>".$row['student_name']."</td>
                                    <td>".$row['house_name']."</td>
                                    <td>₹".number_format($row['full_amount'],2)."</td>
                                    <td>₹".number_format($row['amount_paid'],2)."</td>
                                    <td>₹".number_format($row['admin_profit'],2)."</td>
                                    <td>".$row['payment_date']."</td>
                                  </tr>";
                        }

                        // ✅ Totals row
                        echo "<tr>
                                <td colspan='3'><strong>Total</strong></td>
                                <td><strong>₹".number_format($total_full,2)."</strong></td>
                                <td><strong>₹".number_format($total_paid,2)."</strong></td>
                                <td><strong>₹".number_format($total_profit,2)."</strong></td>
                                <td></td>
                              </tr>";

                        echo "</tbody></table>";
                    } else {
                        echo "<p class='text-danger mt-3'>No payments found in this date range.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>



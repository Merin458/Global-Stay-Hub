<?php
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();
$s = 1;
$sql = "SELECT * FROM tbl_houseowner";
$res = $obj->executequery($sql);
?>
<style>
    td {
        display: table-cell !important;
        vertical-align: middle;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .status-pending { background-color: #6c757d; }  /* gray */
    .status-accepted { background-color: #28a745; } /* green */
    .status-rejected { background-color: #dc3545; } /* red */
    .profile-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #007bff;
    }
    /* New: card wrapper to center and move slightly right */
    /* Card wrapper to center and slightly left-shift */
.table-wrapper {
    max-width: 1000px;
    margin-left: -10%; /* moves slightly left */
    margin-right: auto;
}

/* Heading aligned with card */
.page-header {
    margin-left: 5%;
}

</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="page-header" style="margin-left: 27%;">
            <h3>House Owner List</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 table-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3>Data Table</h3>
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $s = 1;
                                $res = $obj->executequery($sql);
                                while ($display = mysqli_fetch_array($res)) { 
                                    $status = $display['status'];
                                    $status_class = "status-pending"; // default gray
                                    if ($status == "Accepted") $status_class = "status-accepted";
                                    if ($status == "Rejected") $status_class = "status-rejected";
                                ?>
                                <tr>
                                    <td><?php echo $s++; ?></td>
                                    <td>
                                        <img src="../uploads/<?php echo $display["owner_image"]; ?>" 
                                             alt="Profile Image" 
                                             class="profile-img">
                                    </td>
                                    <td><?php echo $display["owner_name"]; ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $status_class; ?>">
                                            <?php echo $status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="hoview.php?owner_id=<?php echo $display['owner_id']; ?>"
                                            class="btn btn-info btn-sm">View More</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>

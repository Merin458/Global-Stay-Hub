<?php
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();
$s = 1;
$sql = "SELECT * FROM tbl_country";
$res = $obj->executequery($sql);
?>

<div class="wrapper" style="display: flex; flex-direction: column; min-height: 100vh;">

    <div class="container-fluid" style="margin-top: 30px;">
        <div class="container" style="margin-top:50px">

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 fw-semibold text-dark">
                                <i class="bi bi-flag me-2 text-primary"></i> Country Table
                            </h3>
                            <a href="country.php" class="btn btn-success btn-sm">+ Add Country</a>
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-bordered table-hover align-middle text-center rounded-3 overflow-hidden">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width:5%;">#</th>
                                        <th scope="col" style="width:35%;">Country Name</th>
                                        <th scope="col" style="width:35%;">Country Flag</th>
                                        <th scope="col" style="width:25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($display = mysqli_fetch_array($res)) { ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $s++;?></td>
                                            <td class="text-capitalize"><?php echo $display["country_name"];?></td>
                                            <td>
                                                <img src="../Uploads/<?php echo $display["country_flag"];?>" 
                                                     alt="flag" 
                                                     class="shadow-sm border"
                                                     style="width:80px; height:55px; object-fit:cover; border-radius:6px;">
                                            </td>
                                            <td>
                                                <a href="countryedit.php?id=<?php echo $display['country_id']; ?>" 
                                                   class="btn btn-primary btn-sm me-2">
                                                   Edit
                                                </a>
                                                <a href="countrydelete.php?id=<?php echo $display['country_id']; ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this country?');">
                                                   Delete
                                                </a>
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
</div>

<?php include('footer.php'); ?>

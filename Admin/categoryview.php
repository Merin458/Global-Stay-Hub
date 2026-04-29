<?php
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();
$s = 1;
$sql = "SELECT * FROM tbl_category";
$res = $obj->executequery($sql);
?>


<div class="wrapper" style="display: flex; flex-direction: column; min-height: 100vh;">

    
    <div class="content" style="flex: 1;">
        <div class="container-fluid" style="margin-top: 70px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Category Table</h3>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="data_table" class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th style="text-align:center;" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($display = mysqli_fetch_array($res)) { ?>
                                        <tr>
                                            <td><?php echo $s++; ?></td>
                                            <td><?php echo $display["category_name"]; ?></td>
                                            <td><?php echo $display["category_description"]; ?></td>
                                            <td>
                                                <img src="../uploads/<?php echo $display["category_image"]; ?>" alt="image" style="width: 120px; height: 80px; border-radius: 4px;">
                                            </td>
                                            <td>
                                                <a href="categorydelete.php?category_id=<?php echo $display['category_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete?');">Delete</a>
                                            </td>
                                            <td>
                                                <a href="categoryedit.php?category_id=<?php echo $display['category_id']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure want to edit?');">Edit</a>
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

</div>

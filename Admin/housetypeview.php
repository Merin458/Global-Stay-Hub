<?php
include_once('header.php');
include("../dboperation.php");
$obj=new dboperation();
$s=1;
$sql="select * from tbl_housetype";
$res=$obj->executequery($sql);
?>

<div class="wrapper" style="display: flex; flex-direction: column; min-height: 90vh;">

    <div class="container-fluid" style="margin-top: 10px;">
<div class="container" style="margin-top:70px">


                        <div class="row">
                            <div class="col-md-12">
                                 <div class="card">
                                    <div class="card-header"><h3>House Type Table</h3></div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sl.no</th>
                                                    <th>House Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while($display=mysqli_fetch_array($res)){

                                                    ?>
                                                <tr>
                                                    <td><?php echo $s++;?></td>
                                                    <td><?php echo $display["house_type"];?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div></div>
             <?php
             include('footer.php');
             ?>
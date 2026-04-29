<?php
include('header.php');
include('../dboperation.php');
$obj = new dboperation();

$owner = null;
$house_id = null;
$noofperson = 1;

if (isset($_GET['house_id'])) {
    $house_id = $_GET['house_id'];
    $noofperson = $_GET['noofperson'];

    $sql = "SELECT h.house_name, 
                   o.owner_name, 
                   o.phone, 
                   o.email, 
                   o.city_id, 
                   o.pincode
            FROM tbl_housedetails h
            INNER JOIN tbl_houseowner o ON h.owner_id = o.owner_id
            WHERE h.house_id = '$house_id'";
    
    $res = $obj->executequery($sql);
    $owner = mysqli_fetch_array($res);
}
?>

<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">

        <div class="text-center mb-4 ftco-animate">
            <button type="button" class="back-btn" onclick="goBack()">
                ← Go Back
            </button>
        </div>

        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">Book Now</h2>
                <p>Please select your booking dates and confirm your stay.</p>
            </div>
        </div>

        <div class="row block-9">
            <!-- Booking Form -->
            <div class="col-md-7 order-md-last d-flex ftco-animate">
                <form action="bookingaction.php?house_id=<?php echo $house_id; ?>" 
                      method="post" 
                      class="bg-light p-4 p-md-5 contact-form shadow-lg rounded"
                      onsubmit="return validateBookingForm()">

                    <?php $today = date('Y-m-d'); ?>

                    <div class="form-group">
                        <label class="form-label">From Date</label>
                        <input type="date" 
                               class="form-control" 
                               id="fromdate" 
                               name="fromdate" 
                               required 
                               min="<?php echo $today; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">To Date</label>
                        <input type="date" 
                               class="form-control" 
                               id="todate" 
                               name="todate" 
                               required 
                               min="<?php echo $today; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Number of Persons</label>
                        <input type="number" 
                               min="1" 
                               max="<?php echo $noofperson; ?>" 
                               class="form-control" 
                               id="nopersons" 
                               name="nopersons" 
                               required>
                    </div>

                    <div class="form-group text-center mt-4">
                        <input type="submit" value="Book Now" class="btn btn-primary py-3 px-5 rounded-pill">
                    </div>
                </form>
            </div>

            <!-- Owner Contact Info -->
            <div class="col-md-5 d-flex">
                <div class="row d-flex contact-info mb-5">
                    <?php if (!empty($owner)) { ?>
                        <div class="col-md-12 ftco-animate">
                            <div class="box p-3 bg-light d-flex align-items-center rounded shadow-sm mb-3">
                                <div class="icon mr-3"><span class="icon-user"></span></div>
                                <div>
                                    <h3 class="mb-2">Owner Name</h3>
                                    <p class="mb-0"><?php echo $owner['owner_name']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ftco-animate">
                            <div class="box p-3 bg-light d-flex align-items-center rounded shadow-sm mb-3">
                                <div class="icon mr-3"><span class="icon-phone2"></span></div>
                                <div>
                                    <h3 class="mb-2">Contact Number</h3>
                                    <p class="mb-0">
                                        <a href="tel:<?php echo $owner['phone']; ?>">
                                            <?php echo $owner['phone']; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ftco-animate">
                            <div class="box p-3 bg-light d-flex align-items-center rounded shadow-sm mb-3">
                                <div class="icon mr-3"><span class="icon-paper-plane"></span></div>
                                <div>
                                    <h3 class="mb-2">Email Address</h3>
                                    <p class="mb-0">
                                        <a href="mailto:<?php echo $owner['email']; ?>">
                                            <?php echo $owner['email']; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    <?php } else { ?>
                        <p class="text-danger">Owner details not found.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styling -->
<style>
.back-btn {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: white;
    padding: 10px 25px;
    border: none;
    border-radius: 30px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}
.back-btn:hover {
    background: linear-gradient(90deg, #00c6ff, #007bff);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}
</style>

<!-- JavaScript Validation & Back Function -->
<script>
function validateBookingForm() {
    let fromDate = document.getElementById("fromdate").value;
    let toDate = document.getElementById("todate").value;
    let noPersons = document.getElementById("nopersons").value;
    let maxPersons = <?php echo $noofperson; ?>;
    let today = new Date().toISOString().split("T")[0];

    if (fromDate < today) {
        alert("From Date cannot be in the past.");
        return false;
    }

    if (toDate <= fromDate) {
        alert("To Date must be after From Date.");
        return false;
    }

    if (noPersons < 1 || noPersons > maxPersons) {
        alert("Number of persons must be between 1 and " + maxPersons + ".");
        return false;
    }

    return true;
}

function goBack() {
    window.history.back();
}
</script>

<?php include('footer.php'); ?>

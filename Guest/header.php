<!DOCTYPE html>
<html lang="en">

<head>
  <title>Stayhome - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="py-1 bg-black top">
    <div class="container">
      <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
        <div class="col-lg-12 d-block">
          <div class="row d-flex">
            <div class="col-md pr-4 d-flex topper align-items-center">
              <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span>
              </div>
              <span class="text">+91 8943341930</span>
            </div>
            <div class="col-md pr-4 d-flex topper align-items-center">
              <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                  class="icon-paper-plane"></span></div>
              <span class="text">globalstayhub5833@gmail.com</span>
            </div>

            

            <!-- SIGN UP DROPDOWN -->
<style>
  /* ===== Popup Styles ===== */
  .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
  }

  .popup {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
    animation: fadeIn 0.3s ease-in-out;
    max-width: 500px;
    width: 100%;
    position: relative;
  }

  .popup img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
  }

  .popup button {
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    color: #fff;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.3s;
    width: 100%;
  }

  .popup a button {
    background-color: #007bff;
  }

  .popup a button:hover {
    background-color: #0056b3;
  }

  /* Small gray close button */
  .close-small {
    grid-column: 1 / span 2;
    justify-self: center;
    background-color: #ccc;
    color: #333;
    font-size: 14px;
    width: auto;
    padding: 6px 20px;
    margin-top: 10px;
  }

  .close-small:hover {
    background-color: #aaa;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  /* Responsive */
  @media(max-width: 768px) {
    .popup {
      grid-template-columns: 1fr;
    }

    .close-small {
      grid-column: auto;
      width: 10%;
    }
  }
</style>

<div style="position:relative; display:inline-block;">
  <button type="button"
    style="padding:10px 50px; border:none; background:#333; color:white; cursor:pointer; border-radius:6px;"
    onclick="openPopup()">
    Sign Up
  </button>

  <script>
    function openPopup() {
      document.getElementById("popup").style.display = "flex";
    }

    function closePopup() {
      document.getElementById("popup").style.display = "none";
    }
  </script>

  <!-- ===== Popup Container ===== -->
  <div class="popup-overlay" id="popup">
    <div class="popup">
      <div style="text-align:center;">
        <img src="images/stud.png" alt="student_img">
        <a href="student.php">
          <button onclick="closePopup()">Student</button>
        </a>
      </div>

      <div style="text-align:center;">
        <img src="images/howner.png" alt="owner_img">
        <a href="houseowner.php">
          <button onclick="closePopup()">House Owner</button>
        </a>
      </div>

      <button class="close-small" onclick="closePopup()">Close</button>
    </div>
  </div>
</div>


            <!-- SIMPLE SIGN IN BUTTON -->
            <a href="login.php"
              style="padding:10px 20px; margin-left:15px; border:none; background:#333; color:white; border-radius:6px; text-decoration:none; font-weight:bold;">
              Sign In
            </a>

            <script>
              // dropdown toggle for Sign Up
              document.querySelector('.dropdown-btn').addEventListener('click', function (e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
              });

              // close dropdown when clicking outside
              document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-content').forEach(d => d.style.display = 'none');
              });
            </script>


          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target"
    id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="guestindex.php">Global Stay Hub</a>
      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse"
        data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav nav ml-auto">
          <li class="nav-item"><a href="guestindex.php" class="nav-link"><span>Home</span></a></li>
          <li class="nav-item"><a href="services.php" class="nav-link"><span>Services</span></a></li>
          <li class="nav-item"><a href="listing.php" class="nav-link"><span>Listing</span></a></li>
          <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
          <li class="nav-item"><a href="working.php" class="nav-link"><span>How it works</span></a></li>
          
          <li class="nav-item"><a href="clientfeedback.php" class="nav-link"><span>Feedbacks</span></a></li>
          
        </ul>
      </div>
    </div>
  </nav>
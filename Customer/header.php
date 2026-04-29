<!DOCTYPE html>
<html lang="en">
<head>
    <title>Global Stay Hub</title>
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

    <style>
        /* TOP BAR */
        .top {
            background: #f8f9fa;
            font-size: 14px;
            color: #333;
            position: relative;
            z-index: 1000;
            overflow: visible;
        }
        .top .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding: 5px 15px;
        }
        .top .contact-info {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .top .contact-info span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }
        .top .contact-info .icon {
            color: #007bff;
        }
        .top .top-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
            position: relative;
        }

        /* Buttons */
        .btn-header {
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }
        .dropdown-btn, .btn-logout {
            background: #007bff;
            color: white;
        }
        .dropdown-btn:hover, .btn-logout:hover {
            background: #0056b3;
        }
        .btn-signin {
            background: #6c757d;
            color: white;
        }
        .btn-signin:hover {
            background: #5a6268;
        }

        /* Dropdown */
        .dropdown-wrapper {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            border-radius: 10px;
            padding: 5px 0;
            min-width: 140px;
            z-index: 9999;
            transition: all 0.3s ease;
        }
        .dropdown-content a {
            display: block;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            color: #333;
            font-size: 15px;
            transition: all 0.3s;
        }
        .dropdown-content a:hover {
            background: #e6f0ff;
            color: #007bff;
        }
        .dropdown-btn::after {
            content: "▼";
            margin-left: 5px;
            font-size: 10px;
        }

        /* NAVBAR */
        .navbar {
            background: #343a40 !important;
            position: relative;
            z-index: 1000;
            overflow: visible;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: #007bff !important;
        }
        .navbar-nav .nav-link {
            color: #f8f9fa !important;
            font-weight: 500;
            margin: 0 6px;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff !important;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- TOP BAR -->
<div class="top">
    <div class="container">
        <div class="contact-info">
            <span><i class="icon icon-phone2"></i> +91 8943341930</span>
            <span><i class="icon icon-paper-plane"></i> globalstayhub5833@gmail.com</span>
        </div>
         <div class="top-buttons">
      
            <a href="logout.php" onclick="return confirmLogout();" class="btn-header btn-logout">Logout</a>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar site-navbar-target">
    <div class="container">
        <a class="navbar-brand" href="searchhouse.php">Global Stay Hub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="searchhouse.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="mybooking.php" class="nav-link">Your Bookings</a></li>
                <li class="nav-item"><a href="studentprofile.php" class="nav-link">Profile</a></li>
               
          <li class="nav-item"><a href="services.php" class="nav-link"><span>Services</span></a></li>
          <li class="nav-item"><a href="listing.php" class="nav-link"><span>Listing</span></a></li>
          <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
          <li class="nav-item"><a href="working.php" class="nav-link"><span>How it works</span></a></li>
          
          <li class="nav-item"><a href="clientfeedback.php" class="nav-link"><span>Feedbacks</span></a></li>
</ul>
        </div>
    </div>
</nav>

<script>
    // Dropdown toggle
    document.querySelector('.dropdown-btn').addEventListener('click', function(e){
        e.stopPropagation();
        const dropdown = this.nextElementSibling;
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown on click outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-content').forEach(d => d.style.display = 'none');
    });

    // Logout confirmation
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>

</body>
</html>

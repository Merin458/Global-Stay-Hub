<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Global Stay Hub - Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      height: 100vh;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                  url('loginbg.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
    }
    .login-card {
      max-width: 420px;
      margin: auto;
      background: rgba(255,255,255,0.9);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      backdrop-filter: blur(5px);
      position: relative;
    }
    .login-card .form-control {
      border-radius: 50px;
      padding-left: 2.5rem;
    }
    .login-card .input-icon {
      position: absolute;
      left: 15px;
      top: 10px;
      color: #888;
    }
    .login-btn {
      border-radius: 50px;
      font-weight: bold;
    }
    /* === Close Button === */
    .close-btn {
      position: absolute;
      top: 12px;
      right: 15px;
      background: transparent;
      border: none;
      font-size: 20px;
      color: #555;
      cursor: pointer;
      transition: 0.3s;
    }
    .close-btn:hover {
      color: #000;
      transform: scale(1.1);
    }
  </style>
</head>
<body>

  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="login-card">
      
      <!-- Close Button -->
      <button class="close-btn" onclick="closePage()">
        <i class="fas fa-times"></i>
      </button>

      <div class="text-center mb-4">
        <i class="fas fa-hotel fa-3x text-primary mb-2"></i>
        <h3 class="font-weight-bold">Global Stay Hub</h3>
        <p class="text-muted">Log in to your account</p>
      </div>

      <form action="loginaction.php" method="POST">
        
        <div class="form-group position-relative mb-3">
          <i class="fas fa-user input-icon"></i>
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="form-group position-relative mb-4">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block login-btn">Login</button>

        <div class="text-center mt-3">
          <a href="#" class="small text-muted">Terms of use</a> · 
          <a href="forgotpw.php" class="small text-muted">Forgot Password?</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function closePage() {
      // Option 1: Go back to the previous page
      window.history.back();

      // Option 2 (optional): Redirect to homepage instead
      // window.location.href = "index.php";
    }
  </script>

</body>
</html>

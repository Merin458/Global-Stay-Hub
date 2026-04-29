<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login or Sign Up Required</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      margin: 0;
    }

    .container {
      background: white;
      text-align: center;
      padding: 40px 50px;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 420px;
      animation: fadeIn 0.5s ease;
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
    }

    p {
      color: #555;
      font-size: 15px;
      margin-bottom: 25px;
    }

    .btn {
      display: inline-block;
      padding: 10px 25px;
      margin: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      font-size: 15px;
      transition: 0.3s ease;
    }

    .btn-signup {
      background-color: #007bff;
      color: white;
    }

    .btn-signup:hover {
      background-color: #0056b3;
    }

    .btn-login {
      background-color: #28a745;
      color: white;
    }

    .btn-login:hover {
      background-color: #1e7e34;
    }

    .btn-close {
      background-color: #6c757d;
      color: white;
    }

    .btn-close:hover {
      background-color: #5a6268;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Sign Up or Log In Required</h2>
    
    <button class="btn btn-signup" onclick="goToSignup()">Sign Up</button>
    <button class="btn btn-login" onclick="goToLogin()">Log In</button>
    <button class="btn btn-close" onclick="closePage()">Close</button>
  </div>

  <script>
    function goToSignup() {
      window.location.href = "signup.php"; // change to your signup page link
    }

    function goToLogin() {
      window.location.href = "login.php"; // change to your login page link
    }

    function closePage() {
      window.history.back(); // return to previous page
    }
  </script>
</body>
</html>

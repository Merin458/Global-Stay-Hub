<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up Options</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #4A00E0, #8E2DE2);
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .popup {
    background: #fff;
    border-radius: 20px;
    padding: 40px 50px;
    width: 90%;
    max-width: 450px;
    text-align: center;
    box-shadow: 0 10px 35px rgba(0,0,0,0.2);
    animation: fadeIn 0.4s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
  }

  .popup h2 {
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
    font-weight: 600;
  }

  .option-container {
    display: flex;
    justify-content: space-around;
    gap: 20px;
    flex-wrap: wrap;
  }

  .option {
    background: #f8f8ff;
    border-radius: 15px;
    padding: 20px;
    width: 150px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .option:hover {
    transform: translateY(-5px);
    background: #f1e9ff;
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
  }

  .option img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 3px solid #ddd;
  }

  .option button {
    margin-top: 8px;
    padding: 8px 20px;
    background: linear-gradient(135deg, #4A00E0, #8E2DE2);
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-size: 15px;
    transition: 0.3s;
  }

  .option button:hover {
    background: linear-gradient(135deg, #8E2DE2, #4A00E0);
  }
</style>
</head>
<body>

<div class="popup">
  <h2>Choose Your Role</h2>

  <div class="option-container">
    <div class="option">
      <img src="images/stud.png" alt="Student">
      <a href="student.php">
        <button>Student</button>
      </a>
    </div>

    <div class="option">
      <img src="images/howner.png" alt="House Owner">
      <a href="houseowner.php">
        <button>House Owner</button>
      </a>
    </div>
  </div>
</div>

</body>
</html>

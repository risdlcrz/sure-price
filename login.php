<?php
// You can add session logic here later if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Admin Center</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="./Styles/login.css">
</head>
<body>

  <!-- Top bar -->
  <div class="top-bar">
    <img src="./Images/gdc_logo.png" alt="Logo">
    <span class="top-title">Admin Center</span>
  </div>

  <!-- Centered container -->
  <div class="main-container">
    <div class="login-box">
      <div class="login-left"></div>

      <div class="login-right">
        <h2 class="login-title">Login</h2>
        <div class="signup-link-inside">
          Don't have an account yet? <a href="signup.php">Sign up</a>
        </div>
        <form method="POST" action="process_login.php">
          <input type="email" name="email" placeholder="Email" required>

          <div class="password-wrapper">
            <input type="password" name="password" placeholder="Password" id="password" required>
            <span class="toggle-password" onclick="togglePassword()">
              <i id="toggleIcon" class="fa-solid fa-eye"></i>
            </span>
          </div>

          <div class="forgot-link">
            <a href="forgot_password.php">Forgot password?</a>
          </div>

          <input type="submit" value="Login">
        </form>
      </div>
    </div>
  </div>

  <script src="./Script/login.js"></script>

</body>
</html>

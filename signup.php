<?php
// You can add session logic here later if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - Admin Center</title>
  <link rel="stylesheet" href="./Styles/signup.css">
</head>
<body>

  <!-- Top Navigation -->
  <div class="top-bar">
    <img src="./Images/gdc_logo.png" alt="Logo"> <!-- Replace with your logo path -->
    <span class="top-title">Admin Center</span>
  </div>

  <!-- Sign Up Form Box -->
  <div class="signup-box">
    <h2>Create an Account</h2>
    

    <!-- Regular Sign Up Form -->
    <form method="POST" action="process_signup.php">
      <input type="text" name="first_name" placeholder="First Name" required>
      <input type="text" name="last_name" placeholder="Last Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      
      <!-- Sign Up Button -->
      <input type="submit" value="Sign Up">
    </form>
    
    <div class="back-link">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>

</body>
</html>

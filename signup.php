<?php
include "db.php";
require "mailer.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first  = trim($_POST['first_name']);
    $middle = trim($_POST['middle_name']);
    $last   = trim($_POST['last_name']);
    $gender = $_POST['gender'];
    $email  = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $error = "This email is already registered. Please use a different email or log in.";

    } else {
        // Insert user with verified = 0
        $sql = "INSERT INTO users 
                (first_name, middle_name, last_name, gender, email, password, verified)
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss",
            $first, $middle, $last, $gender, $email, $password
        );

        if (mysqli_stmt_execute($stmt)) {
            $user_id = mysqli_insert_id($conn);

            // Generate unique token
            $token = bin2hex(random_bytes(32));

            // Save token to verification_tokens table
            $tokenStmt = mysqli_prepare($conn,
                "INSERT INTO verification_tokens (user_id, token) VALUES (?, ?)");
            mysqli_stmt_bind_param($tokenStmt, "is", $user_id, $token);
            mysqli_stmt_execute($tokenStmt);

            // Send verification email
            $sent = sendVerificationEmail($email, $first, $token);

            if ($sent) {
                $success = "Account created! Please check your email at <b>$email</b> and click the verification link to activate your account.";
            } else {
                // Email failed but account was created — still show message
                $success = "Account created but we could not send the verification email. Please contact support or try signing up again.";
            }

        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CareAct Sign Up</title>
  <link rel="stylesheet" href="style2.css">
  <style>
    .side-img {
        position: fixed;
        bottom: 80px;
        height: 75%;
        max-height: 100%;
        z-index: 0;
    }
    .left-img { left: 0; }
    .right-img { right: 0; }
    .whitebox, .center {
        position: relative;
        z-index: 1;
    }
    .back-btn { margin-top: 15px; }
    .success-box {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 15px;
        line-height: 1.6;
    }
    .error-box {
        background: #ffebee;
        border: 1px solid #ef9a9a;
        color: #c62828;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    /* TABLET */
    @media (max-width: 1024px) {
      .side-img { height: 60%; opacity: 0.4; }
      .center { width: 25% !important; }
    }

    /* MOBILE */
    @media (max-width: 600px) {
      .side-img { display: none; }
      .center {
        width: 40% !important;
        display: block;
        margin: 40px auto 20px auto;
      }
      .whitebox {
        width: 90%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
      }
      .button { width: 100%; max-width: 250px; }
    }

    /* FOOTER */
    footer {
      background: #4f6cf5;
      color: white;
      text-align: center;
      padding: 15px 20px;
      margin-top: 100px;
    }
    footer h3 { margin: 0; font-size: 18px; }
    footer p { margin: 5px 0; font-size: 14px; }

    @media (max-width: 600px) {
      footer { padding: 12px; }
      footer h3 { font-size: 16px; }
      footer p { font-size: 12px; }
    }
  </style>
</head>
<body>

  <img src="icons/caregiver2.png" class="side-img left-img">
  <img src="icons/caregiver1.png" class="side-img right-img">

  <img src="CareAct.png" style="width:15%;" class="center">

  <div id="form">
    <div class="whitebox">
      <h1>Sign Up</h1>

      <?php if (isset($success)): ?>
        <!-- Show success message, hide the form -->
        <div class="success-box">✅ <?php echo $success; ?></div>
        <a href="login.php"><button class="button b">Go to Login</button></a>
        <br>
        <a href="resend_verification.php">
          <button class="button b back-btn">Resend Verification Email</button>
        </a>

      <?php else: ?>

        <?php if (isset($error)): ?>
          <div class="error-box">⚠️ <?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">

          <label>First Name:</label><br>
          <input type="text" name="first_name"
                 value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>"
                 required><br><br>

          <label>Middle Name:</label><br>
          <input type="text" name="middle_name"
                 value="<?php echo isset($_POST['middle_name']) ? htmlspecialchars($_POST['middle_name']) : ''; ?>"><br><br>

          <label>Last Name:</label><br>
          <input type="text" name="last_name"
                 value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>"
                 required><br><br>

          <label>Gender:</label><br>
          <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select><br><br>

          <label>Email Address:</label><br>
          <input type="email" name="email"
                 value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                 required><br><br>

          <label>Password:</label><br>
          <input type="password" name="password" required><br><br>

          <button type="submit" class="button b">Done</button>

        </form>

        <a href="index.html">
          <button class="button b back-btn">Back</button>
        </a>

      <?php endif; ?>

    </div>
  </div>

  <footer>
    <h3>CareAct</h3>
    <p>Web-Based Caregiver Training System</p>
    <p>© 2025 CareAct | All Rights Reserved</p>
  </footer>

</body>
</html>
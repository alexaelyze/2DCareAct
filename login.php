<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $sql  = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user['password'])) {

            // ── Check if email is verified ──
            if ($user['verified'] == 0) {
                $error = "unverified";
                $unverified_email = $email;

            } else {
                // ── All good — log in ──
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email']   = $user['email'];
                $_SESSION['role']    = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: admin_home.php");
                } elseif ($user['role'] === 'instructor') {
                    header("Location: instructor_home.php");
                } else {
                    header("Location: home.php");
                }
                exit();
            }

        } else {
            $error = "incorrect_password";
        }

    } else {
        $error = "not_found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct Login</title>
<link rel="stylesheet" href="style.css">
<style>
    .side-img {
        position: fixed;
        bottom: 80px;
        height: 75%;
        max-height: 100%;
        z-index: 0;
    }
    .left-img  { left: 0; }
    .right-img { right: 0; }
    .whitebox, .center {
        position: relative;
        z-index: 1;
    }
    .back-btn { margin-top: 15px; }

    .error-box {
        background: #ffebee;
        border: 1px solid #ef9a9a;
        color: #c62828;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 15px;
        line-height: 1.6;
    }

    .warning-box {
        background: #fff8e1;
        border: 1px solid #ffe082;
        color: #f57f17;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 15px;
        line-height: 1.6;
    }

    .warning-box a {
        color: #e65100;
        font-weight: bold;
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
footer{
  background: #4f6cf5;
  color: white;
  text-align: center;
  padding: 15px 20px;
  margin-top: 180px;
}

footer h3{
  margin: 0;
  font-size: 18px;
}

footer p{
  margin: 5px 0;
  font-size: 14px;
}

/* MOBILE */
@media (max-width: 600px){

  footer{
    padding: 12px;
  }

  footer h3{
    font-size: 16px;
  }

  footer p{
    font-size: 12px;
  }

}

.whitebox {
    width: 380px;
    min-height: 20rem;
    height: auto;
    padding: 30px 35px;
    overflow: visible;
}

.whitebox form input {
    width: 100%;
    box-sizing: border-box;
}

.warning-box {
    background: #fff8e1;
    border: 1px solid #ffe082;
    color: #f57f17;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 13px;
    line-height: 1.6;
    text-align: left;
    word-wrap: break-word;
    box-sizing: border-box;
    width: 100%;
}

.warning-box a {
    color: #e65100;
    font-weight: bold;
    display: block;
    margin-top: 6px;
}

.error-box {
    background: #ffebee;
    border: 1px solid #ef9a9a;
    color: #c62828;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 13px;
    line-height: 1.6;
    text-align: left;
    word-wrap: break-word;
    box-sizing: border-box;
    width: 100%;
}

</style>
</head>
<body>

    <img src="icons/caregiver2.png" class="side-img left-img">
    <img src="icons/caregiver1.png" class="side-img right-img">

    <img src="CareAct.png" style="width:15%;" class="center">

    <div class="whitebox">
      <h1>Log In</h1>

      <?php if (isset($error)): ?>

        <?php if ($error === 'unverified'): ?>
          <div class="warning-box">
            ⚠️ Your email address has not been verified yet.<br>
            Please check your inbox for the verification email.<br><br>
            Didn't receive it?
            <a href="resend_verification.php?email=<?php echo urlencode($unverified_email); ?>">
              Resend Verification Email
            </a>
          </div>

        <?php elseif ($error === 'incorrect_password'): ?>
          <div class="error-box">
            ⚠️ Incorrect password. Please try again.
          </div>

        <?php elseif ($error === 'not_found'): ?>
          <div class="error-box">
            ⚠️ No account found with that email address.
            <br>
            <a href="signup.php" style="color:#c62828;font-weight:bold;">
              Create an account
            </a>
          </div>

        <?php endif; ?>

      <?php endif; ?>

      <form method="POST" action="login.php">
        <label>Email:</label><br>
        <input type="email" name="email"
               value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
               required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" class="button b">Login</button>
      </form>

      <a href="index.html">
        <button class="button b back-btn">Back</button>
      </a>

    </div>
<footer>
  <h3>CareAct</h3>
  <p>Web-Based Caregiver Training System</p>
  <p>© 2025 CareAct | All Rights Reserved</p>
</footer>
</body>
</html>
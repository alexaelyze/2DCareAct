<?php
session_start();
include "db.php";

$message = '';
$success = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Find the token in the database
    $stmt = mysqli_prepare($conn,
        "SELECT * FROM verification_tokens 
         WHERE token = ? AND expires_at > NOW()");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $user_id = $row['user_id'];

        // Mark user as verified
        $update = mysqli_prepare($conn,
            "UPDATE users SET verified = 1 WHERE id = ?");
        mysqli_stmt_bind_param($update, "i", $user_id);
        mysqli_stmt_execute($update);

        // Delete the used token
        $delete = mysqli_prepare($conn,
            "DELETE FROM verification_tokens WHERE token = ?");
        mysqli_stmt_bind_param($delete, "s", $token);
        mysqli_stmt_execute($delete);

        $success = true;
        $message = "Your email has been verified successfully! You can now log in.";

    } else {
        $message = "This verification link is invalid or has already expired. Please sign up again or request a new verification email.";
    }

} else {
    $message = "No verification token provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct - Email Verification</title>
<style>
* { font-family: "Segoe UI", sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
body { background: #f0f2ff; display: flex; flex-direction: column; min-height: 100vh; }

header {
    background: #536dfe; color: white;
    padding: 20px 40px; text-align: center;
}
header h1 { font-size: 32px; }

.main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
}

.card {
    background: white;
    padding: 50px 40px;
    border-radius: 12px;
    text-align: center;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.icon {
    font-size: 64px;
    margin-bottom: 20px;
}

.card h2 {
    color: #536dfe;
    font-size: 26px;
    margin-bottom: 16px;
}

.card p {
    color: #555;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
}

.btn {
    display: inline-block;
    background: #536dfe;
    color: white;
    padding: 14px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
}

.btn:hover { background: #3d57e8; }

.btn-outline {
    display: inline-block;
    background: white;
    color: #536dfe;
    border: 2px solid #536dfe;
    padding: 12px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    margin-top: 12px;
}

.btn-outline:hover { background: #f0f2ff; }

footer {
    background: #536dfe;
    color: white;
    text-align: center;
    padding: 15px 20px;
}
footer h3 { margin: 0; font-size: 18px; }
footer p { margin: 5px 0; font-size: 14px; }
</style>
</head>
<body>

<header>
    <h1>CareAct</h1>
</header>

<div class="main">
    <div class="card">

        <?php if ($success): ?>
            <div class="icon">✅</div>
            <h2>Email Verified!</h2>
            <p><?php echo $message; ?></p>
            <a href="login.php" class="btn">Go to Login</a>

        <?php else: ?>
            <div class="icon">❌</div>
            <h2>Verification Failed</h2>
            <p><?php echo $message; ?></p>
            <a href="signup.php" class="btn">Sign Up Again</a>
            <br>
            <a href="resend_verification.php" class="btn-outline">Resend Verification Email</a>

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
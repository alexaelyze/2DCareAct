<?php
session_start();
include "db.php";
require "mailer.php";

$success = false;
$error   = '';
$prefill = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Check if email exists and is unverified
    $stmt = mysqli_prepare($conn,
        "SELECT id, first_name, verified FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

    if (!$user) {
        $error = "No account found with that email address.";

    } elseif ($user['verified'] == 1) {
        $error = "This email is already verified. You can log in normally.";

    } else {
        $user_id = $user['id'];
        $name    = $user['first_name'];

        // Delete any existing tokens for this user
        $del = mysqli_prepare($conn,
            "DELETE FROM verification_tokens WHERE user_id = ?");
        mysqli_stmt_bind_param($del, "i", $user_id);
        mysqli_stmt_execute($del);

        // Generate new token
        $token = bin2hex(random_bytes(32));

        // Save new token
        $ins = mysqli_prepare($conn,
            "INSERT INTO verification_tokens (user_id, token) VALUES (?, ?)");
        mysqli_stmt_bind_param($ins, "is", $user_id, $token);
        mysqli_stmt_execute($ins);

        // Send email
        $sent = sendVerificationEmail($email, $name, $token);

        if ($sent) {
            $success = true;
        } else {
            $error = "Failed to send the email. Please try again later or contact support.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareAct - Resend Verification</title>
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

.icon { font-size: 64px; margin-bottom: 20px; }

.card h2 {
    color: #536dfe;
    font-size: 24px;
    margin-bottom: 12px;
}

.card p {
    color: #555;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 24px;
}

.card input[type="email"] {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 16px;
}

.card input[type="email"]:focus {
    outline: none;
    border-color: #536dfe;
}

.btn {
    display: inline-block;
    background: #536dfe;
    color: white;
    padding: 13px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 100%;
}

.btn:hover { background: #3d57e8; }

.btn-outline {
    display: inline-block;
    background: white;
    color: #536dfe;
    border: 2px solid #536dfe;
    padding: 11px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
    margin-top: 12px;
    width: 100%;
}

.btn-outline:hover { background: #f0f2ff; }

.success-box {
    background: #e8f5e9;
    border: 1px solid #a5d6a7;
    color: #2e7d32;
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 15px;
    line-height: 1.6;
}

.error-box {
    background: #ffebee;
    border: 1px solid #ef9a9a;
    color: #c62828;
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 15px;
}

footer {
    background: #536dfe; color: white;
    text-align: center; padding: 15px 20px;
}
footer h3 { margin: 0; font-size: 18px; }
footer p  { margin: 5px 0; font-size: 14px; }
</style>
</head>
<body>

<header>
    <h1>CareAct</h1>
</header>

<div class="main">
    <div class="card">

        <?php if ($success): ?>
            <div class="icon">📧</div>
            <h2>Verification Email Sent!</h2>
            <p>A new verification link has been sent to your email address. Please check your inbox and click the link to activate your account.</p>
            <p style="color:#888;font-size:13px;">The link will expire in 24 hours. Check your spam folder if you don't see it.</p>
            <a href="login.php" class="btn">Go to Login</a>

        <?php else: ?>
            <div class="icon">📧</div>
            <h2>Resend Verification Email</h2>
            <p>Enter your email address below and we'll send you a new verification link.</p>

            <?php if ($error): ?>
            <div class="error-box">⚠️ <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="resend_verification.php">
                <input type="email" name="email"
                       placeholder="Enter your email address"
                       value="<?php echo $prefill; ?>"
                       required>
                <button type="submit" class="btn">Send Verification Email</button>
            </form>

            <a href="login.php" class="btn-outline">Back to Login</a>

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
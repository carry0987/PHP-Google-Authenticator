<?php
require dirname(__DIR__).'/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];
    if (isset($otp)) {
        //Get the stored secret from user's session
        session_start();
        $new_secret = isset($_SESSION['totp_secret']) ? $_SESSION['totp_secret'] : '';
        $google_auth = new \carry0987\Auth\GoogleAuthenticator;
        // Verify the OTP against the stored secret
        $verify = $google_auth->verifyCode($new_secret, $otp, 1); 
        if ($verify) {
            echo 'Code is valid!';
        } else {
            echo 'Code is invalid!';
        }
    } else {
        echo 'You did not enter any codes';
    }
} else {
    echo '<form method="post">';
    echo    '<input type="number" name="otp" placeholder="Enter your authentication code here">';
    echo    '<input type="submit">';
    echo '</form>';
}

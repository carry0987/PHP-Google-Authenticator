<?php
require dirname(__DIR__).'/vendor/autoload.php';

$google_auth = new \carry0987\Auth\GoogleAuthenticator;

session_start();
//Create a new secret
$new_secret = $google_auth->createSecret();
echo 'New Secret: '.$new_secret.'<br/>';

// Get QR Code URL
$qrcode_url = $google_auth->getQRCodeGoogleUrl('GoogleAuthenticatorTest', $new_secret);
echo 'Scan this QR Code with your authenticator app: <br/>';
echo '<img src="'.$qrcode_url.'" />';
echo '<br/>';
echo '<button onclick="window.location.href=\'verify.php\'">Next</button>';

//Store the new secret in user's session for later use
$_SESSION['totp_secret'] = $new_secret;

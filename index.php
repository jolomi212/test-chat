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
    </head>
    <body>
        <?php
        session_start();
        
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $_SESSION['user'] = $_POST['name'];
        }
        if (isset($_SESSION['user'])) {
            header('Location: chat.php');
        }
        ?>
        <form method="POST">
            <p>
                <input type="text" name="name" placeholder="Enter your name">
            </p>
            <button type="submit">Start Chart</button>
        </form>
    </body>
</html>

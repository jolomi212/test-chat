<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html onload="style()">

<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="style.css">

</head>

<body">
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }
    $name = $_SESSION['user'];
    ?>
    <div class="container">
        <div id="box">

        </div>
        <p>
            <textarea name="message" id="message" rows="3" cols="40"></textarea>
        </p>
        <button onclick="post_message();">Send Message</button>
        <br>
        <br>
        <button id="log" onclick="Logout();">Log Out</button>


    </div>
    </body>
    <script type="text/javascript">
        //fetch('backend.php').then((response)=>response.text()).then((data)=>alert(data));
        function sendRequest(data) {
            fetch('backend.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then((response) => response.json()).then((data) => document.getElementById('box').innerHTML = data.message);

        }
        getMessage();

        function getMessage() {
            fetch('backend.php')
                .then((response) => response.json())
                .then((data) => document.getElementById('box').innerHTML = data.message);


            setTimeout(getMessage, 20000);
        }

        function post_message() {
            const msg = document.getElementById('message');
            sendRequest({
                message: msg.value
            });

        }


        function Logout() {
            sendRequest({
                logout: true
            });
            window.location.href = "index.php";
        }


        let inactivityTime = function() {
            let time;
            window.onload = resetTime;
            document.onmousemove = resetTime;
            document.onkeypress = resetTime;

            function resetTime() {
                clearTimeout(time);
                time = setTimeout(Logout, 1800000);
            }
        };
        inactivityTime();
        const name = '<?php echo $name; ?>';
        // const username = document.getElementsByClassName(name);
        // for (const element of username) {
        //     element.style.color = "red";
        // }

        function style() {
            const username = document.getElementsByClassName(name);
            for (const element of username) {
                element.style.color = "red";
            }
            setTimeout(style, 1000);
        }
    </script>

</html>
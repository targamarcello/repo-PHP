<?php
$title = "Login";
require  "header.php";
?>
<h1>Login</h1>
    <form action="process_login.php" method="POST">
        <div>
            <label for="username">Username</label>
            <br>
            <input type="text" id="username" name="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password</label>
            <br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
<?php require "footer.php"?>

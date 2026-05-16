<?php
$title = "Register";
require "header.php";
?>
<h1>Register</h1>
<form action="process_register.php" method="POST">

    <label>
        <input type="text" name="username" placeholder="Username" required>
    </label>
    <br><br>
    <label>
        <input type="email" name="email" placeholder="Email" required>
    </label>
    <br><br>
    <label>
        <input type="password" name="pwd" placeholder="Password" required>
    </label>
    <br><br>
    <button type="submit">Register</button>
</form>
<?php require "footer.php"?>

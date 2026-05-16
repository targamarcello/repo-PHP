<?php
require "header.php";
?>
<h2>Inserisci un commento</h2>
<form action="save_comment.php" method="POST">
    <br>
    <div>
        <label for="comment_name">
            Titolo del commento
        </label><br>
        <input type="text" id="comment_name" name="comment_name" required>
    </div>
    <br>
    <div>
        <label for="comment_message">
            Commento
        </label><br>
        <textarea id="comment_message" name="comment_message" rows="5" cols="40" required></textarea>
    </div>
    <br>
    <button type="submit">Salva Commento</button>
</form>
<?php require "footer.php"; ?>
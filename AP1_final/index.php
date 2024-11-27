<?php
session_start();
if (isset($_POST['send_deco']))
{
    session_destroy();
}
?>

<form method="POST" action="acceuil.php">
Login : <input name="login"><br>
Mot de passe : <input name="mdp" type="password">
<input type="submit" value="OK" name="send_con">
</form>
<a href="oubli.php">oubli mot de passe </a> 
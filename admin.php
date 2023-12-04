<?php
include('templates/logowanie/login.php');

if(isset($_SESSION['login_user'])){
    header("location: templates/admin_loged.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kinonazwa</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <form id="form_logowanie" action="" method="post">
            <h2>Logowanie do panelu administracyjnego</h2>

            <label>Login:</label>
            <input id="name" name="username" placeholder="login" type="text" required>
            <label>Hasło:</label>
            <input id="password" name="password" placeholder="hasło" type="password" required>
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
        </form>
        </div>
        </div>
    </body>
</html>
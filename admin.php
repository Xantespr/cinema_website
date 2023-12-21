<?php
include('templates/logowanie/login.php');

if(isset($_SESSION['login_user'])){
    header("location: templates/admin_loged.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administration Panel</title>
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body>
        <div id = "form_login_center">
            <form id="form_login" action="" method="post">
                <h2>logging in to the administration panel:</h2>
                <label>Login:</label>
                <input id="name" name="username" placeholder="login" type="text" required>
                <label>Password:</label>
                <input id="password" name="password" placeholder="password" type="password" required>
                <input name="submit" type="submit" class="buttonWithHover" value=" Login ">
                <span><?php echo $error; ?></span>
            </form>
        </div>
    </body>
</html>
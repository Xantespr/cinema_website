<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c = mysqli_connect("localhost", "root", "", "dane_kino");

    $query = mysqli_query($c, "select * from login where password='" . $password . "' AND username='" . $username ."';");
    $rows = mysqli_num_rows($query);
    if ($rows == 1) {
        $_SESSION['login_user'] = $username; 
        header("location: ../admin_loged.php");
    } else {
        $error = "Nieprawidłowy login lub hasło.";
    }
    mysqli_close($c); 
}
?>
<?php
$c = mysqli_connect("localhost", "root", "", "cinema_db");
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql=mysqli_query($c, "select username from login where username='$user_check'");

$row = mysqli_fetch_assoc($ses_sql);

$login_session = $row['username'];

if(!isset($login_session)){
    mysqli_close($c);
    header('Location: ../index.php');
}
?>
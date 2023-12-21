<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $c = new mysqli("localhost", "root", "", "cinema_db");
    $stmt = $c->prepare("SELECT * FROM login WHERE password=? AND username=?");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();

    $result = $stmt->get_result();

    $rows = $result->num_rows;
    if ($rows == 1) {
        $_SESSION['login_user'] = $username; 
        header("location: ../admin_loged.php");
    } else {
        $error = "Incorrect login or password.";
    }

    $stmt->close();
    $c->close(); 
}
?>
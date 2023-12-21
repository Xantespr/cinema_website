<?php 
    $c = mysqli_connect("localhost", "root", "", "cinema_db");
    
    if ($c->connect_error) {
        die("Connection failed: " . $c->connect_error);
    }

    $selectedDay = $_POST['day'];

    $query = "SELECT showing.id, film.title, film.genre FROM `showing` JOIN film on film.id = showing.film_id WHERE DATE(`date`) = '$selectedDay' ORDER BY showing.date";

    $result = mysqli_query($c, $query);

    $films_data = array();

    while ($row = mysqli_fetch_assoc($result))
    {
        $films_data[] = $row;
    }

    echo json_encode($films_data);
    
    mysqli_close($c);
?>

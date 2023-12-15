<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Multikino</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>
<body>
    <?php include 'templates/nav.php';?>

    <div id="filmShowsContainer">
        <?php
            $c = mysqli_connect("localhost", "root", "", "cinema_db");
            $query = "SELECT title, genre, duration, description, age, film_id, movie_room_id, showing.date, language FROM `showing` join film on film.id = showing.film_id WHERE showing.id = " . $_GET['id'];
            $result = $c->query($query);
            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div id='filmBox'><img id='film_img' src='img/" . $row['film_id'] . ".jpg' alt='film photo'></div>";
                    echo "<div id='fr'><h1 id='film_str' class='film_str'>" . $row['title'] . "</h1>";
                    echo "<h4 class='film_str'>" . $row['genre'] . " | ". $row['duration'] . " min. | ". $row['age'] . "+</h1>";
                    echo "<h4 class='film_str'>" . $row['description'] . "</h4>";
                    echo "<button id='buyTicketButton'>Show film screening dates</button></div>";   
                }
            } else {
                echo "No results found.";
            }
            mysqli_close($c);               
        ?>
    </div>
    <?php include 'templates/contact.php';?>
    <?php include 'templates/footer.php';?>
</body>
    <script>
        var buyTicketButton = document.getElementById("buyTicketButton");
        buyTicketButton.addEventListener("click", function() {
            window.location.href = "buy_ticket.php?id=" + <?php echo $_GET['id']; ?>;
        });
    </script>
</html>
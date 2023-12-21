<?php include('logowanie/session.php'); ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kinonazwa</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <div id="logout_box">
        <b id="logout" class="buttonWithHover"><a href="logowanie/logout.php">logout</a></b>
    </div>

    <div id="bg_admin">
<!-- films -->
        <div class="admin_box">
            <div>
                <?php
                $c = mysqli_connect("localhost", "root", "", "cinema_db");

                $query = "SELECT id, title from film";
                $result = mysqli_query($c, $query);
                echo '<h2>On screen films:</h2>';
                echo '<table><tr><th>id</th><th>Title</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td></tr>';
                }
                echo '</table></div><div>';

                ?>
                <br><hr>
                <form class = "adminForm" method="POST" action="">
                    <h2>Add film:</h2>
                    <input type="text" placeholder="title" name="title" required><br>
                    <input type="text" placeholder="genre" name="genre" required><br>
                    <input type="number" placeholder="duration" name="duration" required><br>
                    <br>
                    <input id="btnAdd" class="buttonWithHover" type="submit" name="submit" value="Add" onclick="return confirm('Do you confirm that the entered data is correct?')">
                    <button type="clear" class="buttonWithHover buttonStyle">Cancel</button>
                    <?php
                    if (isset($_POST['submit'])) {
                        $c = mysqli_connect("localhost", "root", "", "cinema_db");
                        $query = "INSERT INTO `film` (`id`, `title`, `genre`, `duration`) VALUES (NULL, '" . $_POST['title'] . "', '" . $_POST['genre'] . "', '" . $_POST['duration'] . "');";
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                <hr>
                <form class = "adminForm" method="POST" action="">
                    <h2>Delete film</h2>
                    <input type="text" placeholder="id" name="delete" required><br>
                    <br>
                    <input type="submit" class="buttonWithHover buttonStyle" name="potw_btn1" value="delete" onclick="return confirm('Do you confirm that the entered data is correct?')">
                    <button type="clear" class="buttonWithHover buttonStyle">Cancel</button>
                    
                    <?php
                    if (isset($_POST['potw_btn1'])) {
                        $c = mysqli_connect("localhost", "root", "", "cinema_db");
                        $query = "DELETE FROM film WHERE id =" . $_POST['delete'];
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                </div>
            </div>
            
<!-- stats -->
            <div class="admin_box">
                <?php
                $query = "SELECT count(id) from showing";
                $result = mysqli_query($c, $query);
                
                echo '<hr><p>Number of upcoming shows:'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0];
                }
                $query = "SELECT (SELECT price FROM ticket WHERE type = 'Normal') * SUM(normal_ticket_quantity) + (SELECT price FROM ticket WHERE type = 'Student') * SUM(student_ticket_quantity) AS profit FROM orders WHERE orders.status = '2'";
                $result = mysqli_query($c, $query);
                echo '</p><p>Profits from future shows:'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0] . ' USD';
                }

                $query = "SELECT * FROM `ticket`";
                $result = mysqli_query($c, $query);
                echo '<h3 style:"text-align: center;">Pricing<h3>';
                echo '<table id="pricing_table"><tr><th>Ticket</th><th>Price</th></tr>'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[2] . '</td><td>' . $row[1] . '</td></tr>';
                }
                echo '</table>';
                mysqli_close($c);
                ?>
            </div>

<!-- tickets -->
            <div class="admin_box">
                <hr>
                <form class = "adminForm" method="POST" action="">
                    
                    <h2>Change the ticket price</h2>
                    <input type="float" placeholder="multiplier" name="multiplier" required><br>
                    <br>
                    <input type="submit" name="submit_btn2" class="buttonWithHover buttonStyle" value="change the price" onclick="return confirm('Do you confirm that the entered data is correct?')">
                    <button type="clear" class="buttonWithHover buttonStyle">Cancel</button>
                    <?php
                    if (isset($_POST['submit_btn2'])) {
                        $c = mysqli_connect("localhost", "root", "", "cinema_db");
                        $query = "UPDATE `ticket` SET price = price * " . $_POST['multiplier'];
                        $result = $c->query($query);
                        mysqli_close($c);
                    }
                    ?>
                </form>
            </div>
<!-- rooms -->
            <div class="admin_box">
                <?php
                $c = mysqli_connect("localhost", "root", "", "cinema_db");

                $query = "SELECT * from movie_room";
                $result = mysqli_query($c, $query);
                echo '<hr><h2>Movie rooms:</h2>';
                echo '<table><tr><th>id</th><th>rows</th><th>places in rows</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td></tr>';
                }
                echo '</table></div>';

                ?>
                
<!-- showings -->
        <div class="admin_box">
            <div>
                <?php
                $c = mysqli_connect("localhost", "root", "", "cinema_db");

                $query = "SELECT showing.id, film.title, showing.date, movie_room.id FROM `showing` join movie_room ON showing.movie_room_id = movie_room.id JOIN film on film.id = showing.film_id WHERE showing.date >= '" . date('Y-m-d') . " 00:00:00' ORDER BY showing.date";
                $result = mysqli_query($c, $query);
                echo '<p>Upcoming shows:</p>';
                echo '<table><tr><th>id</th><th>film title</th><th>date</th><th>room</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td></tr>';
                }
                echo '</table></div><div>';

                ?>
                <br><hr>
                <form class = "adminForm" method="POST" action="">
                    <h2>Add a showing</h2>
                    <input type="number" placeholder="movie room" name="room" required><br>
                    <input type="number" placeholder="film id" name="film_id" required><br>
                    <input type="datetime-local" name="date" required><br>
                    <input type="text" placeholder="language" name="language" required><br>
                    <br>
                    <input id="btnAdd" class="buttonWithHover buttonStyle" type="submit" name="potw_btn_s" value="Add" onclick="return confirm('Do you confirm that the entered data is correct?')">
                    <button type="clear" class="buttonWithHover buttonStyle">Cancel</button>
                    <?php
                    if (isset($_POST['potw_btn_s'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "INSERT INTO showing (`id`, `movie_room_id`, `film_id`, `date`, `language`) VALUES (NULL, '" . $_POST['room'] . "', '" . $_POST['film_id'] . "', '" . $_POST['date'] . "', '" . $_POST['language'] . "');";
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                <hr>
                <form class = "adminForm" method="POST" action="">
                    <h2>Delete showing</h2>
                    <input type="number" placeholder="id" name="id_delete" required><br>
                    <br>
                    <input type="submit" class="buttonWithHover buttonStyle" name="subm_btn1" value="delete" onclick="return confirm('Do you confirm that the entered data is correct?')">
                    <button type="clear" class="buttonWithHover buttonStyle">Cancel</button>
                    <?php
                    if (isset($_POST['subm_btn1'])) {
                        $c = mysqli_connect("localhost", "root", "", "cinema_db");
                        $query = "DELETE FROM seans WHERE id =" . $_POST['id_delete'];
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                </div>
            </div>
            </div>
            
        </div>

        <script>
            document.getElementById("btnAdd").addEventListener("click", () => {
                window.location.reload()
            })
        </script>

</body>

</html>


<?php include('logowanie/session.php'); ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kinonazwa</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <header style="background-color: grey; opacity: 80%;">
        <h2>Kinonazwa admin panel</h2>
    </header>

    <b id="logout"><a href="logowanie/logout.php">Wyloguj się</a></b>

    <div id="bg_admin">
<!-- filmy -->
        <div class="admin_box">
            <div id="fl">
                <?php
                $c = mysqli_connect("localhost", "root", "", "dane_kino");

                $query = "SELECT id, tytul from film";
                $result = mysqli_query($c, $query);
                echo '<p>Obecnie grane filmy:</p>';
                echo '<table><tr><th>id</th><th>nazwa</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td></tr>';
                }
                echo '</table></div><div id="fr">';

                ?>

                <form method="POST" action="">
                    <h2>Dodaj film</h2>
                    <input type="text" placeholder="tytul" name="tytul" required><br>
                    <input type="text" placeholder="gatunek" name="gatunek" required><br>
                    <input type="number" placeholder="czas trwania" name="czas" required><br>
                    <br>
                    <input id="btnDodaj" type="submit" name="potw_btn" value="Dodaj" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                    <button type="clear">Anuluj</button>
                    <?php
                    if (isset($_POST['potw_btn'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "INSERT INTO `film` (`id`, `tytul`, `gatunek`, `czas_trwania`) VALUES (NULL, '" . $_POST['tytul'] . "', '" . $_POST['gatunek'] . "', '" . $_POST['czas'] . "');";
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                <hr>
                <form method="POST" action="">
                    <h2>Usuń film</h2>
                    <input type="text" placeholder="id" name="id_usun" required><br>
                    <br>
                    <input type="submit" name="potw_btn1" value="Usuń" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                    <button type="clear">Anuluj</button>
                    <?php
                    if (isset($_POST['potw_btn1'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "DELETE FROM film WHERE id =" . $_POST['id_usun'];
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                </div>
            </div>
<!-- statystyki -->
            <div class="admin_box">
                <?php
                $query = "SELECT count(id) from seans";
                $result = mysqli_query($c, $query);
                
                echo '<p>Liczba nadchodzących seansów:'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0];
                }
                $query = "SELECT sum(bilet.cena) from zamowienie join bilet on bilet.id = zamowienie.bilet_id where zamowienie.status = '1'";
                $result = mysqli_query($c, $query);
                echo '</p><p>Zyski z nadchodzących seansów:'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0] . ' pln';
                }

                $query = "SELECT * FROM `bilet`";
                $result = mysqli_query($c, $query);
                echo '<h3 style:"text-align: center;">Cennik<h3>';
                echo '<table id="cennik_table"><tr><th>bilet</th><th>cena</th></tr>'; 
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[2] . '</td><td>' . $row[1] . '</td></tr>';
                }
                echo '</table>';
                mysqli_close($c);
                ?>
            </div>

<!-- bilety -->
            <div class="admin_box">
                <form method="POST" action="">
                    <h2>Zmień cenę biletu</h2>
                    <input type="float" placeholder="mnożnik" name="cena_mnoz" required><br>
                    <br>
                    <input type="submit" name="potw_btn2" value="Zmień cenę" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                    <button type="clear">Anuluj</button>
                    <?php
                    if (isset($_POST['potw_btn2'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "UPDATE `bilet` SET cena = cena * " . $_POST['cena_mnoz'];
                        $result = $c->query($query);
                        mysqli_close($c);
                    }
                    ?>
                </form>
            </div>
<!-- sale -->
            <div class="admin_box">
                <?php
                $c = mysqli_connect("localhost", "root", "", "dane_kino");

                $query = "SELECT * from sala";
                $result = mysqli_query($c, $query);
                echo '<p>Sale:</p>';
                echo '<table><tr><th>id</th><th>rzędy</th><th>miejsca w rzędach</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td></tr>';
                }
                echo '</table></div>';

                ?>
                
<!-- seanse -->
        <div class="admin_box">
            <div id="fl">
                <?php
                $c = mysqli_connect("localhost", "root", "", "dane_kino");

                $query = "SELECT seans.id, film.tytul, seans.data, sala.id FROM `seans` join sala ON seans.id_sali = sala.id JOIN film on film.id = seans.id_filmu WHERE seans.data >= '" . date('Y-m-d') . " 00:00:00' ORDER BY seans.data";
                $result = mysqli_query($c, $query);
                echo '<p>Nadchodzące seanse:</p>';
                echo '<table><tr><th>id</th><th>nazwa filmu</th><th>data</th><th>sala</th></tr>';

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td></tr>';
                }
                echo '</table></div><div id="fr">';

                ?>

                <form method="POST" action="">
                    <h2>Dodaj seans</h2>
                    <input type="number" placeholder="numer sali" name="sala" required><br>
                    <input type="number" placeholder="id filmu" name="film_id" required><br>
                    <input type="datetime-local" name="data" required><br>
                    <input type="text" placeholder="język seansu" name="jezyk" required><br>
                    <br>
                    <input id="btnDodaj" type="submit" name="potw_btn_s" value="Dodaj" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                    <button type="clear">Anuluj</button>
                    <?php
                    if (isset($_POST['potw_btn_s'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "INSERT INTO seans (`id`, `id_sali`, `id_filmu`, `data`, `jezyk`) VALUES (NULL, '" . $_POST['sala'] . "', '" . $_POST['film_id'] . "', '" . $_POST['data'] . "', '" . $_POST['jezyk'] . "');";
                        $result = $c->query($query);
                        mysqli_close($c);
                        header("templates/admin_loged.php");
                    }
                    ?>
                </form>
                <hr>
                <form method="POST" action="">
                    <h2>Usuń seans</h2>
                    <input type="number" placeholder="id" name="id_usun" required><br>
                    <br>
                    <input type="submit" name="potw_btn1" value="Usuń" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                    <button type="clear">Anuluj</button>
                    <?php
                    if (isset($_POST['potw_btn1'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "DELETE FROM seans WHERE id =" . $_POST['id_usun'];
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
            document.getElementById("btnDodaj").addEventListener("click", () => {
                window.location.reload()
            })
        </script>

</body>

</html>


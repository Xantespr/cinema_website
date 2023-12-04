<main id="filmy">
    <table id="film_grid">
    <tr id = "dates">
    <?php 
        $c = mysqli_connect("localhost", "root", "", "dane_kino");
        
        $query = "SELECT seans.id, film.tytul, film.gatunek, film.czas_trwania, seans.data, sala.id FROM `seans` join sala ON seans.id_sali = sala.id JOIN film on film.id = seans.id_filmu ORDER BY seans.data";

        $result = mysqli_query($c, $query);
        $day = "";
        $month = "";

        while ($row = mysqli_fetch_array($result))
        {
            $timestamp = strtotime($row[4]);
            $date = date("d-m-y", $timestamp);
            if ($day != date("d", $timestamp))
            {
                $day = date("d", $timestamp);
                echo '<th onclick="selectDay(this)" class="' . $date . ' day">' . $day . '</th>';
            }
            $day = date("d", $timestamp);
        }

        echo '</tr>';

        $result = mysqli_query($c, $query);

        while ($row = mysqli_fetch_array($result))
        {
            $timestamp = strtotime($row[4]);
            $date = date("d-m-y", $timestamp);
            echo '<tr onclick="kup_bilet('. $row[0] . ',' . $row[5] . ')" ><td colspan="7" class="seans ' . $date . '">' . $row[2] . '</td></tr>';
        }

        mysqli_close($c);
    ?>

    <tr><td colspan="7" class="active">123213</td></tr>
    </table>
</main>

<script>
    document.getElementsByClassName("day")[0].classList.add("active");


    function selectDay(clickedElement){
        var days = document.getElementsByClassName("day");
        for (var i = 0; i < days.length; i++){
            days[i].classList.remove("active");
        }
        clickedElement.classList.add("active");

        var seanse = document.getElementsByClassName("seans");

        for (var i = 0; i < seanse.length; i++){
            if (seanse[i].classList[1] == clickedElement.classList[0]){
                seanse[i].style.display = "block";
                seanse[i].setAttribute("colspan", document.getElementsByClassName("day").length);
            }
            else{
                seanse[i].style.display = "none";
            }
        }
    }

    selectDay(document.getElementsByClassName("day")[0]);
</script>
    
    
<!--     
    // $query = "SELECT seans.id, film.tytul, film.gatunek, film.czas_trwania, seans.data, sala.id FROM `seans` join sala ON seans.id_sali = sala.id JOIN film on film.id = seans.id_filmu WHERE seans.data >= '" . date('Y-m-d') . " 00:00:00' ORDER BY seans.data";
    
    // $date_query = "SELECT seans.data From seans ORDER BY seans.data limit 1";
    // $result = mysqli_query($c, $date_query);
    // $row = mysqli_fetch_array($result);
    // $timestamp = strtotime($row[0]);
    // $day = date("d", $timestamp);

    // while ($row = mysqli_fetch_array($result))
    // {
    //     echo '<div id="film_box'. $row[0] .'" class="film_box" onclick="kup_bilet('. $row[0] . ',' . $row[5] . ')">';
    //     echo '<h5 id="nazwa_filmu'. $row[0] .'">' . $row[1] . '</h5>';
    //     echo '<p>Rodzaj: ' . $row[2] . '</p>';
    //     echo '<p>Czas trwania: ' . $row[3] . ' min</p>';
    //     echo '<p id="date'. $row[0] .'">Data: ' . $row[4] . ' </p>';
    //     echo '</div>';
    // } -->

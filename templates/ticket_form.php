<div id="formularz_bilety">
    <form method="POST" action="">
            <div id="fl">
                <img id="film_img" src="" alt="zdjecie">
            </div>
            <div id="fr">
                <h2>Podaj dane do biletu</h2>
                <h1 id="film_str"></h1>
                <h4 id ="date_str"></h4>
                <h4 id="sala_str">Sala numer: </h4>
                <input type="text" id="id_seans" name="id_seans" style="display: none;"><br>
                <hr>
                <h3>Podaj dane do biletu</h3>
                
                <label><b>Imię</b></label><br>
                <input type="text" placeholder="Wprowadź imię" name="name" required><br>

                <label><b>Nazwisko</b></label><br>
                <input type="text" placeholder="Wprowadź nazwisko" name="surname" required><br>

                <label><b>Email</b></label><br>
                <input type="text" placeholder="Wprowadź email" name="email" required><br>

                <label><b>Numer telefonu</b></label><br>
                <input type="text" placeholder="Podaj nr. tel." name="tel_num" required><br>
                <label><b>Rodzaj biletu:</b></label><br>

                <select name="rodz_biletu">
                    <option value="2" selected="selected">normalny</option>
                    <option value="1">ulgowy</option>
                </select>

                <br>
                <br>
                <input type="submit" name="potw_btn" value="Potwierdź" onclick="return confirm('Potwierdzasz poprawność wpisanych danych?')">
                <button type="clear" onclick="anuluj()">Anuluj</button>
            </div>
    </form>
</div>

    <?php
	if (isset($_POST['potw_btn'])) {
        $c = mysqli_connect("localhost", "root", "", "dane_kino");
        $query = "INSERT INTO `zamowienie` (`id`, `id_seansu`, `imie`, `nazwisko`, `email`, `telefon`, `status`, `bilet_id`) VALUES (NULL, '" . $_POST['id_seans'] . "', '" . $_POST['name'] ."', '" . $_POST['surname'] ."', '" . $_POST['email'] ."', '" . $_POST['tel_num'] ."', '0', '" . $_POST['rodz_biletu'] ."');";
        $result = $c->query($query);
        mysqli_close($c);
    } 
    ?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Kinonazwa</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
	<header>
		<h2>Kinonazwa</h2>
	</header>

    <nav>
        <a href="../index.php">Strona główna</a>
        <a href="../index.php#filmy">Lista filmów</a>
        <a href="../index.php#kontakt">Kontakt</a>
        <a class="active" href="zap_bilet.php">Zapłać bilet</a>

    </nav>   
        <div id="zap_b">
            <form method="POST" action="">
                <h2>Podaj imię i nazwisko podane na bilecie</h2>

                <label><b>Imię</b></label><br>
                <input type="text" placeholder="Wprowadź imię" name="name" required><br>

                <label><b>Nazwisko</b></label><br>
                <input type="text" placeholder="Wprowadź nazwisko" name="surname" required><br>
                <br>
                <input type="submit" name="szukaj" value="Wyszukaj" onclick="">
            </form>
                <br><br>
                <table>
                    <tr>
                        <th>Opłać</th>
                        <th>ID zamówienia</th>
                        <th>Nazwa filmu</th>
                        <th>Data seansu</th>
                        <th>Cena biletu</th>
                        <th>status</th>
                    </tr>     
                <?php
                    if (isset($_POST['szukaj'])) {
                        $c = mysqli_connect("localhost", "root", "", "dane_kino");
                        $query = "SELECT zamowienie.id, film.tytul, seans.data, bilet.cena, zamowienie.status FROM `zamowienie` JOIN seans on zamowienie.id_seansu = seans.id JOIN film on film.id = seans.id_filmu join bilet on bilet.id = zamowienie.bilet_id WHERE `imie` = '" . $_POST['name'] . "' AND `nazwisko` = '" . $_POST['surname'] ."'";
                        $result = mysqli_query($c, $query);
                        while ($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            $status = $row[4];
                            if($status == 0){
                                $status = "Oczekiwanie na opłatę.";
                                echo "<td><button onclick='zaplac(" . $row[0] . ")' name='zaplac'>Naciśnij aby zapłacić</button></td>";
                            }
                            else{
                                $status = "Zapłacono.";
                                echo "<td></td>";
                            }                            
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . " zł</td>";
                            echo "<td>$status</td>";
                            echo '</tr>';
                        }
                        mysqli_close($c);
                    } 

                ?>
            </table>
            <form method="POST" action="" style="display: none;"><input type="number" name="clicked_id" id="clicked_id"><input type="submit" name="oplata" id="oplata"></form>
        </div>
    
        <?php
	        if(isset($_POST['oplata'])) { 
                $c = mysqli_connect("localhost", "root", "", "dane_kino");
                $query = "UPDATE `zamowienie` SET `status`='1' WHERE `id`='" . $_POST['clicked_id'] . "'";
                $result = $c->query($query);

                $sql = "SELECT zamowienie.id, imie, nazwisko, email, telefon, film.tytul, film.gatunek, seans.data, film.czas_trwania, sala.id, seans.jezyk, bilet.rodzaj, bilet.cena FROM `zamowienie` join seans on zamowienie.id_seansu = seans.id JOIN film on film.id = seans.id_filmu JOIN bilet on bilet.id = zamowienie.bilet_id join sala on sala.id = seans.id_sali WHERE zamowienie.id = " . $_POST['clicked_id'] . ";";
                $result = mysqli_query($c, $sql);
                $row = mysqli_fetch_array($result);
                //PDF
                require('../fpdf/fpdf.php');
                ob_clean();

                class PDF extends FPDF {
                  
                    function Header() {
                        $this->Image('../img/favicon.png',10,8,18);
                        $this->SetFont('Arial','B',20);
                        $this->Cell(80);
                        $this->Cell(50,10,'KINONAZWA',1,0,'C');
                        $this->Ln(20);
                    }
                  
                    function Footer() {
                        $this->SetY(-15);
                        $this->SetFont('Arial','I',8);
                        $this->Cell(0,10,'Strona ' . 
                        $this->PageNo() . '/{nb}',0,0,'C');
                    }
                }
                  
                $pdf = new PDF();
                  
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Times','',14);
                
                $pdf->Cell(0, 10, utf8_decode('Zamówienie numer: ' . $row[0]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Imie i nazwisko: ' . $row[1] . ' ' . $row[2]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Adres email:  ' . $row[3]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Numer telefonu: ' . $row[4]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Tytul filmu: ' . $row[5]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Jezyk: ' . $row[10]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Gatunek: ' . $row[6]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Data seansu: ' . $row[7]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Sala numer: ' . $row[9]), 1, 1);
                $pdf->Cell(0, 10, utf8_decode('Rodzaj biletu i cena: ' . $row[11] . ' - ' . $row[12] . 'pln'), 1, 1);


                $pdf->Output("D", "Kinonazwa_$row[1]_$row[2].pdf");



                ob_end_flush();
                
                $to      = $row[3];
                $subject = $row[5] . ' - bilety';
                $message = 'Dzień dobry! Właśnie opłaciłeś bilety w kinie Kinonazwa na seans: '. $row[5] .'. Id twojego zazmówienie to: '. $row[0] .'. Życzymy miłego seansu!';
                $headers = 'From: Kinonazwa@example.com'       . "\r\n" .
                            'Reply-To: Kinonazwa@example.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                mysqli_close($c);
            } 
    ?>
    

    <?php include 'footer.php';?>
</body>

<script>
    function zaplac(id){
        document.getElementById("clicked_id").value = id;
        document.getElementById("oplata").click();
    }
    
</script>

</html>


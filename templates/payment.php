<?php
ob_start();

if (isset($_POST['confirmBtn'])) {
    $c = mysqli_connect("localhost", "root", "", "cinema_db");
    $order_id = mysqli_real_escape_string($c, $_GET['order_id']);

    $sql = "SELECT orders.id, `name`, surname, email, phone, film.title, film.genre, showing.date, movie_room.id, showing.language, orders.student_ticket_quantity, orders.normal_ticket_quantity FROM `orders` join showing on orders.showing_id = showing.id JOIN film ON film.id = showing.film_id JOIN movie_room ON movie_room.id = showing.movie_room_id WHERE orders.id = " . $order_id;
    $result = mysqli_query($c, $sql);
    $row = mysqli_fetch_array($result);

    // PDF generation
    require('../fpdf/fpdf.php');

    class PDF extends FPDF {
        function Header() {
            $this->Image('../img/favicon.png',10,8,18);
            $this->SetFont('Arial','B',20);
            $this->Cell(80);
            $this->Cell(70,10,'Starview Cinema',1,0,'C');
            $this->Ln(20);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page ' . $this->PageNo() . '/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',14);

    $pdf->Cell(0, 10, utf8_decode('Order id: ' . $row[0]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Name and surname: ' . $row[1] . ' ' . $row[2]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('E-mail:  ' . $row[3]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Phone number: ' . $row[4]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('film title: ' . $row[5]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Language: ' . $row[9]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Genre: ' . $row[6]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Showing date: ' . $row[7]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Movie room number: ' . $row[8]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Student tickets: ' . $row[10]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('Normal tickets: ' . $row[11]), 1, 1);

    // Download PDF
    $pdfContent = $pdf->Output("", "S");
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Starview_Cinema_' . $row[1] . '_' . $row[2] . '.pdf"');
    echo $pdfContent;
    ob_end_flush();
    mysqli_close($c);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multikino</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>
<body>
    <?php include 'nav.php';?>
    <div id="payment_container">
        <h2 id="payment_str">Right now we cannot proceed with online payments, so you just need to click the button below and pay in the cinema before your showing. In the case you won't click the button below, your order will be canceled after 30 min.</h2>
        <form method="post" action="">
            <button type="submit" name="confirmBtn" class="buttonWithHover" onclick="confirmReservation()">Confirm reservation</button>
        </form>
    </div>
</body>

<script>
    document.querySelector('.active').classList.remove('active');

    function confirmReservation() {
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('order_id');

        // Send an AJAX request to update the value in the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../php_scripts/update_order.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                payment_container.innerHTML = '<h2 id="payment_str">Your reservation has been confirmed. See you in the cinema!</h2>';
            } else {
                console.error('Error:', xhr.status);
            }
        };
        xhr.send('order_id=' + orderId);
    }
</script>
</html>

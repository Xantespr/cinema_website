<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Kinonazwa</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
	<header>
		<h2>Multikino</h2>
	</header>

    <nav>
        <a class="active" href="index.php">Strona główna</a>
        <a href="#filmy">Lista filmów</a>
        <a href="#kontakt">Kontakt</a>
        <a href="templates/zap_bilet.php">Zapłać bilet</a>
    </nav>

    <div id = "news">
        <h1>W budowie ##NEWSY##</h1>
    </div>

    <?php include 'templates/ticket_form.php';?>
    <?php include 'templates/main.php';?>
    <?php include 'templates/contact.php';?>
    <?php include 'templates/footer.php';?>
</body>

<script>
    function kup_bilet(id, nr_sali) {
        // ticket_form
        document.getElementById("formularz_bilety").style.display = "block";
        document.getElementById("sala_str").textContent = "Sala numer: " + nr_sali;
        document.getElementById("film_str").textContent = document.getElementById("nazwa_filmu"+id).textContent
        document.getElementById("date_str").textContent = document.getElementById("date"+id).textContent
        document.getElementById("id_seans").value = id
        document.getElementById("film_img").src  = 'img/' + document.getElementById("film_str").textContent + '.jpg'; 
    }

    function anuluj() {
        document.getElementById("formularz_bilety").style.display = "none";
    }
    
</script>

</html>


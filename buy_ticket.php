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
        
        <h1>Daty</h1>

        <?php
        echo "<table>";
        // Get the film ID from the URL
        $filmId = $_GET['id'];
        
        $c = mysqli_connect("localhost", "root", "", "cinema_db");
        $query = "SELECT film_id FROM `showing` WHERE showing.id = " . $_GET['id'];
        $result = $c->query($query);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filmId = $row['film_id'];
                $query = "SELECT date, language FROM `showing` WHERE film_id = " . $filmId . " ORDER BY date ASC";
                $result = $c->query($query);
                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $dateTimeObject = new DateTime($row['date']);
                        $dateTimeObject = $dateTimeObject->format('d F H:i');
                        echo "<tr class='seans' onclick='showForm(this)'><td>" . $dateTimeObject . " language - " . $row['language'] . "</td></tr>";
                    }
                } else {
                    echo "No results found.";
                }
            }
        } else {
            echo "No results found.";
        }
        mysqli_close($c);  
        ?>
        </table>
        <!-- <?php include 'templates/contact.php';?> -->
        <!-- <?php include 'templates/footer.php';?> -->
    </body>
    <script>
        var openForm = null;

        function showForm(row) {
            if (openForm !== null && openForm !== row.nextElementSibling) {
                openForm.style.display = 'none';
            }

            
            if (row.nextElementSibling && row.nextElementSibling.classList.contains('formRow')) {
                row.nextElementSibling.style.display = 'table-row';
                openForm = row.nextElementSibling;
            } else {
                var formRow = document.createElement("tr");
                formRow.classList.add('formRow');
                var formCell = document.createElement("td");
                var form = document.createElement("form");
                form.innerHTML = `
                    <label for="clientName">Client Name:</label>
                    <input type="text" id="clientName" name="clientName" required>
                    <br>
                    <label for="clientSurname">Surname:</label>
                    <input type="text" id="clientSurname" name="clientSurname" required>
                    <br>
                    <label for="clientEmail">E-mail:</label>
                    <input type="email" id="clientEmail" name="clientEmail" required>
                    <br>
                    <label for="phoneNumber">Phone number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="123456789" pattern="[0-9]{9}" required>
                    <br>
                    <label for="ticketType">Ticket Type:</label>
                    <select id="ticketType" name="ticketType">
                        <option value="1">Normal</option>
                        <option value="2">VIP</option>
                    </select>
                    <br>
                    <input type="submit" value="Submit">
                `;
                formCell.appendChild(form);
                formRow.appendChild(formCell);
                row.parentNode.insertBefore(formRow, row.nextSibling);
                openForm = formRow;
            }
        }
    </script>
    <?php
            if (isset($_POST['Submit'])) {
                $c = mysqli_connect("localhost", "root", "", "cinema_db");
                $query = "INSERT INTO `order` (`id`, `showing_id`, `name`, `surname`, `email`, `phone`, `status`, `ticket_id`) VALUES (NULL, '" . $_POST['id_seans'] . "', '" . $_POST['name'] ."', '" . $_POST['surname'] ."', '" . $_POST['email'] ."', '" . $_POST['tel_num'] ."', '0', '" . $_POST['rodz_biletu'] ."');";
                $result = $c->query($query);
                mysqli_close($c);
            } 
    ?>
</html>

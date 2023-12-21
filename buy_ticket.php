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
        <div id="body_wrap">
        
        <h1 id = "string">Seans dates:</h1>

        <?php
        echo "<table>";
        $filmId = $_GET['id'];
        
        $c = mysqli_connect("localhost", "root", "", "cinema_db");
        $query = "SELECT film_id FROM `showing` WHERE showing.id = " . $_GET['id'];
        $result = $c->query($query);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filmId = $row['film_id'];
                $query = "SELECT showing.id, showing.date, showing.language, movie_room.rows, movie_room.places_in_row FROM `showing` join movie_room on movie_room.id = showing.movie_room_id WHERE film_id = " . $filmId . " ORDER BY date ASC";
                $result = $c->query($query);
                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $dateTimeObject = new DateTime($row['date']);
                        $dateTimeObject = $dateTimeObject->format('d F H:i');
                        echo "<tr class='seans' onclick='showForm(this," . $row['rows'] . "," . $row['places_in_row'] . "); setUrlParameter(" . $row['id'] . ")'><td> " . $dateTimeObject . " language - " . $row['language'] . "</td></tr>";
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
    </div>
    </body>

    <?php
    if (isset($_POST['buyTicketSubmit'])) {
        $c = mysqli_connect("localhost", "root", "", "cinema_db");
        if ($c->connect_error) {
            die("Connection failed: " . $c->connect_error);
        }
        do{
            $order_id = "";
            for ($i = 0; $i < 9; $i++) {
                $order_id .= rand(0, 9);
            }
            $query = "SELECT * FROM `orders` WHERE id = " . $order_id;
            $result = $c->query($query);
        }
        while ($result->num_rows > 0);

        $query = "INSERT INTO `orders` (`id`, `showing_id`, `name`, `surname`, `email`, `phone`, `status`, `normal_ticket_quantity`, `student_ticket_quantity`, `seat`) 
        VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, ?)";
        $orderId = $order_id;
        $showingId = $_GET['show'];
        $name = $_POST['clientName'];
        $surname = $_POST['clientSurname'];
        $email = $_POST['clientEmail'];
        $phone = $_POST['phoneNumber'];
        $ticketQuantityNormal = $_POST['ticketQuantityNormal'];
        $ticketQuantityStudent = $_POST['ticketQuantityStudent'];
        $chosenSeats = json_encode($_POST['chosenSeats']);
        $stmt = $c->prepare($query);
        $stmt->bind_param("iisssiiis", $orderId, $showingId, $name, $surname, $email, $phone, $ticketQuantityNormal, $ticketQuantityStudent, $chosenSeats);
        if ($stmt->execute()) {
            mysqli_close($c);
            header("Location: templates/payment.php?order_id=$orderId");
            die();
        } else {
            echo "Error: " . $stmt->error;
            mysqli_close($c);
        }
        
    }
    
    ?>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.querySelector('ul li:nth-child(2) a').classList.add('active');

        let chosenSeats = [];

        async function seatMap(numRows, numColumns) {
            var seatMapContainer = document.getElementById("seatMapContainer");
            let urlParams = new URLSearchParams(window.location.search);
            let paramValue = urlParams.get('show');
            // Fetch JSON array from the server
            let response = await fetch(`php_scripts/fetch_seats.php?show=${paramValue}`);
            let data = await response.json();

            let reservedSeats = data.reservedSeats.flatMap(seats => JSON.parse(seats));
            console.log(reservedSeats);
            // Toggle visibility of seat map container
            seatMapContainer.style.visibility = seatMapContainer.style.visibility === "visible" ? "hidden" : "visible";

            if (seatMapContainer.style.visibility === "visible") {
                seatMapContainer.innerHTML = "";
                
                var hideButton = document.createElement("button");
                hideButton.textContent = "Hide Seat Map";
                hideButton.addEventListener("click", function() {
                    seatMapContainer.style.visibility = "hidden";
                    event.preventDefault();
                });
                hideButton.classList.add("buttonWithHover");
                seatMapContainer.appendChild(hideButton);
                // Add screen before the first row
                var screen = document.createElement("div");
                screen.classList.add("screen");
                screen.textContent = "Screen";
                seatMapContainer.appendChild(screen);

                for (var row = 1; row <= numRows; row++) {
                    var rowContainer = document.createElement("div");
                    rowContainer.classList.add("seat-row");

                    for (var col = 1; col <= numColumns; col++) {
                        var seatNumber = row + String.fromCharCode(64 + col); // Convert column to letter
                        var seatDiv = document.createElement("div");
                        seatDiv.classList.add("seat");
                        seatDiv.textContent = seatNumber;

                        if (chosenSeats.includes(seatNumber)) {
                            seatDiv.classList.add("chosen");
                        }

                        if (reservedSeats.includes(seatNumber)) {
                            seatDiv.classList.add("reserved");
                        }

                        // Add a click event listener to each seat
                        seatDiv.addEventListener("click", function () {
                            var normalTicket = document.getElementsByName("ticketQuantityNormal")[0];
                            var studentTicket = document.getElementsByName("ticketQuantityStudent")[0];
                            if (this.classList.contains("reserved")) {
                                alert("This seat is already reserved!");
                                return;
                            }
                            if (this.classList.contains("chosen")) {
                                this.classList.remove("chosen");
                                if (studentTicket.value > 0) {
                                    studentTicket.value--;
                                } else {
                                    normalTicket.value--;
                                }
                                // Remove seat from chosenSeats array
                                chosenSeats = chosenSeats.filter(seat => seat !== this.textContent);
                            } else {
                                this.classList.add("chosen");
                                normalTicket.value++;
                                // Add seat to chosenSeats array
                                chosenSeats.push(this.textContent);
                            }
                        });

                        rowContainer.appendChild(seatDiv);
                    }

                    seatMapContainer.appendChild(rowContainer);
                }
            }
        }

        function showForm(row, numRows, numColumns) {
            // Check if there is an existing openForm
            if (openForm && openForm !== row.nextElementSibling) {
                openForm.parentNode.removeChild(openForm);
                chosenSeats = [];
            }

            if (row.nextElementSibling && row.nextElementSibling.classList.contains('formRow') && row.nextElementSibling.style.display === 'table-row') {
                row.nextElementSibling.style.display = 'none';
                openForm.parentNode.removevChild(openForm);
                chosenSeats = [];
                openForm = null;
            } else if (row.nextElementSibling && row.nextElementSibling.classList.contains('formRow')) {
                row.nextElementSibling.style.display = 'table-row';
                openForm = row.nextElementSibling;
            } else {
                var numRows = numRows;
                var numColumns = numColumns;
                var formRow = document.createElement("tr");
                formRow.classList.add('formRow');
                formRow.style.display = 'table-row';
                var formCell = document.createElement("td");
                var form = document.createElement("form");
                form.method = "post";
                form.id = "buyTicketForm";
                form.innerHTML = `
                    <label for="clientName">Client Name:</label>
                    <input type="text" id="clientName" name="clientName" placeholder="John" required>
                    <br>
                    <label for="clientSurname">Surname:</label>
                    <input type="text" id="clientSurname" name="clientSurname" placeholder="Smith" required>
                    <br>
                    <label for="clientEmail">E-mail:</label>
                    <input type="email" id="clientEmail" name="clientEmail" placeholder="jsmith@lorem.com" required>
                    <br>
                    <label for="phoneNumber">Phone number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="123456789" pattern="[0-9]{9}" required>
                    <br>
                    <div class="button-row">
                        <button id="seatMapBtn" class="buttonWithHover" type="button">Select seat from map</button>
                        <button id="+Sbtn" class="buttonWithHover" type="button">+Student</button>
                        <button id="+Nbtn" class="buttonWithHover" type="button">+Normal</button>
                    </div>                    
                    <label for="ticketQuantityStudent">Ticket Type Student:</label><input type="number" class="ticketQuantity" name="ticketQuantityStudent" value = "0" readonly="readonly">
                    <label for = "ticketQuantityNormal">Ticket Type Normal:</label><input type="number" class="ticketQuantity" name="ticketQuantityNormal" value = "0" readonly="readonly">

                    <div id="seatMapContainer"></div>
                    <input type="hidden" id="chosenSeats" name="chosenSeats">
                    <input class="buttonWithHover" type="submit" name="buyTicketSubmit" value="Submit">
                `;
                formCell.appendChild(form);
                formRow.appendChild(formCell);
                row.parentNode.insertBefore(formRow, row.nextSibling);


                document.getElementById('buyTicketForm').addEventListener('submit', function() {
                    document.getElementById('chosenSeats').value = JSON.stringify(chosenSeats);
                });
                document.getElementsByName('buyTicketSubmit')[0].addEventListener('click', function() {
                    if (chosenSeats.length < 1) {
                        alert("You must choose at least one seat!");
                        event.preventDefault(); 
                        return false;
                    }
                });
                document.getElementById("+Nbtn").addEventListener('click', addNormal);
                document.getElementById("+Sbtn").addEventListener('click', addStudent);
                document.getElementById("seatMapBtn").addEventListener('click', function() { seatMap(numRows, numColumns); });

                openForm = formRow;
            }
        }

        var openForm = null;

        function setUrlParameter(id) {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('show', id);
            window.history.replaceState({}, '', currentUrl);
        }
        
        function addNormal(event){
            event.preventDefault();

            var tickets = chosenSeats.length;
            var normalTicket = document.getElementsByName("ticketQuantityNormal")[0];
            var studentTicket = document.getElementsByName("ticketQuantityStudent")[0];
            if (normalTicket.value == tickets) {
                if (normalTicket.value == 0)
                {
                    alert("First select your seats from 'Select seat from map' !");
                }
                else{
                    alert("You can't have more tickets than seats!");
                }
            }
            else{
                if (normalTicket.value + studentTicket.value == 1) {
                    studentTicket.value = 0;
                    normalTicket.value = 1;
                }
                else if (studentTicket.value <= 0) {
                    alert("You can't have less than 0 tickets!");
                }
                else {
                    studentTicket.value--;
                    normalTicket.value++;
                }
            }   

            return false;
        }

        function addStudent(event){
            event.preventDefault();
            var tickets = chosenSeats.length;
            var normalTicket = document.getElementsByName("ticketQuantityNormal")[0];
            var studentTicket = document.getElementsByName("ticketQuantityStudent")[0];
            if (studentTicket.value == tickets) {
                if (studentTicket.value == 0)
                {
                    alert("First select your seats from 'Select seat from map' !");
                }
                else{
                    alert("You can't have more tickets than seats!");
                }
            }
            else{
                if (normalTicket.value + studentTicket.value == 1) {
                    normalTicket.value = 0;
                    studentTicket.value = 1;
                }
                else if (normalTicket.value <= 0) {
                    alert("You can't have less than 0 tickets!");
                }
                else {
                    studentTicket.value++;
                    normalTicket.value--;
                }
            } 

            return false;
        }
    </script>
</html>
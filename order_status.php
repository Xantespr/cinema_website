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
            <div id = "order_status_form">
                <form method="POST" action="">
                    <label for="order_id">Check your order status, input ORDER ID you have recived on your e-mail:</label>
                    <br>
                    <input type="text" id = "order_id" name = "order_id" pattern = "[0-9]{9}" placeholder = "123456789" required>
                    <br>
                    <input id = "buyTicketButton" type = "submit" value = "Check Status">
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $order_id = $_POST["order_id"];
                    $c = mysqli_connect("localhost", "root", "", "cinema_db");
                    $query = "SELECT status.status FROM `orders` join status on orders.status = status.id WHERE orders.id = $order_id";
                    $result = $c->query($query);

                    if ($result) {
                        $row = $result->fetch_assoc();
                        if ($row) {
                            $status = $row['status'];
                            echo "<div id='order_status_str' class='$status'>Order Status: $status</div>";
                        } else {
                            echo "<div id='order_status_str' class='errorStr'>Status not found for order ID: $order_id</div>";
                        }
                    } else {
                        echo "<div id='order_status_str' class='errorStr'>Error executing query: $c->error</div>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
    <script>
        document.querySelector('.active').classList.remove('active');
        document.querySelector('ul li:last-child a').classList.add('active');
    </script>
</html>


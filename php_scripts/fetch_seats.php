<?php
$c = mysqli_connect("localhost", "root", "", "cinema_db");

if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($c, "SELECT seat FROM orders WHERE showing_id = ?");

if (!$stmt) {
    die("Error in statement preparation: " . mysqli_error($c));
}
mysqli_stmt_bind_param($stmt, "i", $_GET['show']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error in getting result: " . mysqli_error($c));
}

// Convert JSON-encoded data to an array of strings
$reservedSeats = array();
while ($row = mysqli_fetch_assoc($result)) {
    $seatData = json_decode($row['seat'], true);

    // Check if $seatData is an array
    if (is_array($seatData)) {
        // Merge the arrays
        $reservedSeats = array_merge($reservedSeats, $seatData);
    } else {
        $reservedSeats[] = $seatData;
    }
}

// Return the array of strings
header('Content-Type: application/json');
echo json_encode(array('reservedSeats' => $reservedSeats));
?>

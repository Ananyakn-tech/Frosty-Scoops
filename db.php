<?php
$conn = mysqli_connect("localhost", "root", "", "frosty_scoop");
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>

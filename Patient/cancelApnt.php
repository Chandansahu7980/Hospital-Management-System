<?php
$id = $_GET['id'];

include './../DB/config.php';

if ($conn->query("UPDATE `apnts` SET `status`='cancelled' WHERE id='$id'")) {
    echo "<script>alert('Appointment Cancelled Successfully.')</script>";
    echo "<script>window.location.href='./patient.php'</script>";
}

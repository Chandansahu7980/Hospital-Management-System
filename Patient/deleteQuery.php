<?php
include './../DB/config.php';

if ($conn->query("DELETE FROM `queries` WHERE id=" . $_GET['id'])) {
    echo "<script>alert('Query Deleted.');window.location.href='patient.php'</script>";
}

<?php
include './../DB/config.php';

if ($conn->query("UPDATE apnts SET status='expired' WHERE status='active' AND date <= CURRENT_DATE;")) {
    echo "<script>alert('Expired Appoinments Update Success')</script>";
} else {
    echo "<script>alert('Expired Appoinments Update Failed')</script>";
}

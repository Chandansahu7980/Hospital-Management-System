<?php
session_name("doctor_session");
session_start();

if ($_SESSION['dId']) {
    include './config.php';
    $sqlStsUpdate = "UPDATE `patient` SET `treatment_status`='" . $_POST['status'] . "' WHERE id='" . $_POST['pId'] . "'";
    if ($conn->query($sqlStsUpdate)) {
        echo "<b style='color:green'>Treatment Status Updated</b>";
    }
} else {
    echo "<span style='color:red'>Error ! Relogin and Try</span>";
}

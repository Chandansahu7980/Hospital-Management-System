<?php
// echo $_POST['disease'];
session_name("doctor_session");
session_start();

if ($_SESSION['dId']) {
    include './config.php';
    $sqlDiseaseUpdate = "UPDATE `patient` SET `disease`='".$_POST['disease']."' WHERE id='".$_POST['ptId']."'";
    if ($conn->query($sqlDiseaseUpdate)) {
        echo "<b style='color:green'>Updated Disease : '" . $_POST['disease'] . "'</b>";
    }
} else {
    echo "<span style='color:red'>Error ! Relogin and Try</span>";
}

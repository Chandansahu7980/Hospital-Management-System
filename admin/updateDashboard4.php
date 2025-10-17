<?php
include './../config.php';
// echo $_POST['i'];
$dashboard4table = $conn->query("SELECT doctor.name, COUNT(apnts.id) FROM doctor JOIN apnts ON doctor.id=apnts.doct_id WHERE doctor.spec_id=" . $_POST['i'] . " GROUP BY doctor.name")->fetch_all();
$dashboard4Data = json_encode($dashboard4table);
// // echo $dashboard4tableJson;
echo $dashboard4Data;

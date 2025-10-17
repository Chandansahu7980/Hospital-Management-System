<?php
include './../config.php';
// echo $_POST['seachTerm'] . $_POST['dept'] . $_POST['formDate'] . $_POST['toDate'] . $_POST['sts'] . $_POST['apntType'];

$sqlQuery = "SELECT * FROM `apnts` WHERE (doct_id IN (SELECT `id` FROM `doctor` WHERE name LIKE '%" . $_POST['seachTerm'] . "%') OR patient_id IN (SELECT `id` FROM `patient` WHERE name LIKE '%" . $_POST['seachTerm'] . "%'))";

if ($_POST['dept']) {
    $sqlQuery = $sqlQuery . " AND spec_id=" . $_POST['dept'];
}
if ($_POST['formDate'] and $_POST['toDate']) {
    $sqlQuery = $sqlQuery . "AND (date BETWEEN '" . $_POST['formDate'] . "' AND '" . $_POST['toDate'] . "')";
}
if ($_POST['sts']) {
    $sqlQuery = $sqlQuery . "AND status='" . $_POST['sts'] . "'";
}
if ($_POST['apntType']) {
    $sqlQuery = $sqlQuery . "AND apnt_type='" . $_POST['apntType'] . "'";
}
?>
<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Patiend(id)</th>
        <th>Department</th>
        <th>Doctor(id)</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Apnt. Type</th>
    </tr>
    <?php
    $slNo = 0;
    $apnts = $conn->query($sqlQuery);
    while ($apnt = $apnts->fetch_assoc()) {
        $patName = $conn->query("SELECT `name` FROM `patient` WHERE id='" . $apnt['patient_id'] . "'")->fetch_assoc()['name'];
        $deptName = $conn->query("SELECT `name` FROM `spec_list` WHERE id='" . $apnt['spec_id'] . "'")->fetch_assoc()['name'];
        $doctName = $conn->query("SELECT `name` FROM `doctor` WHERE id='" . $apnt['doct_id'] . "'")->fetch_assoc()['name'];
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $apnt['id'] ?></td>
            <td><?php echo $patName . "(" . $apnt['patient_id'] . ")" ?></td>
            <td><?php echo $deptName ?></td>
            <td><?php echo $doctName . "(" . $apnt['doct_id'] . ")" ?></td>
            <td><?php echo $apnt['date'] ?></td>
            <td><?php echo $apnt['time'] ?></td>
            <td><?php echo $apnt['status'] ?></td>
            <td><?php echo $apnt['apnt_type'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>
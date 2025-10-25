<?php
include './../DB/config.php';
echo $_POST['searchTerm'] . $_POST['dept'] . $_POST['date'];
$sqlQuery = "SELECT * FROM `medi_hist` WHERE apnt_id IN (SELECT `id` FROM `apnts` WHERE doct_id IN (SELECT `id` FROM `doctor` WHERE name LIKE '%" . $_POST['searchTerm'] . "%') OR patient_id in (SELECT `id` FROM `patient` WHERE name LIKE '%" . $_POST['searchTerm'] . "%'))";
if ($_POST['dept']) {
    $sqlQuery = $sqlQuery . "AND apnt_id IN (SELECT `id` FROM `apnts` WHERE spec_id=" . $_POST['dept'] . ")";
}
if ($_POST['date']) {
    $sqlQuery = $sqlQuery . "AND date_updated LIKE '" . $_POST['date'] . "%'";
}
?>
<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Patient(id)</th>
        <th>Doctor(id)</th>
        <th>Department</th>
        <th>Description</th>
        <th>Date</th>
    </tr>
    <?php
    $slNo = 0;
    $medi_hists = $conn->query($sqlQuery);
    while ($mediHist = $medi_hists->fetch_assoc()) {
        $patName = $conn->query("SELECT `name` FROM `patient` WHERE id='" . $mediHist['pat_id'] . "'")->fetch_assoc()['name'];
        $doctName = $conn->query("SELECT `id`,`name` from doctor WHERE id IN(SELECT `doct_id` FROM apnts WHERE id IN (SELECT `apnt_id` FROM medi_hist WHERE id='" . $mediHist['id'] . "'))")->fetch_assoc();
        $deptName = $conn->query("SELECT `id`,`name` FROM spec_list WHERE id IN (SELECT `spec_id` FROM apnts WHERE id IN (SELECT `apnt_id` FROM medi_hist WHERE id='" . $mediHist['id'] . "'))")->fetch_assoc();

    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $mediHist['id'] ?></td>
            <td><?php echo $patName . "(" . $mediHist['pat_id'] . ")" ?></td>
            <td><?php echo $doctName['name'] . "(" . $doctName['id'] . ")" ?></td>
            <td><?php echo $deptName['name'] . "(" . $deptName['id'] . ")" ?></td>
            <td>
                <div id="desc-td">
                    <?php echo "BP=" . $mediHist['blood_pressure'] . "<br>Weight=" . $mediHist['weight'] . "<br>Blood Sugar=" . $mediHist['blood_sugar'] . "<br>Temperature=" . $mediHist['temp'] . "<br>" . $mediHist['description'] ?>
                </div>
            </td>
            <td><?php echo $mediHist['date_updated'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>
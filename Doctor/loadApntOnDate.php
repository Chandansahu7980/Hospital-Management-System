<?php
session_name("doctor_session");
session_start();
$selectedDate = $_POST['selectedDate'];
include './../DB/config.php';

if ($_POST['selectedDate']) {
    $myQuery = "SELECT * FROM `apnts` WHERE doct_id='" . $_SESSION['dId'] . "' AND date='" . $selectedDate . "'  ORDER BY time;";
} else {
    $myQuery = "SELECT * FROM `apnts` WHERE doct_id='" . $_SESSION['dId'] . "' AND date <= CURRENT_DATE() AND status!='active' ORDER BY date;";
}

$result2 = $conn->query($myQuery);
if ($result2->num_rows > 0) {
?>
    <table border="1" cellspacing="0">
        <tr>
            <th>Sl no.</th>
            <th>Patient Name</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Time</th>
            <th>Staus</th>
        </tr>
        <?php
        $slNo = 1;
        while ($row2 = $result2->fetch_assoc()) {
            $row3 = $conn->query("SELECT `name`, `phone` FROM `patient` WHERE id='" . $row2['patient_id'] . "'")->fetch_assoc();
        ?>
            <tr>
                <td><?php echo $slNo ?></td>
                <td><?php echo $row3['name'] ?></td>
                <td><?php echo $row3['phone'] ?></td>
                <td><?php echo $row2['date'] ?></td>
                <td><?php echo $row2['time'] ?></td>
                <td><?php echo $row2['status'] ?></td>
            </tr>
        <?php
            $slNo += 1;
        }
        ?>
    </table>
<?php
} else {
    echo "<p sytle='color:gray'>NO APPOINMENTS AVAILABLE ON THIS DATE</p>";
}
?>
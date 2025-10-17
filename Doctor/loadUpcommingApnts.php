<?php
include './../DB/config.php';
$sqlQuery = "SELECT * FROM `apnts` WHERE doct_id='" . $_POST['doct_id'] . "' AND status='active' AND date > CURRENT_DATE() ORDER BY date;";
if ($_POST['prefer'] == 'all') {
    $sqlQuery = "SELECT * FROM `apnts` WHERE spec_id=(SELECT spec_id FROM doctor WHERE id='" . $_POST['doct_id'] . "') AND date > CURRENT_DATE() AND status='active' ORDER BY time;";
}
$result2 = $conn->query($sqlQuery);
if ($result2->num_rows > 0) {
?>
    <table border="1" cellspacing="0">
        <tr>
            <th>Sl no.</th>
            <th>Patient Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        $slNo = 1;
        while ($row2 = $result2->fetch_assoc()) {
            $row3 = $conn->query("SELECT `name`, `dob`, `gender`, `phone`,`address` FROM `patient` WHERE id='" . $row2['patient_id'] . "'")->fetch_assoc();
        ?>
            <tr>
                <td><?php echo $slNo ?></td>
                <td><?php echo $row3['name'] ?></td>
                <td><?php echo $row3['dob'] ?></td>
                <td><?php echo $row3['gender'] ?></td>
                <td><?php echo $row3['phone'] ?></td>
                <td><?php echo $row3['address'] ?></td>
                <td><?php echo $row2['date'] ?></td>
                <td><?php echo $row2['time'] ?></td>
            </tr>
        <?php
            $slNo += 1;
        }
        ?>
    </table>
<?php
} else {
    echo "<p style='color:gray'>NO APPOINMENTS AVAILABLE</p>";
}
?>
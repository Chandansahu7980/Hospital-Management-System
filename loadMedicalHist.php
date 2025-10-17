<?php
$searchWord = $_POST['searchItem'];

include './config.php';
$sql = "SELECT mh.*, pt.name, pt.phone FROM `medi_hist` mh JOIN `patient` pt ON mh.pat_id = pt.id WHERE pt.name LIKE '%$searchWord%' OR pt.phone LIKE '$searchWord%' ORDER BY mh.date_updated;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
?>
    <table border="1" cellspacing="0">
        <tr>
            <th>Sl no</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Blood Pressure</th>
            <th>Weight</th>
            <th>Blood Sugar</th>
            <th>Temperature</th>
            <th>Description</th>
            <th>Data Updated</th>
        </tr>
        <?php
        $slNo = 1;
        while ($row = $result->fetch_assoc()) {
            // print_r($row);
        ?>
            <tr>
                <td><?php echo $slNo ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['blood_pressure'] ?></td>
                <td><?php echo $row['weight'] ?></td>
                <td><?php echo $row['blood_sugar'] ?></td>
                <td><?php echo $row['temp'] ?></td>
                <td id="desc-td"><?php echo $row['description'] ?></td>
                <td><?php echo $row['date_updated'] ?></td>
            </tr>
        <?php
            $slNo += 1;
        }
        ?>
    </table>
<?php
} else {
    echo "<h1>No Data Found On That Name OR Phone</h1>";
}
?>
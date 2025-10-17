<?php
$searchWord = $_POST['searchItem'];
include './config.php';

$sql = "SELECT * FROM `patient` WHERE name LIKE '%$searchWord%' OR phone LIKE '%$searchWord%'";
$res = $conn->query($sql);
?>
<table border="1" cellspacing="0">
    <tr>
        <th>Sl No</th>
        <th>Name</th>
        <th>Father's Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Disease</th>
        <th>Treatment</th>
    </tr>

    <?php
    $slNo = 1;
    while ($row = $res->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $slNo ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['fname'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['dob'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['disease'] ?></td>
            <td><?php echo $row['treatment_status'] ?></td>
        </tr>
    <?php
    $slNo+=1;
    }
    ?>
</table>
<?php
?>
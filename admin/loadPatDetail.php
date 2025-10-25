<?php
include './../DB/config.php';

$sqlQuery = "SELECT * FROM `patient` WHERE (name LIKE '%" . $_POST['searchItem'] . "%' OR email LIKE '%" . $_POST['searchItem'] . "%' OR phone LIKE '%" . $_POST['searchItem'] . "%') AND disease LIKE '%" . $_POST['disease'] . "%'";
if ($_POST['gender']) {
    $sqlQuery = $sqlQuery . "AND gender='" . $_POST['gender'] . "'";
}
if ($_POST['treatSts']) {
    $sqlQuery = $sqlQuery . "AND treatment_status='" . $_POST['treatSts'] . "'";
}
// echo $sqlQuery;
?>

<head>
    <style>
        i {
            cursor: pointer;
        }

        i:hover {
            scale: 1.2;
            transition-duration: 0.4s;
        }
    </style>
</head>
<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Name</th>
        <th>Father</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Emergency Ph.</th>
        <th>Email</th>
        <th>Address</th>
        <th>Disease</th>
        <th>Treatment</th>
        <th>Password</th>
        <th>Creation Dt.</th>
        <th>Last Updated</th>
        <th>Apnt Count</th>
        <th>Action</th>
    </tr>
    <?php
    $patients = $conn->query($sqlQuery);
    $slNo = 0;
    while ($pat = $patients->fetch_assoc()) {
        $apntCount = $conn->query("SELECT COUNT(*)AS num from apnts WHERE patient_id='" . $pat['id'] . "' AND status IN ('attended','active');")->fetch_assoc()['num'];
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $pat['id'] ?></td>
            <td><?php echo $pat['name'] ?></td>
            <td><?php echo $pat['fname'] ?></td>
            <td><?php echo $pat['dob'] ?></td>
            <td><?php echo $pat['gender'] ?></td>
            <td><?php echo $pat['phone'] ?></td>
            <td><?php echo $pat['emergency_contact'] ?></td>
            <td><?php echo $pat['email'] ?></td>
            <td><?php echo $pat['address'] ?></td>
            <td><?php echo $pat['disease'] ?></td>
            <td><?php echo $pat['treatment_status'] ?></td>
            <td><?php echo $pat['password'] ?></td>
            <td><?php echo $pat['creation_date'] ?></td>
            <td><?php echo $pat['updation_date'] ?></td>
            <td><?php echo $apntCount ?></td>
            <td>
                <i onclick="window.location.href='EditDetail.php?t=patient&id=<?php echo $pat['id'] ?>'" title="Edit Profile" style="color:blue" class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;<i onclick="confirmRedir(<?php echo $pat['id'] ?>)" title="Delete Profile" style="color:red" class="fa-solid fa-trash"></i>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function confirmRedir(i) {
        var tom = confirm("Are You Sure To Delete This Profile ?");
        if (tom) {
            window.location.href = 'adminDeleteData.php?tb=patient&id=' + i;
        }
    }
</script>
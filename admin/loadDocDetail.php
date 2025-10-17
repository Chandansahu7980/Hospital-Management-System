<?php
include './../config.php';
// echo strtolower($_POST['search-term'])  . $_POST['dept'] . $_POST['adminPass'];
$sqlQuery = "SELECT * FROM `doctor` WHERE (name LIKE '%" . $_POST['search-term'] . "%' OR phone LIKE '%" . $_POST['search-term'] . "%' OR LOWER(email) LIKE '%" . $_POST['search-term'] . "%' OR license_info LIKE '%" . $_POST['search-term'] . "%')";
if ($_POST['dept']) {
    $sqlQuery = $sqlQuery . " AND spec_id=" . $_POST['dept'];
}
if ($_POST['adminPass']) {
    $sqlQuery = $sqlQuery . " AND adminPass='" . $_POST['adminPass'] . "'";
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
        <th>Photo</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Education</th>
        <th>Department</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Licence Info.</th>
        <th>Experience</th>
        <th>Fees</th>
        <th>Admin Pass</th>
        <th>Password</th>
        <th>Creation Dt.</th>
        <th>Last Updation</th>
        <th>Today's Apnt Count</th>
        <th>Action</th>
    </tr>
    <?php
    $slNo = 0;
    $docs = $conn->query($sqlQuery);
    while ($doc = $docs->fetch_assoc()) {
        $deptName = $conn->query("SELECT`name` FROM `spec_list` WHERE id='" . $doc['spec_id'] . "'")->fetch_assoc()['name'];
        $noOfDocApnt = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE doct_id='" . $doc['id'] . "' AND date=CURRENT_DATE;")->fetch_assoc()['num'];
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $doc['id'] ?></td>
            <td><img src="./.<?php echo $doc['img_src'] ?>" alt="" height="50px" width="40px"></td>
            <td><?php echo $doc['name'] ?></td>
            <td><?php echo $doc['dob'] ?></td>
            <td><?php echo $doc['gender'] ?></td>
            <td><?php echo $doc['education'] ?></td>
            <td><?php echo $deptName ?></td>
            <td><?php echo $doc['phone'] ?></td>
            <td><?php echo $doc['email'] ?></td>
            <td><?php echo $doc['license_info'] ?></td>
            <td><?php echo $doc['experience'] ?></td>
            <td><?php echo $doc['fees'] ?></td>
            <td><?php echo $doc['adminPass'] ?></td>
            <td><?php echo $doc['password'] ?></td>
            <td><?php echo $doc['creation_date'] ?></td>
            <td><?php echo $doc['updation_date'] ?></td>
            <td><?php echo $noOfDocApnt ?></td>
            <td>
                <i onclick="window.location.href='EditDetail.php?t=doctor&id=<?php echo $doc['id'] ?>'" title="Edit Profile" style="color:blue" class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;<i onclick="confirmRedir(<?php echo $doc['id'] ?>)" title="Delete Profile" style="color:red" class="fa-solid fa-trash"></i>
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
            window.location.href = 'adminDeleteData.php?tb=doctor&id=' + i;
        }
    }
</script>
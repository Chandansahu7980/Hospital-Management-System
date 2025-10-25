<?php
include './../DB/config.php';
error_reporting(0);
?>

<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Department</th>
        <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Query</th>
        <th>Response</th>
        <th>Action</th>
    </tr>
    <?php
    $queries = $conn->query("SELECT * FROM `queries`");
    $slNo = 0;
    while ($q = $queries->fetch_assoc()) {
        $patName = $conn->query("SELECT `name` FROM `patient` WHERE id=" . $q['pat_id'])->fetch_assoc()['name'];
        $docName = $conn->query("SELECT `name` FROM `doctor` WHERE id=" . $q['doc_id'])->fetch_assoc()['name'];
        $deptName = $conn->query("SELECT `name` FROM `spec_list` WHERE id=" . $q['intended_dept_id'])->fetch_assoc()['name'];
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $q['id'] ?></td>
            <td><?php echo $deptName . "(" . $q['intended_dept_id'] . ")" ?></td>
            <td><?php echo $patName . "(" . $q['pat_id'] . ")" ?></td>
            <td><?php echo $docName . "(" . $q['doc_id'] . ")" ?></td>
            <td><?php echo $q['query_text'] ?></td>
            <td><?php echo $q['query_response'] ?></td>
            <td ><i onclick="window.location.href='EditDetail.php?t=queries&id=<?php echo $q['id'] ?>'" title="Edit" style="color:blue" class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;<i title="Delete Query" class="fa-solid fa-trash" style="color:red" onclick="confirmRedir(<?php echo $q['id'] ?>)"></i></td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function confirmRedir(i) {
        var tom = confirm("Are You Sure Want To Delete ?");
        if (tom)
            window.location.href = 'adminDeleteData.php?tb=queries&id=' + i;
    }
</script>
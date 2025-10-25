<?php
include './../DB/config.php';
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
        <th>Description</th>
        <th>Creation Date</th>
        <th>Action</th>
    </tr>
    <?php
    $resDept = $conn->query("SELECT * FROM `spec_list`");
    $slNo = 0;
    while ($dept = $resDept->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $dept['id'] ?></td>
            <td><?php echo $dept['name'] ?></td>
            <td><?php echo $dept['spec_desc'] ?></td>
            <td><?php echo $dept['creation_date'] ?></td>
            <td>
                <i onclick="window.location.href='EditDetail.php?t=spec_list&id=<?php echo $dept['id'] ?>'" title="Edit Values" style="color:blue" class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;<i onclick="confirmRedir(<?php echo $dept['id'] ?>)" title="Delete Department" style="color:red" class="fa-solid fa-trash"></i>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function confirmRedir(i) {
        var tom = confirm("Are You Sure To Delete The Department ?");
        if (tom) {
            window.location.href = 'adminDeleteData.php?tb=spec_list&id=' + i;
        }
    }
</script>
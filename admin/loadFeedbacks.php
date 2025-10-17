<?php
include './../config.php';
?>

<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Time stamp</th>
        <th>Action</th>
    </tr>
    <?php
    $feedBacks = $conn->query("SELECT * FROM `feedback`");
    $slNo = 0;
    while ($feedback = $feedBacks->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo ++$slNo ?></td>
            <td><?php echo $feedback['id'] ?></td>
            <td><?php echo $feedback['name'] ?></td>
            <td><?php echo $feedback['email'] ?></td>
            <td><?php echo $feedback['phone'] ?></td>
            <td><?php echo $feedback['message'] ?></td>
            <td><?php echo $feedback['creation_date'] ?></td>
            <td title="Delete Feedback"><i class="fa-solid fa-trash" style="color:red" onclick="confirmRedir(<?php echo $feedback['id'] ?>)"></i></td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function confirmRedir(i) {
        var tom=confirm("Are You Sure Want To Delete ?");
        // alert(tom);
        // alert(i);
        if(tom)
        window.location.href='adminDeleteData.php?tb=feedback&id='+i;
    }
</script>
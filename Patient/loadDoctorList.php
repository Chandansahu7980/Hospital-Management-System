<?php
if (isset($_POST['spec_Id'])) {
    include './../DB/config.php';
    $sql = "SELECT `id`,`name` FROM `doctor` WHERE spec_id='" . $_POST['spec_Id'] . "' AND adminPass='pass';";
    $result = $conn->query($sql);
?>
    <option value="" selected disabled>Select Doctor</option>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php
    }
}

?>
<head>
    <title>HMS: Admin - Delete Data</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
</head>
<?php
session_name('admin');
session_start();
include './../DB/config.php';
$tableName = $_GET['tb'];
$id = $_GET['id'];
// echo $tableName . $id;

if ($_SESSION['aId']) {
    if ($tableName == 'doctor') {
        $imgSrc = $conn->query("SELECT  `img_src` FROM `doctor` WHERE id='" . $id . "'")->fetch_assoc()['img_src'];
        $defaultSrc = "./Images/DoctorPassphoto/defaultDocDp.jpg";
        if ($imgSrc !== $defaultSrc) {
            if (file_exists("./." . $defaultSrc)) {
                unlink("./." . $imgSrc);
                echo "<script>console.log('Profile Photo Removed from Folder.')</script>";
            }
        }
    }
    if ($conn->query("DELETE FROM `" . $tableName . "` WHERE id='" . $id . "'")) {
        echo "<script>alert('Successfullly Deleted.'); window.location.href='admin.php'</script>";
    } else
        echo "Error in Deleting Data.";
} else {
    echo "Currepted Access ! <a href='./adminLogin.php'>Relogin</a> ";
}

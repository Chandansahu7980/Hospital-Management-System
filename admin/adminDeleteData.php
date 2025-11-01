<head>
    <title>HMS: Admin - Delete Data</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
</head>

<?php
session_name('admin');
session_start();
include './../DB/config.php';

if (!isset($_SESSION['aId'])) {
    echo "Corrupted Access! <a href='./adminLogin.php'>Relogin</a>";
    exit;
}

if (!isset($_GET['tb']) || !isset($_GET['id'])) {
    echo "Invalid request!";
    exit;
}

$tableName = $_GET['tb'];
$id = intval($_GET['id']); // prevent injection

// Optional: if deleting doctor, remove photo if not default
if ($tableName === 'doctor') {
    $stmt = $conn->prepare("SELECT img_src FROM doctor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res) {
        $imgSrc = $res['img_src'];
        $defaultSrc = "./Images/DoctorPassphoto/defaultDocDp.jpg";
        $filePath = realpath(__DIR__ . "/../" . $imgSrc);
        $defaultPath = realpath(__DIR__ . "/../" . $defaultSrc);

        if ($filePath && $filePath !== $defaultPath && file_exists($filePath)) {
            unlink($filePath);
            echo "<script>console.log('Profile photo removed successfully.');</script>";
        }
    }
}

// Try to delete and catch FK constraint error
try {
    $stmt = $conn->prepare("DELETE FROM `$tableName` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Successfully deleted.'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Record not found or already deleted.'); window.location.href='admin.php';</script>";
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1451) { // Foreign key constraint fails
        echo "<script>alert('Cannot delete this $tableName. It is linked to other records'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . addslashes($e->getMessage()) . "'); window.location.href='admin.php';</script>";
    }
}
?>

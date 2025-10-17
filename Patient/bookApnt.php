<?php
if ($_POST['apnt-book-submit']) {
    // echo "submit pressed";
    session_name('patient');
    session_start();
    if ($_SESSION['patient_id']) {
        // echo "patient already logged in";
        include './../DB/config.php';
        // echo $_POST['date'];
        $sqlApntBook = "INSERT INTO `apnts`(`patient_id`, `spec_id`, `doct_id`, `date`, `time`) VALUES (" . $_SESSION['patient_id'] . "," . $_POST['spec'] . "," . $_POST['doct'] . ",'" . $_POST['date'] .  "','" . $_POST['time'] . "')";
        // echo $sqlApntBook;
        if ($conn->query($sqlApntBook)) {
            echo "<script>alert('Appointment Booked Successfully')</script>";
            echo "<script>window.location.href='./patient.php'</script>";
        }
    } else {
        echo "<script>Error in reading Patient profile. Please Login Again</script>";
    }
} else {
    echo "Error In Booking Appointment";
}

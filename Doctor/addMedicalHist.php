<?php
// echo "<script>alert('adding medi hist')</script>";
session_name("doctor_session");
session_start();
include './config.php';
if ($_POST['submit'] & $_SESSION['dId']) {
    $followupDate = '';
    if ($_POST['followup']) {
        $followupDate = $_POST['followup'];
    }

    $desc = "<b>Condition(Symtoms):</b> <br>" . $_POST['cond'] . "<br><br><b>Diagnosis Status:</b><br>" . $_POST['diagnosis'] . "<br><br><b>Medicines & Advices:</b><br>" . $_POST['advice'];
    if ($_POST['followup']) {
        $desc = $desc + "<br><br>Next Check Up Date:<b>" . $followupDate . "</b>";
    }
    // echo $desc;

    $sqlToUpdateStatus = "UPDATE apnts SET status='attended', apnt_type='" . $_POST['apnt-type'] . "' WHERE patient_id='" . $_GET['pId'] . "' AND id='" . $_GET['aId'] . "';";

    // echo $sqlToUpdateStatus;

    $sqlToAddMediHist = "INSERT INTO `medi_hist`(`pat_id`, `apnt_id`, `blood_pressure`, `weight`, `blood_sugar`, `temp`, `description`) VALUES ('" . $_GET['pId'] . "','" . $_GET['aId'] . "','" . $_POST['bp'] . "','" . $_POST['weight'] . "','" . $_POST['bs'] . "','" . $_POST['temp'] . "','" . $desc . "')";

    // echo $sqlToAddMediHist;

    $sqlToUpdateDocId = "UPDATE `apnts` SET `doct_id`='" . $_GET['dId'] . "' WHERE id='" . $_GET['aId'] . "'";

    if ($conn->query($sqlToUpdateStatus) && $conn->query($sqlToAddMediHist) && $conn->query($sqlToUpdateDocId)) {
        // echo "Attended Successful";
        echo "<script>alert('Attended Successful, All data Saved.')</script>";
        echo "<script>window.close();</script>";
    }else{
        echo "<script>alert('Error in collecting data. Please Refresh & Try');</script>";
        echo "<script>window.close();</script>";
    }
} else {
    echo "Error !! Please Retry.";
}

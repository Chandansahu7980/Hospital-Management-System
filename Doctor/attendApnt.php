<?php
session_name("doctor_session");
session_start();
error_reporting(0);
$patId = $_GET['pId'];
$apntId = $_GET['aId'];
$doctId = $_GET['dId'];

include './config.php';
$patientLoadSql = "SELECT `name`, `fname`, `dob`, `gender`, `phone`, `disease`, `treatment_status` FROM `patient` WHERE id='$patId'";
$patientDetail = $conn->query($patientLoadSql)->fetch_assoc();
// print_r($patientDetail);
$medHistSql = "SELECT * FROM `medi_hist` WHERE pat_id='$patId'";
$medHist = $conn->query($medHistSql);
// print_r($medHist)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attend Patient Appointment - HMS Doctor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/attendApnt.css">
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    if ($_SESSION['dId']) {
    ?>
        <h1>Patient Attend Page</h1>
        <h3>Patient Details :-</h3>
        <div class="patient-detail-div">
            <table name="patient_details" border="1">
                <tr>
                    <th>Name:</th>
                    <td><?php echo $patientDetail['name'] ?></td>
                </tr>
                <tr>
                    <th>Father's Name:</th>
                    <td><?php echo $patientDetail['fname'] ?></td>
                </tr>
                <tr>
                    <th>DOB:</th>
                    <td><?php echo $patientDetail['dob'] ?></td>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <td><?php echo $patientDetail['gender'] ?></td>
                </tr>
                <tr>
                    <th>Phone No.:</th>
                    <td><?php echo $patientDetail['phone'] ?></td>
                </tr>
                <tr>
                    <th>Disease:</th>
                    <td><?php echo $patientDetail['disease'] ?></td>
                </tr>
                <tr>
                    <th>Treatment Status</th>
                    <td><?php echo $patientDetail['treatment_status'] ?></td>
                </tr>
            </table>
            <table id="patient_medical_histry" border="1">
                <tr>
                    <th>Sl. No.</th>
                    <th>BP</th>
                    <th>Weight</th>
                    <th>Blood Sugar</th>
                    <th>Temp.(F)</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                <?php
                $slNO = 1;
                while ($mediHistRecord = $medHist->fetch_assoc()) {
                    // print_r($mediHistRecord);/
                ?>
                    <tr>
                        <td><?php echo $slNO ?></td>
                        <td><?php echo $mediHistRecord['blood_pressure'] ?></td>
                        <td><?php echo $mediHistRecord['weight'] ?></td>
                        <td><?php echo $mediHistRecord['blood_sugar'] ?></td>
                        <td><?php echo $mediHistRecord['temp'] ?></td>
                        <td><?php echo $mediHistRecord['description'] ?></td>
                        <td><?php echo $mediHistRecord['date_updated'] ?></td>
                    </tr>
                <?php
                    $slNO = $slNO + 1;
                }
                ?>

            </table>
        </div>
        <form action="./addMedicalHist.php?pId=<?php echo $patId ?>&aId=<?php echo $apntId ?>&dId=<?php echo $doctId ?>" onsubmit="return checkPaymentAndStatus()" method="post">
            <label for="apnt-type">Appointment Type</label>
            <select name="apnt-type" id="apnt-type" required>
                <option value="" selected disabled>Select</option>
                <option value="followup">Regular checkup or Follow up</option>
                <option value="specific">Specific Concern</option>
            </select>
            <fieldset>
                <legend>Medical History</legend>
                <label for="bp">BP</label>
                <select name="" id="bp">
                    <option value="" selected disabled>Select</option>
                    <option value="1">Good</option>
                </select>
                <input type="text" name="bp" id="bp-input" placeholder="Type here" required>mm Hg
                <br>
                <label for="weight">Weight</label>
                <input type="number" name="weight" id="weight" placeholder="Type here" min="0" required>Kg<br>
                <label for="bs">Blood Sugar</label>
                <select name="bs" id="bs">
                    <option value="" selected disabled>select</option>
                    <option value="1">Good</option>
                </select>
                <input type="number" name="bs" id="bs-input" placeholder="Type here" required>mg/dL<br>
                <label for="temp">Temp.</label>
                <select name="temp" id="temp" required>
                    <option value="" selected disabled>Select</option>
                    <option value="1">Good</option>
                </select>
                <input type="text" name="temp" id="temp-input" placeholder="Type here" required>°F
                <div class="flex-continer">
                    <div class="flex-card">
                        <label for="cond">Patient Condition(Symtoms):</label>
                        <textarea name="cond" id="cond" required></textarea>
                    </div>
                    <div class="flex-card">
                        <label for="diagnosis">Diagnosis Status:</label>
                        <textarea name="diagnosis" id="diagnosis" required></textarea>
                    </div>
                    <div class="flex-card">
                        <label for="advice">Medicines & Advices:</label>
                        <textarea name="advice" id="advice" required></textarea>
                    </div>
                </div>
            </fieldset>
            <label for="status">Appointment Status</label>
            <select name="status" id="status" required>
                <option value="0" selected>Active</option>
                <option value="1">Attended</option>
            </select><br>
            <label for="treatment-status">Is patient completely treatmented ?</label>
            <select class="spec-clr" name="treatment-status" id="treatment-status">
                <option value="<?php echo $patientDetail['treatment_status'] ?>" selected disabled><?php echo $patientDetail['treatment_status'] ?></option>
                <option value="ongoing">Ongoing</option>
                <option value="closed">Closed</option>
            </select>
            <button type="button" name="treatStsBtn" id="treatStsBtn">Update <i class="fa-solid fa-rotate-right"></i></button><span></span>
            <br>
            <label for="disease">Current Disease</label>
            <input class="spec-clr" type="text" name="disease" id="disease" value="<?php echo $patientDetail['disease'] ?>">
            <button type="button" name="updateDisease" id="diseaseUpdateBtn">Update <i class="fa-solid fa-rotate-right"></i></button><span></span>
            <br>
            <span id="next-followup-sec">
                <label for="followup">Next Follow Up:</label>
                <input type="date" name="followup" id="followup">
            </span>
            <br>
            <label for="payment">Is Payment Received?</label>
            <select name="payment" id="payment" required>
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
            </select><br>
            <input type="submit" value="Submit" name="submit">
        </form>
    <?php
    } else {
        echo "Error in reading your profile, Please reLogin and Try Again";
    }
    ?>
    <script src="./JS/attendApnt.js"></script>
    <script>
        var ptId = <?php echo $patId ?>;
    </script>
    <!-- Check Online -->
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('internetError.html');
        }
    </script>
</body>

</html>
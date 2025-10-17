<?php
error_reporting(0);
session_name('patient');
session_start();
$aId = $_GET['m'];
include './../DB/config.php';
$mediHist = $conn->query("SELECT * FROM `medi_hist` WHERE id=" . $_GET['m'])->fetch_assoc();
$pat = $conn->query("SELECT `name`, `fname`, `dob`, `phone`, `address` FROM `patient` WHERE id=" . $mediHist['pat_id'])->fetch_assoc();
$apnt = $conn->query("SELECT * FROM `apnts` WHERE id=" . $mediHist['apnt_id'])->fetch_assoc();
$docName = $conn->query("SELECT  `name` FROM `doctor` WHERE id=" . $apnt['doct_id'])->fetch_assoc()['name'];
$dept = $conn->query("SELECT `name`, `spec_desc` FROM `spec_list` WHERE id=" . $apnt['spec_id'])->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Appointment Ticket - HMS</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <style>
        * {
            margin: 0;
            border: 0;
            box-sizing: border-box;
        }

        .container {
            border: 5px double black;
            box-shadow: 6px 6px lightblue, -6px -6px lightgreen;
            margin: 1em;
        }

        .header {
            background-color: lightcyan;
            padding: 1em;
            text-align: center;
        }

        .details {
            background-color: lightyellow;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 10%;
            padding: 1em;
        }

        table {
            border-collapse: collapse;
        }

        table th,
        table td {
            border-bottom: 1px solid lightgray;
            padding: 0.5em 1em;
            padding-left: 0;
            text-align: left;
        }

        .mediHist {
            background-color: lightyellow;
            padding: 1em;
        }

        .mediHist table {
            width: 100%;
        }

        .footer {
            background-color: lightskyblue;
            color: gray;
            padding: 0.5em;
            text-align: center;
        }

        .footer h3 {
            letter-spacing: 1px;
        }

        .footer span b {
            font-family: cursive;
        }

        button {
            text-align: center;
            margin: 1em auto;
            padding: 0.5em 1em;
        }

        .doc-sign {
            text-align: right;
            margin-top: 5%;
        }

        .doc-sign span {
            color: gray;
            font-size: smaller;
        }

        .doc-sign span:first-child {
            font-size: 1em;
            font-family: cursive;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION['patient_id']) {
    ?>
        <div class="container">
            <div class="header">
                <h1>Appointment Ticket - HMS</h1>
                <h2>Chandan Hospital, Aska Road, Berhumpur - 761104</h2>
            </div>
            <hr>
            <div class="details">
                <div class="">
                    <table>
                        <tr>
                            <th>Name of the Patient</th>
                            <td><?php echo $pat['name'] ?></td>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td><?php echo $pat['fname'] ?></td>
                        </tr>
                        <tr>
                            <th>Date Of Birth</th>
                            <td><?php echo $pat['dob'] ?></td>
                        </tr>
                        <tr>
                            <th>Mobile No:</th>
                            <td><?php echo $pat['phone'] ?></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td><?php echo $pat['address'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="">
                    <table>
                        <tr>
                            <th>Ticket Id</th>
                            <td>OPDHMS0<?php echo $apnt['id'] ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td><?php echo $dept['name'] ?></td>
                        </tr>
                        <tr>
                            <th>Appointment Date</th>
                            <td><?php echo $apnt['date'] ?></td>
                        </tr>
                        <tr>
                            <th>Appointment Time</th>
                            <td><?php echo $apnt['time'] ?></td>
                        </tr>
                        <tr>
                            <th>Doctor</th>
                            <td><?php echo $docName ?></td>
                        </tr>
                        <tr>
                            <th>Appoinment Type</th>
                            <td style="text-transform: capitalize;"><?php echo $apnt['apnt_type'] ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td style="text-transform: capitalize;"><?php echo $apnt['status'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mediHist">
                <table>
                    <tr>
                        <th>Blood Pressure</th>
                        <th>Weight</th>
                        <th>Blood Sugar</th>
                        <th>Temperature</th>
                    </tr>
                    <tr>
                        <td><?php echo $mediHist['blood_sugar'] ?></td>
                        <td><?php echo $mediHist['weight'] ?></td>
                        <td><?php echo $mediHist['blood_sugar'] ?></td>
                        <td><?php echo $mediHist['temp'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?php echo $mediHist['description'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="doc-sign">
                                <span><?php echo $docName . "</span><br><span>" . substr($mediHist['date_updated'], 0, 10)  ?></span>
                                <br>
                                <b>Name of the Doctor</b>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                <h3><?php echo $dept['name'] ?></h3>
                <p><?php echo $dept['spec_desc'] ?></p>
                <span><b>Thank You</b> 🙏🏻<br>Stay Happy & Healthy</span>
            </div>
        </div>
        <?php echo "<i>apnt_creation_date : </i>" . $apnt['creation_date'] ?><br>
        <?php echo "<i>prescription_created_on: </i>" . $mediHist['date_updated'] ?><br>
        <button onclick="printPage()">Print</button>
    <?php
    } else {
        echo "Currupted Session. Please <a href='patientLogin.php'>Relogin</a> ";
    }
    ?>


    <script>
        function printPage() {
            document.querySelector('button').style.display = 'none';
            window.print();
            window.close();
        }
    </script>
</body>

</html>
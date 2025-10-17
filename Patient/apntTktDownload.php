<?php
error_reporting(0);
session_name('patient');
session_start();
$aId = $_GET['a'];
include './../DB/config.php';
$apnt = $conn->query("SELECT * FROM `apnts` WHERE id=" . $_GET['a'])->fetch_assoc();
$pat = $conn->query("SELECT `name`, `fname`, `dob`, `phone`, `address` FROM `patient` WHERE id=" . $apnt['patient_id'])->fetch_assoc();
$docName = $conn->query("SELECT  `name` FROM `doctor` WHERE id=" . $apnt['doct_id'])->fetch_assoc()['name'];
$deptName = $conn->query("SELECT `name` FROM `spec_list` WHERE id=" . $apnt['spec_id'])->fetch_assoc()['name'];
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
            box-shadow: 4px 4px lightblue, -4px -4px lightgreen;
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
            align-items: center;
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

        .footer {
            background-color: lightskyblue;
            color: gray;
            padding: 0.5em;
            text-align: center;
        }

        button {
            text-align: center;
            margin: 1em auto;
            padding: 0.5em 1em;
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
                    <h4><u>Patient Details:-</u></h4>
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
                    <h4><u>Appointment Details</u></h4>
                    <table>
                        <tr>
                            <th>Ticket Id</th>
                            <td>OPDHMS0<?php echo $apnt['id'] ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td><?php echo $deptName ?></td>
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
                    </table>
                </div>
            </div>
            <div class="footer">
                Be available before 30 mins of your Appointment time. For any query please write us on <a href="./index.php" target="_blank" rel="noopener noreferrer">Home</a> page.
            </div>
        </div>
        <?php echo "<i>creation date : </i>" . $apnt['creation_date'] ?><br>
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
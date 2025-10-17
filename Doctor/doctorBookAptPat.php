<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appoinment - Patient:Doctor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            background-color: lightskyblue;
            width: 15em;
            padding: 1em;
        }

        label,
        input[type='date'],
        select {
            font-weight: bold;
            width: 100%;
            padding: 0.5em;
            padding-left: 0;
        }

        input[type='date'] {
            width: 95%;
        }

        input,
        select {
            margin-bottom: 1em;
        }
        input[type='submit']{
            border: 0;
            padding: 0.2em 1em;
            margin-right: 1em;
        }
        input[type='submit']:hover{
            background-color: green;
            color: white;
            transition-duration: 0.5s;
        }
        button{
            border: 0;
            padding: 0.2em 0.6em;
            cursor: pointer;
            transition-duration: 0.5s;
        }
        button:hover{
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    session_name("doctor_session");
    session_start();
    if ($_SESSION['dId']) {
        // echo "doctor logged in";
        include './config.php';

        $PatIdResult = $conn->query("SELECT `id`, `name`, `dob` FROM `patient` ");
        $specIdResult = $conn->query("SELECT `id`, `name` FROM `spec_list` ");
    }
    ?>
    <h2>Book Appoinment</h2>
    <form action="" method="post">
        <label for="patId">Patient</label>
        <select name="patId" id="patId" required>
            <option value="" selected disabled>Select</option>
            <?php
            while ($row = $PatIdResult->fetch_assoc()) {
            ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] . " : " . $row['dob'] ?></option>
            <?php
            }
            ?>
        </select><br>
        <label for="spec_Id">Specialization</label>
        <select name="spec_Id" id="spec_Id" required>
            <option value="" selected disabled>Select</option>
            <?php
            while ($row = $specIdResult->fetch_assoc()) {
            ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php
            }
            ?>
        </select><br>
        <label for="docId">Doctor</label>
        <select name="docId" id="docId" required>
            <option value="" selected disabled>Select</option>
        </select><br>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" required><br>
        <label for="slot">Time Slot</label>
        <select name="slot" id="slot" required>
            <option value="" disabled selected>Select</option>
            <option value="10:00 - 10:30">10:00 - 10:30</option>
            <option value="10:30 - 11:00">10:30 - 11:00</option>
            <option value="11:00 - 11:30">11:00 - 11:30</option>
            <option value="11:30 - 12:00">11:30 - 12:00</option>
            <option value="12:00 - 12:30">12:00 - 12:30</option>
            <option value="12:30 - 13:00">12:30 - 13:00</option>
            <option value="14:00 - 14:30">14:00 - 14:30</option>
            <option value="14:30 - 15:00">14:30 - 15:00</option>
        </select>
        <input type="submit" value="Submit" name="submit">
        <button onclick="window.location.href='doctor.php'">Cancel</button>
    </form>
    
    <?php
    if (isset($_POST['submit'])) {
        $sqlBookApt = "INSERT INTO `apnts`(`patient_id`, `spec_id`, `doct_id`, `date`, `time`) VALUES ('" . $_POST['patId'] . "','" . $_POST['spec_Id'] . "','" . $_POST['docId'] . "','" . $_POST['date'] . "','" . $_POST['slot'] . "')";
        // echo $sqlBookApt;
        if ($conn->query($sqlBookApt)) {
            echo "<script>alert('Appointment Booked !')</script>";
            echo "<script>window.location.href='doctor.php'</script>";
        } else {
            echo "Error! Please try again.";
        }
    }
    ?>

    <script>
        $(document).ready(function() {
            $("#spec_Id").change(function() {
                $.ajax({
                    method: 'POST',
                    url: 'loadDoctorList.php',
                    data: "spec_Id=" + $("#spec_Id").val()
                }).done(function(data) {
                    $("#docId").html(data);
                });
            });
        });
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
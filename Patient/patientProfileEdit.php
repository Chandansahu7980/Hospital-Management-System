<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTS - Patient Profile Update Page</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../CSS/patientProfileEdit.css">
</head>

<body>
    <button style="position: absolute; top:1em;right:1em; background:red;color:white;padding:0.5em;border-radius:0.5em;border:0;cursor:pointer;" onclick="window.location.href='patient.php'">Cancel</button>
    <?php
    session_name('patient');
    session_start();
    if ($_SESSION['patient_id']) {
        $pId = $_SESSION['patient_id'];
        include './../DB/config.php';
        $sql = "SELECT * FROM `patient` WHERE id='$pId';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
        <form action="" method="post" onsubmit="return patientSignupValid()">
            <h1>HMS | Patient Edit Profile</h1>
            <label for="patientName">Name</label>
            <input type="text" id="patientName" name="patientName" value="<?php echo $row['name'] ?>" required>
            <label for="patientFatherName">Patient Father's Name</label>
            <input type="text" id="patientFatherName" name="patientFatherName" value="<?php echo $row['fname'] ?>" required>
            <label for="dob">DOB</label>
            <input type="date" id="dob" name="dob" value="<?php echo $row['dob'] ?>" required>
            <label for="gender">Gender </label>
            <select name="gender" id="gender" required>
                <option <?php if ($row['gender'] == 'male') echo "selected" ?> value="male">Male</option>
                <option <?php if ($row['gender'] == 'female') echo "selected" ?> value="female">Female</option>
            </select>
            <label for="phoneNumber">Contact No.</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phone'] ?>" required>
            <label for="phoneNumber">Emergency Contact No.</label>
            <input type="text" id="emerNum" name="emerNum" value="<?php echo $row['emergency_contact'] ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>" required>
            <label for="address">Address</label>
            <input type="text" name="address"  value="<?php echo $row['address'] ?>"required>

            <button type="submit" name="patient_update">UPDATE</button>
        </form>
    <?php
        if (isset($_POST['patient_update'])) {
            $name = $_POST['patientName'];
            $fName = $_POST['patientFatherName'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $phoneNo = $_POST['phoneNumber'];
            $emerNum = $_POST['emerNum'];
            $email = $_POST['email'];
            $address=$_POST['address'];

            $sql2 = "UPDATE `patient` SET `name`='$name',`fname`='$fName',`dob`='$dob',`gender`='$gender',`phone`='$phoneNo',`email`='$email',`address`='$address', `emergency_contact`='$emerNum' , `updation_date`=CURRENT_TIMESTAMP WHERE id='$pId';";

            if ($conn->query($sql2)) {
                echo "<script>alert('Update Successful!');</script>";
                echo "<script>window.location.href='./patient.php'</script>";
            } else {
                echo "<script>alert('Error in Updation');</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid User Type !')</script>";
        echo "<script>window.location.href='./../index.php'</script>";
    }
    ?>

    <script>
        function patientSignupValid() {
            var name = document.getElementById("patientName");
            var Fname = document.getElementById("patientFatherName");
            var dob = document.getElementById("dob");
            var phoneNum = document.getElementById("phoneNumber");
            var pw1 = document.getElementById("password1");
            var pw2 = document.getElementById("password2");
            if (!isNaN(name.value)) {
                alert("invalid name");
                name.focus();
                return false;
            }
            if (!isNaN(Fname.value)) {
                alert("invalid Father's name");
                Fname.focus();
                return false;
            }

            if (isNaN(phoneNum.value) || (phoneNum.value.length != 10)) {
                alert("Invalid Phone number!");
                phoneNum.focus();
                return false;
            }
            if (pw1.value.length < 6) {
                alert("Password must be more then 6 character");
                pw1.focus();
                return false;
            }
            if (pw1.value != pw2.value) {
                alert("Retype password must be same with password");
                pw2.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./../Common/internetError.html');
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTS - Doctor Profile Update Page</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../CSS/patientProfileEdit.css">
</head>

<body>
    <button style="position: absolute; top:1em;right:1em; background:red;color:white;padding:0.5em;border-radius:0.5em;border:0;cursor:pointer;" onclick="window.location.href='doctor.php'">Cancel</button>
    <?php
    session_name("doctor_session");
    session_start();
    if ($_SESSION['dId']) {
        $dId = $_SESSION['dId'];
        include './../DB/config.php';
        $sql = "SELECT * FROM `doctor` WHERE id='$dId';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
        <form action="" method="post" onsubmit="return doctorSignupValid()">
            <h1>HMS | Doctor Profile Update</h1>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>" required><br>
            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option <?php if ($row['gender'] == 'male') echo "selected" ?> value="male">Male</option>
                <option <?php if ($row['gender'] == 'female') echo "selected" ?> value="female">Female</option>
            </select>
            <br>
            <label for="dob">DOB</label>
            <input type="date" id="dob" name="dob" value="<?php echo $row['dob'] ?>" required><br>
            <label for="phoneNumber">Phone No.</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phone'] ?>" required><br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>" required><br>
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>" required><br>
            <button type="submit" name="doctor_update">Update</button>
        </form>
    <?php
        if (isset($_POST['doctor_update'])) {
            $sql3 = "UPDATE `doctor` SET `name`='" . $_POST['name'] . "',`dob`='" . $_POST['dob'] . "',`phone`='" . $_POST['phoneNumber'] . "',`email`='" . $_POST['email'] . "',`address`='" . $_POST['address'] . "',`gender`='" . $_POST['gender'] . "',`updation_date`= CURRENT_TIMESTAMP WHERE id='$dId';";
            if ($conn->query($sql3)) {
                echo "<script>alert('Update Successful!');</script>";
                echo "<script>window.location.href='./doctor.php'</script>";
            } else {
                echo "<script>alert('Error in Updation');</script>";
                echo "<script>window.location.href='./doctor.php'</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid User Type !')</script>";
        echo "<script>window.location.href='./index.php'</script>";
    }
    ?>

    <script>
        function doctorSignupValid() {
            var name = document.getElementById("name");
            var dob = document.getElementById("dob");
            var phoneNum = document.getElementById("phoneNumber");
            var address = document.getElementById("address");
            if (!isNaN(name.value)) {
                alert("invalid name");
                name.focus();
                return false;
            }

            if (isNaN(phoneNum.value) || (phoneNum.value.length != 10)) {
                alert("Invalid Phone number!");
                phoneNum.focus();
                return false;
            }
            if (!isNaN(address.value)) {
                alert("invalid address");
                address.focus();
                return false;
            }
            return true;
        }
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
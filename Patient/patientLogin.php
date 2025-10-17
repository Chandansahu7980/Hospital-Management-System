<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Patient Login </title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../CSS/login.css">
</head>

<body>

    <div class="middle-container">
        <div class="login-form" id="logIn-form">
            <form action="" method="post" onsubmit="return patientLoginValid()">
                <h1>HMS | Patient LogIn</h1>
                <input type="email" id="loginId" name="loginId" placeholder="Enter email Id" required><br>
                <input type="password" id="loginPW" name="loginPW" placeholder="Password" required><br>
                <button type="submit" name="patient_login">LogIn</button>
                <p><span id="ForPw" onclick="window.location.href='./../Common/passwordReset.php?t=patient'">Forget Password ?</span><br>
                    First time visit ? <span id="signUp-btn">SignUp</span> here</p>
            </form>
        </div>
        <div class="signup-form" id="signUp-form">
            <form action="" method="post" onsubmit="return patientSignupValid()">
                <h1>HMS | Patient SignUp</h1>
                <input type="text" id="patientName" name="patientName" placeholder="Name of the patient" required><br>
                <input type="text" id="patientFatherName" name="patientFatherName" placeholder="Patient's father name" required><br>
                <input type="text" placeholder="DOB (DD/MM/YYYY)" disabled>
                <input type="date" id="dob" name="dob" placeholder="DOB" required><br>
                <div class="gender-cls">
                    <label for="">Gender : </label>
                    <input type="radio" name="gender" id="male" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female" required>
                    <label for="female">Female</label>
                </div>
                <br>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Contact Number" required><br>
                <input type="text" id="emergency_Number" name="Emergency_Number" placeholder="Emergency Contact" required><br>
                <input type="email" id="email" name="email" placeholder="Email: abc@gmail.com" required><br>
                <input type="text" name="address" id="address" required placeholder="Your Address"><br>
                <input type="password" name="password1" id="password1" placeholder="Password" required><br>
                <input type="password" name="password2" id="password2" placeholder="Retype Your Password" required><br>
                <button type="submit" name="patient_signup">SignUp</button>
                <p>Aleredy SignedUp ! <span id="logIn-btn">LogIn</span> here.</p>
            </form>
        </div>
        <p style="text-align:center;margin:auto"><a href="./../index.php" style="color: blue;">Home</a></p>
    </div>

    <?php
    include './../DB/config.php';
    if (isset($_POST['patient_signup'])) {
        $name = $_POST['patientName'];
        $fname = $_POST['patientFatherName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phoneNum = $_POST['phoneNumber'];
        $emergency_Num = $_POST['Emergency_Number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $pswd = $_POST['password1'];

        $sql = "INSERT INTO `patient`(`name`, `fname`, `dob`, `gender`, `phone`, `email`,`address`, `password`,`emergency_contact`,`updation_date`) VALUES ('$name','$fname','$dob','$gender','$phoneNum','$email', '$address','$pswd','$emergency_Num', CURRENT_TIMESTAMP);";

        $success = $conn->query($sql);

        if ($success) {
            echo "<script>alert('Patient data recorded successfully.');</script>";
        } else {
            echo "<script>alert('Unable to record Patient data. Please Try again.');</script>";
        }
    }

    if (isset($_POST['patient_login'])) {
        $loginId = $_POST['loginId'];
        $pswd = $_POST['loginPW'];

        $sql = "SELECT * FROM `patient` WHERE email='$loginId';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $realPW = $row['password'];
            if ($pswd == $realPW) {
                session_name('patient');
                session_start();
                $_SESSION['patient_id'] = $row['id'];

                echo "<script>window.location.href='./patient.php';</script>";
            } else {
                echo "<script>alert('Incorrect Password!');</script>";
            }
        } else {
            echo "<script>alert('Invalid Email Id!');</script>";
        }
    }
    ?>

    <script src="./../JS/login.js"></script>
</body>

</html>
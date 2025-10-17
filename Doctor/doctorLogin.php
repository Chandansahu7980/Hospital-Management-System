<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Doctor Login </title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../CSS/login.css">
</head>

<body>
    <?php
    include './../DB/config.php';
    $sql = "SELECT * FROM `spec_list`;";
    $result = $conn->query($sql);
    ?>

    <div class="middle-container">
        <div class="login-form" id="logIn-form">
            <form method="post" onsubmit="return patientLoginValid()">
                <h1>HMS | Doctor LogIn</h1>
                <input type="email" id="loginId" name="loginId" placeholder="Enter Email Id" required><br>
                <input type="password" id="loginPW" name="loginPW" placeholder="Password" required><br>
                <button type="submit" name="doctor_login">LogIn</button>
                <p><span id="ForPw" onclick="window.location.href='./../Common/passwordReset.php?t=doctor'">Forget Password ?</span><br>
                    First time visit ? <span id="signUp-btn">SignUp</span> here</p>
            </form>
        </div>
        <div class="signup-form" id="signUp-form">
            <form action="" method="post" onsubmit="return doctorSignupValid()" enctype="multipart/form-data">
                <h1>HMS | Doctor SignUp</h1>
                <input type="text" id="name" name="name" placeholder="Name of the Doctor" required><br>
                <input type="text" placeholder="DOB (DD/MM/YYYY)" disabled>
                <input type="date" id="dob" name="dob" required><br>
                <div class="gender-cls">
                    <label for="">Gender : </label>
                    <input type="radio" name="gender" id="male" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female" required>
                    <label for="female">Female</label>
                </div>
                <br>
                <div class="gender-cls">
                    <label for="specialization">Specialization :</label>
                    <select name="specialization" id="specialization" required>
                        <option selected disabled>Select specialization</option>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="WhatsApp Number" required><br>
                <input type="email" id="email" name="email" placeholder="Email: abc@gmail.com" required><br>
                <div class="gender-cls">
                    <label for="passphoto">Passphoto :</label>
                    <input type="file" name="passphoto" id="passphoto" accept="image/*" required>
                </div>
                <br>
                <input type="text" name="address" id="address" placeholder="Address" required><br>
                <input type="password" name="password1" id="password1" placeholder="Password" required><br>
                <input type="password" name="password2" id="password2" placeholder="Retype Your Password" required><br>
                <button type="submit" name="doctor_signup">Register</button>
                <p>Aleredy SignedUp ! <span id="logIn-btn">LogIn</span> here.</p>
            </form>
        </div>
        <p style="text-align:center;margin:auto"><a href="./../index.php" style="color: blue;">Home</a></p>
    </div>

    <?php
    if (isset($_POST['doctor_signup'])) {
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $specialization = $_POST['specialization'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $img = $_FILES['passphoto'];
        $address = $_POST['address'];
        $pwd = $_POST['password1'];
        $imgSrc = "./../Images/DoctorPassphoto/" . $img['name'];
        
        if (move_uploaded_file($img['tmp_name'], $imgSrc)) {
            $sql = "INSERT INTO `doctor`(`name`, `dob`, `spec_id`, `phone`, `email`, `img_src`, `address`, `password`) VALUES ('$name','$dob','$specialization','$phoneNumber','$email','$imgSrc','$address','$pwd');";
            if ($conn->query($sql)) {
                echo "<script>alert('Data Record Successfully');</script>";
            } else {
                echo "<script>alert('Error ! Please Try Agian.');</script>";
            }
        } else {
            echo "<script>alert('Error in reading passphoto.');</script>";
        }
    }

    if (isset($_POST['doctor_login'])) {
        $loginId = $_POST['loginId'];
        $pswd = $_POST['loginPW'];
        $sql = "SELECT * FROM `doctor` WHERE email='$loginId';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $realPW = $row['password'];
            $adminPass = $row['adminPass'];
            if ($adminPass == "pass") {
                if ($pswd == $realPW) {
                    session_name("doctor_session");
                    session_start();
                    $_SESSION['dId'] = $row['id'];
                    echo "<script>window.location.href='./doctor.php'</script>";
                } else {
                    echo "<script>alert('Incorrect Password!');</script>";
                }
            } else {
                echo "<script>alert('Restricted by Admin')</script>";
            }
        } else {
            echo "<script>alert('Invalid Email Id!');</script>";
        }
    }
    ?>

    <script src="./../JS/login.js"></script>
</body>

</html>
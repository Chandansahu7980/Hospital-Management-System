<?php
$table = $_GET['t'];
include './../DB/config.php';
?>

<head>
    <title>Password Reset - HMS</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
    <style>
        h2 {
            text-align: center;
        }

        span {
            font-size: 0.7em;
            color: gray;
        }

        span:nth-child(2) {
            font-size: 0.8em;
        }

        .form1 {
            text-align: center;
        }

        .form2 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form2 div {
            margin: 0.5em auto;
        }

        .form2 input[type='text'],
        .form2 input[type='tel'],
        .form2 input[type='date'] {
            width: 100%;
        }

        button {
            padding: 0.5em 5em;
            border: 1px solid green;

        }

        button:hover {
            background-color: greenyellow;
            transition-duration: 0.5s;
            border-radius: 0.5em;
        }
    </style>
</head>

<body>
    <h2>Reset Profile Password
        <hr>
    </h2>
    <form action="" method="post" class="form1">
        <input type="email" name="email" placeholder="Enter Email Id here" required>
        <input type="submit" value="Click" name="checkProfile" id="click">
    </form>
    <button style="position: absolute;right:1em;top:1em;background:red;color:white" onclick="window.location.href='./../index.php'">Cancel</button>
    <?php
    if (isset($_POST['checkProfile'])) {
        $result = $conn->query("SELECT * FROM " . $table . " WHERE email = '" . $_POST['email'] . "'");
        // echo "check profile";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <div class="form2">
                <form action="passwordReset.php?t=<?php echo $table ?>" method="post">
                    <input type="email" name="email" value="<?php echo $row['email'] ?>" readonly hidden>
                    <div>Name: <input type="text" name="name" value="<?php echo $row['name'] ?>" readonly><br><span>/* Please verify your account befor reset. */</span></div>
                    <div>Phone: <input type="tel" name="phone" placeholder="Enter Phone Number" required></div>
                    <div>DOB: <input type="date" name="dob" required></div>
                    <div>Gender: <input type="radio" name="gender" id="male" value="male" required> <label for="male">Male</label> <input type="radio" name="gender" id="female" value="female"><label for="female">Female</label></div>
                    <button name="resetPW">Reset PW</button>
                </form>
                <span>
                    N.B: Password is case sensetive. On reset your password is set to be first 4 letters from your name (including spaces), your date of year and 'm/f' for male/female. <br>For e.g. Name:Chandan k s, DOB: 12/10/2002, Male. Password: Chan2002m
                </span>
            </div>

    <?php
        } else {
            switch ($table) {
                case 'patient':
                    echo "You Don't have any account. Please Sign Up <a href='patientLogin.php'>here</a>";
                    break;
                case 'doctor':
                    echo "You Don't have any account. Please Sign Up <a href='doctorLogin.php'>here</a>";
                    break;
                default:
                    echo "You Don't have any account. <a href='index.php'>Click here</a>";
                    break;
            }
        }
    }
    if (isset($_POST['resetPW'])) {
        $row = $conn->query("SELECT `dob`, `gender`,`phone` FROM " . $table . " WHERE email='" . $_POST['email'] . "'")->fetch_assoc();
        // print_r($row);
        if ($row['phone'] == $_POST['phone'] && $row['dob'] == $_POST['dob'] && $row['gender'] == $_POST['gender']) {
            $password = substr($_POST['name'], 0, 4) . substr($_POST['dob'], 0, 4) . substr($_POST['gender'], 0, 1);
            if ($conn->query("UPDATE " . $table . " SET `password`='" . $password . "' WHERE email='" . $_POST['email'] . "'")) {
                echo "<script>alert('Password Reset Successfully.');window.location.href='index.php'</script>";
            } else {
                echo "Error while updating in db";
            }
        } else {
            echo "Provided data doesn't meet with your profile.";
        }
    }
    ?>

</body>
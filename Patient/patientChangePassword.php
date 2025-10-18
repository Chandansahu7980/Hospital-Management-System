<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTS - Patient Change Password Page</title>
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
    ?>
        <form action="" method="post" onsubmit="return pwValid()">
            <h1>HMS | Patient Update Password</h1>
            <label for="old_pw">Old Password</label>
            <input type="password" name="old_pw" id="old_pw" required>
            <label for="new_pw1">New Password</label>
            <input type="password" name="new_pw1" id="new_pw1" required>
            <label for="new_pw2">Retype New Password</label>
            <input type="password" name="new_pw2" id="new_pw2" required>
            <button type="submit" name="update_password">UPDATE</button>
        </form>
    <?php
        if (isset($_POST['update_password'])) {
            $current = $_POST['old_pw'];
            $new = $_POST['new_pw1'];

            include './../DB/config.php';
            $sql1 = "SELECT `password` FROM `patient` WHERE id='$pId';";
            $result = $conn->query($sql1);
            $row = $result->fetch_assoc();
            $orgPw = $row['password'];

            // echo $orgPw;
            if ($orgPw == $current) {
                $sql2 = "UPDATE `patient` SET `password`='$new' WHERE id='$pId';";
                if ($conn->query($sql2)) {
                    session_unset();
                    session_destroy();
                    echo "<script>alert('Password Changed Successful!')</script>";
                    echo "<script>window.location.href='./patientLogin.php'</script>";
                } else {
                    echo "<script>alert('Error in Updation !');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Invalid User Type !')</script>";
        echo "<script>window.location.href='./../index.php'</script>";
    }

    ?>

    <script>
        function pwValid() {
            var pw1 = document.getElementById("old_pw");
            var pw2 = document.getElementById("new_pw1");
            var pw3 = document.getElementById("new_pw2");
            if ((pw1.value.length < 6) || (pw2.value.length < 6)) {
                alert("Password atleast contain 6 character.");
                return false;
            }
            if (pw2.value != pw3.value) {
                alert("Retype password must be same with new password");
                return false;
            }
            return true;
        }
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./../Common/internetError.html');
        }
    </script>

</body>

</html>
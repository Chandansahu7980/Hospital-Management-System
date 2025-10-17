<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient - HMS Doctor</title>
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
    <style>
        input,
        select,
        label {
            padding: 0.4em;
            border: 0;
            outline: 0;
            width: 200px;
        }

        .submit {
            background-color: gray;
            color: white;
            margin: 1em;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .submit:hover {
            border-radius: 0.3em;
            transition-duration: 1s;
            background-color: lightgreen;
        }

        button {
            border: 0;
            padding: 0.5em;
            cursor: pointer;
            font-weight: 700;
            letter-spacing: 1px;
            transition-duration: 0.5s;
        }

        button:hover {
            background-color: red;
            color: white;
            border-radius: 0.4em;
            border: 0;
        }
    </style>
</head>

<body>
    <center>
        <h2>Add Patient</h2>
        <hr style="width: 40%;">
        <form method="post">
            <table border="1" cellspacing="0">
                <tr>
                    <th><label for="name">Name</label></th>
                    <td><input type="text" id="name" name="name" required></td>
                </tr>
                <tr>
                    <th><label for="phone">Phone</label></th>
                    <td><input type="number" name="phone" id="phone" required></td>
                </tr>
                <tr>
                    <th><label for="email">Email</label></th>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
                <tr>
                    <th><label for="dob">DOB</label></th>
                    <td><input type="date" name="dob" id="dob" required></td>
                </tr>
                <tr>
                    <th><label for="gender">Gender</label></th>
                    <td>
                        <select name="gender" id="gender" required>
                            <option value="" selected disabled>Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="address">Address</label></th>
                    <td>
                        <input type="text" name="address" id="address" required>
                    </td>
                </tr>
                <tr>
                    <th><label for="disease">Disease</label></th>
                    <td><input type="text" id="disease" name="disease" required></td>
                </tr>
            </table>
            <input type="submit" value="CREATE" class="submit" name="CREATE">
        </form>
        <button onclick="window.location.href='doctor.php'">Cancel</button>
    </center>
    <?php
    session_name("doctor_session");
    session_start();
    include './config.php';
    if ($_SESSION['dId']) {
        if (isset($_POST['CREATE'])) {
            // password = first 4 letter from name, dob year, gender in 'f/m'
            $password = substr($_POST['name'], 0, 4) . substr($_POST['dob'], 0, 4) . substr($_POST['gender'], 0, 1);

            $sql = "INSERT INTO `patient`(`name`, `dob`, `gender`, `email`, `password`, `disease`,`phone`,`address`) VALUES ('" . $_POST['name'] . "','" . $_POST['dob'] . "','" . $_POST['gender'] . "','" . $_POST['email'] . "','" . $password . "','" . $_POST['disease'] . "','" . $_POST['phone'] . "','" . $_POST['address'] . "')";

            if ($conn->query($sql)) {
                echo "<script>alert('Patient Created !');</script>";
                echo "<script>window.location.href='doctor.php'</script>";
            } else {
                echo "<script>alert('Some error happens. Patient Not created.')</script>";
            }
        }
    } else {
        echo "Error in reading your profile. Please relogin and try.";
    }
    ?>
    <!-- Check Online -->
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('internetError.html');
        }
    </script>
</body>

</html>
<head>
    <title>HMS-Admin: New Data Entry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <style>
        form {
            margin: auto;
            text-align: center;
        }

        table {
            margin: auto;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 0.3em;
            border: 1px solid black;
            text-align: left;
        }

        input {
            outline: 0;
            border: 0;
        }

        select {
            outline: 0;
            border: 0;
        }

        button {
            background-color: greenyellow;
            margin: 1em auto;
            padding: 0.5em 1em;
            outline: 0;
            border: 0;
            font-weight: bold;
            border-radius: 0.3em;
        }

        button:hover {
            background-color: lightseagreen;
            color: white;
            transition-duration: 0.5s;
        }

        .cancel {
            position: absolute;
            top: 1em;
            right: 1em;
            padding: 0.3em;
            border: 2px red solid;
            cursor: pointer;
            transition-duration: 0.5s;
            border-radius: 5px;
        }

        .cancel i {
            transition-duration: 0.5s;
            color: red;
        }

        .cancel:hover {
            background-color: red;
            color: white;
        }

        .cancel:hover i {
            color: white;
        }
    </style>
</head>

<?php
session_name('admin');
session_start();
include './../DB/config.php';
$tableName = $_GET['tb'];
?>
<span onclick="window.location.href='admin.php'" class="cancel"><a href=""><i class="fa-solid fa-left-long"></i></a>&nbsp; Cancel</span>

<?php
switch ($tableName) {
    case 'dept':
?>
        <form action="" method="post">
            <h2>Add New Department</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input type="text" name="desc" id="desc" required></td>
                </tr>
            </table>
            <button name="addNewDept">Add Department</button>
        </form>
    <?php
        break;
    case 'doc':
    ?>
        <form method="post">
            <h2>Add New Doctor</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><input type="date" name="dob" id="dob" required></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <input type="radio" name="gender" value="male" id="male"><label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female"><label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        <select name="spec_Id" id="spec_Id" required>
                            <option value="" selected disabled>Select</option>
                            <?php
                            $specIdResult = $conn->query("SELECT `id`, `name` FROM `spec_list` ");
                            while ($row = $specIdResult->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="number" name="phone" id="phone" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="eamil" name="email" id="email" required></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input type="text" name="address" required></td>
                </tr>
            </table>
            <button name="addNewDoc">Add Doctor</button>
        </form>
    <?php
        break;
    case 'pat':
    ?>
        <form method="post">
            <h2>Add New Patient</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <th>Father's Name</th>
                    <td><input type="text" name="fname" id="fname" required></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><input type="date" name="dob" id="dob" required></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <input type="radio" name="gender" value="Male" id="male" required><label for="male">Male</label>
                        <input type="radio" name="gender" value="Female" id="female" required><label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="number" name="phone" required></td>
                </tr>
                <tr>
                    <th>Emergency Contact</th>
                    <td><input type="number" name="emrphone" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input type="text" name="address" required></td>
                </tr>
            </table>
            <button name="AddNewPat">Add Patient</button>
        </form>
    <?php
        break;
    case 'apnt':
    ?>
        <form method="post">
            <h2>Book Appoinment</h2>
            <hr>
            <table>
                <tr>
                    <th>Patient</th>
                    <td>
                        <select name="patId" id="patId" required>
                            <option value="" selected disabled>Select</option>
                            <?php
                            $PatIdResult = $conn->query("SELECT `id`, `name`, `dob` FROM `patient` ");
                            while ($row = $PatIdResult->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] . " : " . $row['dob'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        <select name="spec_Id" id="spec_Id" required>
                            <option value="" selected disabled>Select</option>
                            <?php
                            $specIdResult = $conn->query("SELECT `id`, `name` FROM `spec_list` ");
                            while ($row = $specIdResult->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Doctor</th>
                    <td>
                        <select name="docId" id="docId" required>
                            <option value="" selected disabled>Select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="date" id="date" required></td>
                </tr>
                <tr>
                    <th>Time Slot</th>
                    <td>
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
                    </td>
                </tr>
            </table>
            <button name="bookApnt">Book Appoinment</button>
        </form>
<?php
        break;
    default:
        echo "Currupted Session LogIn Again";
        break;
}

if ($_SESSION['aId']) {
    if (isset($_POST['addNewDept'])) {
        // echo $_POST['name'];
        // echo $_POST['desc'];

        if ($conn->query("INSERT INTO `spec_list`(`name`, `spec_desc`) VALUES ('" . $_POST['name'] . "','" . $_POST['desc'] . "')")) {
            echo "<script>alert('New Department Added.');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error In adding New Data.')</script>";
        }
    }

    if (isset($_POST['addNewDoc'])) {
        // echo $_POST['name'] . $_POST['dob'] . $_POST['gender'] . $_POST['spec_Id'] . $_POST['phone'] . $_POST['email'] . $_POST['address'];

        $password = substr($_POST['name'], 0, 4) . substr($_POST['dob'], 0, 4) . substr($_POST['gender'], 0, 1);

        if ($conn->query("INSERT INTO `doctor`(`name`, `dob`, `gender`, `spec_id`, `phone`, `email`, `address`,`password`) VALUES ('" . $_POST['name'] . "','" . $_POST['dob'] . "','" . $_POST['gender'] . "','" . $_POST['spec_Id'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "','" . $_POST['address'] . "','" . $password . "')")) {
            echo "<script>alert('New Doctor Added.');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error In adding New Data.')</script>";
        }
    }

    if (isset($_POST['AddNewPat'])) {
        // echo $_POST['name'] . $_POST['fname'] . $_POST['dob'] . $_POST['gender'] . $_POST['phone'] . $_POST['emrphone'] . $_POST['email'];

        $password = substr($_POST['name'], 0, 4) . substr($_POST['dob'], 0, 4) . substr($_POST['gender'], 0, 1);
        // echo $password;

        if ($conn->query("INSERT INTO `patient`(`name`, `fname`, `dob`, `gender`, `phone`, `email`, `address`, `emergency_contact`, `password`) VALUES ('" . $_POST['name'] . "','" . $_POST['fname'] . "','" . $_POST['dob'] . "','" . $_POST['gender'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "','" . $_POST['address'] . "','" . $_POST['emrphone'] . "','" . $password . "')")) {
            echo "<script>alert('New Patient Added.');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error In adding New Data.')</script>";
        }
    }

    if (isset($_POST['bookApnt'])) {
        echo $_POST['patId'] . $_POST['spec_Id'] . $_POST['docId'] . $_POST['date'] . $_POST['slot'];

        if ($conn->query("INSERT INTO `apnts`(`patient_id`, `spec_id`, `doct_id`, `date`, `time`) VALUES ('" . $_POST['patId'] . "','" . $_POST['spec_Id'] . "','" . $_POST['docId'] . "','" . $_POST['date'] . "','" . $_POST['slot'] . "')")) {
            echo "<script>alert('Appoinment Booked.');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error In adding New Data.')</script>";
        }
    }
} else {
    echo "Currepted Access ! <a href='./adminLogin.php'>Relogin</a> ";
}



?>
<script>
    $(document).ready(function() {
        $("#spec_Id").change(function() {
            $.ajax({
                method: 'POST',
                url: './../loadDoctorList.php',
                data: "spec_Id=" + $("#spec_Id").val()
            }).done(function(data) {
                $("#docId").html(data);
            });
        });
    });
</script>
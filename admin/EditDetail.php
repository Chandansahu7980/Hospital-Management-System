<?php
session_name('admin');
session_start();
include './../config.php';
$tableName = $_GET['t'];
$id = $_GET['id'];
?>

<head>
    <title>Admin: Update Data - HMS</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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

        input,
        textarea {
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

<span onclick="window.location.href='admin.php'" class="cancel"><a href=""><i class="fa-solid fa-left-long"></i></a>&nbsp; Cancel</span>

<?php
$row = $conn->query("SELECT * FROM `" . $tableName . "` WHERE id='" . $id . "';")->fetch_assoc();

switch ($tableName) {
    case 'spec_list':
?>
        <form action="" method="post">
            <h2>Update Department Detail</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" value="<?php echo $row['name'] ?>" required></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><textarea name="desc" cols="30" rows="10" required><?php echo $row['spec_desc'] ?></textarea>
                    </td>
                </tr>
            </table>
            <button name="dept_update">Update</button>
        </form>
    <?php
        break;
    case 'doctor':
    ?>
        <form action="" method="post">
            <h2>Update Doctor Details</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" value="<?php echo $row['name'] ?>" required></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><input type="date" name="dob" value="<?php echo $row['dob'] ?>" required></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <select name="gender" required>
                            <option <?php if ($row['gender'] == 'male') echo "selected" ?> value="male">Male</option>
                            <option <?php if ($row['gender'] == 'female') echo "selected" ?> value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Education</th>
                    <td><input type="text" name="education" value="<?php echo $row['education'] ?>"></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        <select name="spec_id" required>
                            <?php
                            $result = $conn->query("SELECT * FROM `spec_list`;");
                            while ($dept = $result->fetch_assoc()) {
                            ?>
                                <option <?php if ($dept['id'] == $row['spec_id']) echo "selected" ?> value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="number" name="phone" value="<?php echo $row['phone'] ?>" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" value="<?php echo $row['email'] ?>" required></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input type="text" name="address" value="<?php echo $row['address'] ?>" required></td>
                </tr>
                <tr>
                    <th>License InFo.</th>
                    <td><input type="text" name="license_info" value="<?php echo $row['license_info'] ?>"></td>
                </tr>
                <tr>
                    <th>Experience</th>
                    <td><input type="number" name="experience" value="<?php echo $row['experience'] ?>"></td>
                </tr>
                <tr>
                    <th>Fees</th>
                    <td><input type="number" name="fees" value="<?php echo $row['fees'] ?>" required></td>
                </tr>
            </table>
            <button name="doc_update">Update</button>
        </form>
    <?php
        break;
    case 'patient':
    ?>
        <form action="" method="post">
            <h2>Update Patient Details</h2>
            <hr>
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" value="<?php echo $row['name'] ?>" required></td>
                </tr>
                <tr>
                    <th>Father's Name</th>
                    <td><input type="text" name="fname" value="<?php echo $row['fname'] ?>" required></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><input type="date" name="dob" value="<?php echo $row['dob'] ?>" required></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <select name="gender" required>
                            <option <?php if ($row['gender'] == 'male') echo "selected" ?> value="male">Male</option>
                            <option <?php if ($row['gender'] == 'female') echo "selected" ?> value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="number" name="phone" value="<?php echo $row['phone'] ?>" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" value="<?php echo $row['email'] ?>" required></td>
                </tr>
                <tr>
                    <th>Emergency Contact</th>
                    <td><input type="number" name="emrphone" value="<?php echo $row['emergency_contact'] ?>" required></td>
                </tr>
                <tr>
                    <th>Disease</th>
                    <td><input type="text" name="disease" value="<?php echo $row['disease'] ?>" required></td>
                </tr>
                <tr>
                    <th>Treatment Status</th>
                    <td>
                        <select name="treatSts" required>
                            <option <?php if ($row['treatment_status'] == 'ongoing') echo "selected" ?> value="ongoing">Ongoing</option>
                            <option <?php if ($row['treatment_status'] == 'closed') echo "selected" ?> value="closed">Closed</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button name="pat_update">Update</button>
        </form>
    <?php
        break;
    case 'queries':
    ?>
        <form action="" method="post">
            <h2>Update Patient Queries</h2>
            <hr>
            <table>
                <tr>
                    <th>Patient Query</th>
                    <td>
                        <textarea style="height:100px" name="pat_query" readonly required><?php echo $row['query_text'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Intended Department</th>
                    <td>
                        <select name="dept_id">
                            <option value="" selected>None</option>
                            <?php
                            $depts = $conn->query("SELECT `id`, `name` FROM `spec_list`");
                            while ($d = $depts->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $d['id'] ?>" <?php if ($d['id'] == $id) echo "selected"; ?>><?php echo $d['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Query Response</th>
                    <td><textarea style="height: 100px;" name="q_res"><?php echo $row['query_response'] ?></textarea></td>
                </tr>
            </table>
            <button name="query_update">Update</button>
        </form>
<?php
        break;
    default:
        # code...
        break;
}

if ($_SESSION['aId']) {
    if (isset($_POST['dept_update'])) {
        // echo $_POST['name'] . $_POST['desc'];
        if ($conn->query("UPDATE `spec_list` SET `name`='" . $_POST['name'] . "',`spec_desc`='" . $_POST['desc'] . "' WHERE id='" . $id . "';")) {
            echo "<script>alert('Data Updation Successfully');window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error while updating.')</script>";
        }
    }

    if (isset($_POST['doc_update'])) {
        if ($conn->query("UPDATE `doctor` SET `name`='" . $_POST['name'] . "',`dob`='" . $_POST['dob'] . "',`gender`='" . $_POST['gender'] . "',`education`='" . $_POST['education'] . "',`spec_id`='" . $_POST['spec_id'] . "',`phone`='" . $_POST['phone'] . "',`email`='" . $_POST['email'] . "',`address`='" . $_POST['address'] . "',`license_info`='" . $_POST['license_info'] . "',`experience`='" . $_POST['experience'] . "', `fees`='" . $_POST['fees'] . "',`updation_date`=CURRENT_TIMESTAMP WHERE id='" . $id . "'")) {
            echo "<script>alert('Data Updation Successfully');window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error while updating.')</script>";
        }
    }

    if (isset($_POST['pat_update'])) {
        if ($conn->query("UPDATE `patient` SET `name`='" . $_POST['name'] . "',`fname`='" . $_POST['fname'] . "',`dob`='" . $_POST['dob'] . "',`gender`='" . $_POST['gender'] . "',`phone`='" . $_POST['phone'] . "',`email`='" . $_POST['email'] . "',`emergency_contact`='" . $_POST['emrphone'] . "',`disease`='" . $_POST['disease'] . "',`treatment_status`='" . $_POST['treatSts'] . "', `updation_date`= CURRENT_TIMESTAMP WHERE id=" . $id)) {
            echo "<script>alert('Data Updation Successfully');window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error while updating.')</script>";
        }
    }

    if (isset($_POST['query_update'])) {
        // echo $_POST['q_res'];
        if ($conn->query("UPDATE `queries` SET `intended_dept_id`='" . $_POST['dept_id'] . "',`query_response`='" . $_POST['q_res'] . "' WHERE id=" . $id)) {
            echo "<script>alert('Data Updation Successfully');window.location.href='admin.php'</script>";
        } else {
            echo "<script>alert('Error while updating.')</script>";
        }
    }
} else {
    echo "Currepted Access ! <a href='./adminLogin.php'>Relogin</a> ";
}

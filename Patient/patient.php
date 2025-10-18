<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS - Patient Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./../CSS/patient.css">
    <link rel="stylesheet" href="./../CSS/footer.css">
</head>

<body>
    <?php
    error_reporting(0);
    session_name('patient');
    session_start();

    if ($_SESSION['patient_id']) {
        $patientId = $_SESSION['patient_id'];
        include './../DB/config.php';
        $queries = $conn->query("SELECT * FROM `queries` WHERE pat_id=" . $_SESSION['patient_id']);
        $sql = "SELECT * FROM `patient` WHERE id='$patientId';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $fname = $row['fname'];
            $dob = $row['dob'];
            $gender = $row['gender'];
            $phone = $row['phone'];
            $emr_phone = $row['emergency_contact'];
            $email = $row['email'];
            $address = $row['address'];
            $disease = $row['disease'];
            $treat_sts = $row['treatment_status'];
    ?>
            <!-- Patient Write Query -->
            <div class="query_raise_form">
                <form action="" method="post">
                    <i title="Close" class="fa-solid fa-xmark fa-fade close_query_form" style="color: #ffffff;"></i>
                    <label for="dept">Intended Department : </label>
                    <select name="dept" id="dept">
                        <option value="" selected disabled>Select</option>
                        <?php
                        $depts = $conn->query("SELECT * FROM `spec_list`;");
                        while ($dept = $depts->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <textarea name="query_text" id="query_text" placeholder="Enter Your Query here..." required></textarea><br>
                    <span>/* write upto 150 word */</span><br>
                    <button name="sendQ">Send <i class="fa-solid fa-paper-plane" style="color: #006bbd;"></i></button>
                </form>
                <?php
                if (isset($_POST['sendQ'])) {
                    if ($conn->query("INSERT INTO `queries`(`pat_id`, `query_text`, `posted_time`, `intended_dept_id`) VALUES ('" . $_SESSION['patient_id'] . "','" . $_POST['query_text'] . "',CURRENT_TIMESTAMP,'" . $_POST['dept'] . "')")) {
                        echo "<script>alert('Query Recorded.'); window.location.href='patient.php'</script>";
                    } else {
                        echo "<script>alert('Error while recording query.')</script>";
                    }
                }
                ?>
            </div>

            <!-- Main Container -->
            <div class="container">
                <div class="left-container" id="left-container">
                    <div class="head">
                        <h1 id="hms-heading">HMS</h1>
                        <label for="bar-check" title="Side Bar"><i class="fa-solid fa-circle-left"></i></i></label>
                        <input type="checkbox" id="bar-check" onclick="toggleSidebar()" hidden>
                    </div>
                    <hr style="border: 0;height:1px;background:white;"><br>
                    <ul id="side-ul">
                        <li id="profile-btn" title="Profile"><i class="fa-solid fa-user"></i><span class="list-item">My&nbsp;Profile</span></li>
                        <li id="bookApnt-btn" title="Book Appoinment"><i class="fa-solid fa-calendar-check"></i><span class="list-item">Book&nbsp;Appoinment</span></li>
                        <li id="apntHtry-btn" title="Appointment History"><i class="fa-solid fa-list-check"></i><span class="list-item">Appoinment&nbsp;History</span></li>
                        <li id="medical_htry-btn" title="Medical History"><i class="fa-regular fa-rectangle-list"></i><span class="list-item">Medical&nbsp;History</span></li>
                        <li id="query-btn" title="Queries"><i class="fa-solid fa-comments"></i><span class="list-item">Queries</span></li>
                        <li id="log-out-btn" title="LogOut"><i class="fa-solid fa-right-from-bracket"></i><span class="list-item">LogOut</span></li>
                    </ul>
                </div>

                <div class="right-container" id="right-container">
                    <div class="rgt-cont" id="profile-div">
                        <h1>Patient Profile</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <table border="1" cellspacing="0" class="profile-view-tbl">
                            <tr>
                                <td><b>Name</b></td>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td><b>Father's Name</b></td>
                                <td><?php echo $fname; ?></td>
                            </tr>
                            <tr>
                                <td><b>DOB</b></td>
                                <td><?php echo $dob; ?></td>
                            </tr>
                            <tr>
                                <td><b>Gender</b></td>
                                <td><?php echo $gender; ?></td>
                            </tr>
                            <tr>
                                <td><b>Phone Number</b></td>
                                <td><?php echo $phone; ?></td>
                            </tr>
                            <tr>
                                <td><b>Emergency Contact</b></td>
                                <td><?php echo $emr_phone; ?></td>
                            </tr>
                            <tr>
                                <td><b>Email Address</b></td>
                                <td id="email"><?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <td><b>Address</b></td>
                                <td><?php echo $address ?></td>
                            </tr>
                            <tr>
                                <td><b>Disease</b></td>
                                <td><?php echo $disease; ?></td>
                            </tr>
                            <tr>
                                <td><b>Treatment Status</b></td>
                                <td><?php echo $treat_sts; ?></td>
                            </tr>
                        </table>
                        <div class="edit-btns">
                            <button title="Edit Profile" onclick="window.location.replace('./patientProfileEdit.php')"><i class="fa-solid fa-user-pen"></i></button>
                            <button title="Change Password" onclick="window.location.replace('./patientChangePassword.php')"><i class="fa-solid fa-key"></i></button>
                        </div>
                    </div>

                    <div class="rgt-cont" id="book-apnt">
                        <h1>Book Appointment</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <form action="./bookApnt.php" method="post">
                            <label for="spec">Doctor Specialization</label>
                            <select name="spec" id="spec" required>
                                <option value="" selected disabled>Select</option>
                                <?php
                                $sql2 = "SELECT * FROM `spec_list`;";
                                $result2 = $conn->query($sql2);
                                while ($row2 = $result2->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row2['id'] ?>" id="<?php echo $row2['id'] ?>"><?php echo $row2['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label for="doct">Select Doctor</label>
                            <select name="doct" id="doct" required>
                                <option value="">Select Doctor</option>
                            </select>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" required>
                            <label for="time">Time</label>
                            <select name="time" id="time" required>
                                <option value="" disabled selected>Select Slot</option>
                                <option value="10:00 - 10:30">10:00 - 10:30</option>
                                <option value="10:30 - 11:00">10:30 - 11:00</option>
                                <option value="11:00 - 11:30">11:00 - 11:30</option>
                                <option value="11:30 - 12:00">11:30 - 12:00</option>
                                <option value="12:00 - 12:30">12:00 - 12:30</option>
                                <option value="12:30 - 13:00">12:30 - 13:00</option>
                                <option value="14:00 - 14:30">14:00 - 14:30</option>
                                <option value="14:30 - 15:00">14:30 - 15:00</option>
                            </select><br>
                            <input type="submit" name="apnt-book-submit" value="Book Appointment">
                        </form>
                    </div>

                    <div class="rgt-cont" id="apnt-htry">
                        <h1>Appointment History</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <table border="1" cellspacing="0">
                            <tr>
                                <th>Sl no</th>
                                <th>Doctor Name</th>
                                <th>Specialization</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Current Status</th>
                                <th>Download Tkt</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $result3 = $conn->query("SELECT * FROM `apnts` WHERE patient_id='$patientId' ORDER BY date DESC");
                            $slNo = 1;
                            while ($row3 = $result3->fetch_assoc()) {
                                $currentRowId = $row3['id'];
                                $result4 = $conn->query("SELECT `name`,`fees` FROM `doctor` WHERE id='" . $row3['doct_id'] . "'");
                                $row4 = $result4->fetch_assoc();
                                $result5 = $conn->query("SELECT `name`FROM `spec_list` WHERE id='" . $row3['spec_id'] . "'");
                                $row5 = $result5->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $slNo ?></td>
                                    <td><?php echo $row4['name'] ?></td>
                                    <td><?php echo $row5['name'] ?></td>
                                    <td><?php echo $row3['date'] ?></td>
                                    <td><?php echo $row3['time'] ?></td>
                                    <td><?php echo $row3['status'] ?></td>
                                    <td><?php if ($row3['status'] == 'active') {
                                        ?><a href="apntTktDownload.php?a=<?php echo $row3['id'] ?>" target="_blank">ApntTkt <i class="fa-solid fa-file-arrow-down" style="color: #004bcc;"></i></a>
                                        <?php
                                        } else {
                                            echo $row3['status'];
                                        }  ?></td>
                                    <td>
                                        <?php
                                        switch ($row3['status']) {
                                            case 'active':
                                        ?>
                                                <button onclick="confirmCancellTkt(<?php echo $currentRowId ?>)" style="border:0;background:red;color:white;padding:5px 20px;cursor:pointer;">Cancel</button>
                                        <?php
                                                break;
                                            case 'cancelled':
                                                echo "<span style='color:red'>Cancelled❌</span>";
                                                break;
                                            case 'attended':
                                                echo "<b style='color:green'>Already Taken✅</b>";
                                                break;
                                            default:
                                                echo "<b style='color:rgb(255, 98, 124)'>Missed💔</b>";
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $slNo += 1;
                            }
                            ?>
                        </table>
                    </div>

                    <div class="rgt-cont" id="mdl-htry">
                        <h1>Medical History</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <table border="1" cellspacing="0">
                            <tr>
                                <th>Sl no</th>
                                <th>Docter Name</th>
                                <th>BP (mmHg)</th>
                                <th>Weight (KG)</th>
                                <th>Blood Sugar(mg/dL)</th>
                                <th>Temp.(F)</th>
                                <th>Description</th>
                                <th>Visit Date</th>
                                <th>Prescription</th>
                            </tr>
                            <?php
                            $result6 = $conn->query("SELECT * FROM `medi_hist` WHERE pat_id='$patientId'");
                            $slNo = 1;
                            while ($row6 = $result6->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $slNo ?></td>
                                    <td><?php echo $conn->query("SELECT  `name` FROM `doctor` WHERE id IN (SELECT apnts.doct_id FROM apnts WHERE id IN (SELECT medi_hist.apnt_id FROM medi_hist WHERE id=" . $row6['id'] . "))")->fetch_assoc()['name'] ?></td>
                                    <td><?php echo $row6['blood_pressure'] ?></td>
                                    <td><?php echo $row6['weight'] ?></td>
                                    <td><?php echo $row6['blood_sugar'] ?></td>
                                    <td><?php echo $row6['temp'] ?></td>
                                    <td><?php echo $row6['description'] ?></td>
                                    <td><?php echo $row6['date_updated'] ?></td>
                                    <td><a href="mediDescDownload.php?m=<?php echo $row6['id'] ?>" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-download fa-beat-fade"></i>Download</a></td>
                                </tr>
                            <?php
                                $slNo += 1;
                            }
                            ?>
                        </table>
                    </div>

                    <div class="rgt-cont" id="queries">
                        <h1>Queries</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <div class="chat-hist">
                            <?php
                            while ($Q = $queries->fetch_assoc()) {
                            ?>
                                <div class="chat-card">
                                    <div class="sender">
                                        <i class="fa-solid fa-user" title="Patient"></i>
                                        <p><?php echo $Q['query_text'] ?><br>
                                            <span>
                                                <?php
                                                echo $Q['posted_time'];
                                                if ($Q['status'] != 'answered') {
                                                ?>
                                                    <i onclick="confirmRedir(<?php echo $Q['id'] ?>)" title="Delete Query" class="fa-regular fa-trash-can"></i>
                                            </span>
                                        <?php
                                                }
                                        ?>
                                        </p>
                                    </div>
                                    <?php
                                    if ($Q['status'] == 'answered') {
                                    ?>
                                        <div class="receiver">
                                            <i class="fa-solid fa-user-doctor" title="Doctor"></i>
                                            <p><?php echo $Q['query_response'] ?><br><span><?php echo $Q['answered_time'] ?> </span></p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <i title="Raise Query" class="fa-solid fa-message raise_query"></i>
                    </div>

                    <div class="rgt-cont" id="log-out">
                        <h1>Patient LogOut</h1><br>
                        <hr style="border: none;height:2px; background-color: gray;"><br>
                        <form method="post">
                            <h3>Are you sure to logout?</h3>
                            <button name="pt-logout">Logout</button>
                        </form>
                        <?php
                        if (isset($_POST['pt-logout'])) {
                            session_unset();
                            session_destroy();
                            echo "<script>alert('Patient LogOut Successful');</script>";
                            echo "<script>window.location.href='./../index.php'</script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
    <?php
            include './../footer.php';
        }
    } else {
        echo "<script>alert('Please Login!')</script>";
        echo "<script>window.location.href='./patientLogin.php'</script>";
    }
    ?>

    <script src="./../JS/patient.js"></script>
    <script>
        $(document).ready(function() {
            $("#spec").change(function() {
                var spec_Id = $("#spec").val();
                $.ajax({
                    method: 'POST',
                    url: './../Common/loadDoctorList.php',
                    data: 'spec_Id=' + spec_Id
                }).done(function(docts) {
                    console.log(docts);
                    $("#doct").html(docts);
                });
            });
        });

        function confirmRedir(a) {
            if (confirm("Are you sure ?")) {
                window.location.href = 'deleteQuery.php?id=' + a;
            }
        }

        function confirmCancellTkt(a) {
            if (confirm("Are You Sure?")) {
                window.location.href = 'cancelApnt.php?id=' + a;
            }
        }

        var dateInput = document.getElementById("date");
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        var formattedTomorrow = tomorrow.toISOString().substr(0, 10);
        var nextWeek = new Date();
        nextWeek.setDate(nextWeek.getDate() + 7);
        var formattedNextWeek = nextWeek.toISOString().substr(0, 10);
        // dateInput.setAttribute("value", formattedTomorrow);
        dateInput.min = formattedTomorrow;
        dateInput.max = formattedNextWeek;
    </script>

    <!-- Check Online  -->
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./../Common/internetError.html');
        }
    </script>
</body>

</html>
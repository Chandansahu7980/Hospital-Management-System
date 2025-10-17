<?php
session_name("doctor_session");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS - Doctor Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../CSS/patient.css">
    <link rel="stylesheet" href="./../CSS/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <style>
        /* For Patient Query Section */
        .chat-hist .sender {
            flex-direction: row;
            justify-content: start;
        }

        .chat-hist .receiver {
            flex-direction: row-reverse;
            justify-content: end;
        }
        
    </style>
</head>

<body>
    <div class="mid-cont">
        <form action="" method="post" enctype="multipart/form-data">
            <span class="close-mid"><i class="fa-solid fa-xmark"></i></span>
            <label for="passPhoto">Choose PassPhoto</label>
            <input type="file" name="passPhoto" id="passPhoto" accept="image/*" required>
            <button type="submit" name="update-doc-dp">Update</button>
        </form>
    </div>
    <?php
    if ($_SESSION['dId']) {
        include './../DB/config.php';
        $row = $conn->query("SELECT * FROM `doctor` WHERE id='" . $_SESSION['dId'] . "'")->fetch_assoc();

        $_SESSION['dept_id'] = $row['spec_id'];

        $queries = $conn->query("SELECT * FROM `queries` WHERE doc_id='" . $_SESSION['dId'] . "' AND status='answered'");

        $noOfPendingQ = $conn->query("SELECT COUNT(id) AS no_of_pendingQ FROM queries WHERE (intended_dept_id=" . $_SESSION['dept_id'] . " OR intended_dept_id='') AND status='pending'")->fetch_assoc()['no_of_pendingQ'];
        // echo $noOfPendingQ;
    ?>
        <div class="container">
            <div class="left-container" id="left-container">
                <div class="head">
                    <h1 id="hms-heading">HMS</h1>
                    <label for="bar-check"><i class="fa-solid fa-circle-left"></i></i></label>
                    <input type="checkbox" id="bar-check" hidden onclick="toggleSidebar()">
                </div>
                <hr style="border: 0;height:1px;background:white;"><br>
                <ul id="side-ul">
                    <li id="profile-btn" title="My Profile">
                        <i class="fa-solid fa-user"></i><span class="list-item">My&nbsp;Profile</span>
                    </li>
                    <li id="bookApnt-btn" title="Show Appoinments">
                        <i class="fa-solid fa-calendar-check"></i><span class="list-item">Appoinments</span>
                    </li>
                    <li id="apntHtry-btn" title="Manage Patient">
                        <i class="fa-solid fa-hospital-user"></i><span class="list-item">Manage&nbsp;Patient</span>
                    </li>
                    <li id="medical_htry-btn" title="Medical History">
                        <i class="fa-solid fa-bed-pulse"></i><span class="list-item">Patient&nbsp;Medical&nbsp;History</span>
                    </li>
                    <li id="query-btn" title="Patient Query">
                        <i class="fa-solid fa-comments"></i><span class="list-item">Patient&nbsp;Queries</span>
                    </li>
                    <li id="log-out-btn" title="LogOut">
                        <i class="fa-solid fa-right-from-bracket"></i><span class="list-item">Log&nbsp;Out</span>
                    </li>
                </ul>
            </div>

            <div class="right-container" id="right-container">
                <div class="rgt-cont" id="profile-div">
                    <h1>HMS | Doctor Profile</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;"><br>
                    <div class="doc-dp">
                        <img src="<?php echo $row['img_src'] ?>" alt="">
                        <button title="Edit-Profile-Picture" class="edit-dp"><i class="fa-solid fa-camera"></i></button>
                    </div>
                    <table border="1" cellspacing="0">
                        <tr>
                            <th>Name</th>
                            <td><?php echo $row['name'] ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $row['gender'] ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>
                                <?php
                                echo $conn->query("SELECT `name` FROM `spec_list` WHERE id=" . $row['spec_id'] . ";")->fetch_assoc()['name'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td><?php echo $row['experience'] ?></td>
                        </tr>
                        <tr>
                            <th>DOB</th>
                            <td><?php echo $row['dob'] ?></td>
                        </tr>
                        <tr>
                            <th>Qualification</th>
                            <td><?php echo $row['education'] ?></td>
                        </tr>
                        <tr>
                            <th>Licence InFo.</th>
                            <td><?php echo $row['license_info'] ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo $row['phone'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="email"><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $row['address'] ?></td>
                        </tr>
                    </table>
                    <div class="edit-btns">
                        <button title="Edit Profile" onclick="window.location.replace('doctorProfileEdit.php')"><i class="fa-solid fa-user-pen"></i></button>
                        <button title="Change Password" onclick="window.location.replace('doctorChangePassword.php')"><i class="fa-solid fa-key"></i></button>
                    </div>
                </div>

                <div class="rgt-cont" id="book-apnt">
                    <h1>HMS | Doctor Appointments</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;"><br>

                    <div>
                        <h3>Today's Appoinments :</h3>
                        <label for="">Choose Area:</label>
                        <select id="todayArea">
                            <option value="all">All</option>
                            <option value="yours" selected>Yours</option>
                        </select><br>
                        <div id="todayApntDataTable"></div>
                    </div>
                    <br>
                    <div>
                        <h3>Upcomming Appoinments :</h3>
                        <label for="">Choose Area:</label>
                        <select id="upCommingArea" class="area">
                            <option value="all">All</option>
                            <option value="yours" selected>Yours</option>
                        </select><br>
                        <div id="upcommingApntDataTable"></div>
                    </div>
                    <br>
                    <div>
                        <h3>Past Appoinment History :</h3>
                        <div>
                            <span>Search Particular Date:</span>
                            <input type="date" name="date" id="date" style="padding:2px 5px">
                        </div><br>
                        <?php
                        $result2 = $conn->query("SELECT * FROM `apnts` WHERE doct_id='" . $_SESSION['dId'] . "' AND date <= CURRENT_DATE() AND status!='active' ORDER BY date;");
                        if ($result2->num_rows > 0) {
                        ?>
                            <div id="apnt-hist-table">
                                <table border="1" cellspacing="0">
                                    <tr>
                                        <th>Sl no.</th>
                                        <th>Patient Name</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Staus</th>
                                    </tr>
                                    <?php
                                    $slNo = 1;
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $row3 = $conn->query("SELECT `name`, `phone` FROM `patient` WHERE id='" . $row2['patient_id'] . "'")->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $slNo ?></td>
                                            <td><?php echo $row3['name'] ?></td>
                                            <td><?php echo $row3['phone'] ?></td>
                                            <td><?php echo $row2['date'] ?></td>
                                            <td><?php echo $row2['time'] ?></td>
                                            <td><?php echo $row2['status'] ?></td>
                                        </tr>
                                    <?php
                                        $slNo += 1;
                                    }
                                    ?>
                                </table>
                            </div>
                        <?php
                        } else {
                            echo "<p style='color:gray'>NO APPOINMENTS AVAILABLE</p>";
                        }
                        ?>
                    </div>
                </div>

                <div class="rgt-cont" id="apnt-htry">
                    <h1>HMS | Manage Patient</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;">
                    <!-- <label for="manage-pt">Search Patient: </label><br> -->
                    <input type="search" id="manage-pt" placeholder="Patient:  Name / Phone">
                    <button class="add-pt" onclick="window.location.href='doctorAddPat.php'">Add New Patient <i class="fa-regular fa-address-card"></i></button>
                    <button class="add-pt" onclick="window.location.href='doctorBookAptPat.php'">Book Apnt for Patient <i class="fa-regular fa-calendar-check"></i></button>
                    <div>
                        <br>
                        <p style="color:gray">Search To See Patient Details here....</p>
                    </div>
                </div>

                <div class="rgt-cont" id="mdl-htry">
                    <h1>HMS | Patient Medical History</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;"><br>
                    <label for="search-pt">Search Patient: </label><br><input type="search" id="search-pt" placeholder="Name / Phone">
                    <div>

                    </div>
                </div>

                <div class="rgt-cont" id="queries">
                    <h1>HMS | Patient Medical History</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;"><br>
                    <div class="pendingQ" title="Pending to Answer" onclick="window.open('queryAnswer.php?d=<?php echo $_SESSION['dept_id'] ?>')">
                        <i class="fa-solid fa-bell"></i>
                        <span id="pending_q_no">-</span>
                    </div>
                    <div class="chat-hist">
                        <?php
                        while ($Q = $queries->fetch_assoc()) {
                        ?>
                            <div class="chat-card">
                                <div class="sender">
                                    <i class="fa-solid fa-user" title="Patient"></i>
                                    <p><?php echo $Q['query_text'] ?><br>
                                        <span>
                                            <?php echo $Q['posted_time'] ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="receiver">
                                    <i class="fa-solid fa-user-doctor" title="Doctor"></i>
                                    <p><?php echo $Q['query_response'] ?><br><span><?php echo $Q['answered_time'] ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="rgt-cont" id="log-out">
                    <h1>HMS | Doctor LogOut</h1><br>
                    <hr style="border: none;height:2px; background-color: gray;"><br>
                    <form method="post">
                        <h3>Are you sure to logout?</h3>
                        <button name="dt-logout">Logout</button>
                    </form>
                    <?php
                    if (isset($_POST['dt-logout'])) {
                        session_destroy();
                        echo "<script>alert('Logout Successfull.')</script>";
                        echo "<script>window.location.href='./index.php'</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
        if (isset($_POST['update-doc-dp'])) {
            $newFile = $_FILES['passPhoto'];
            // print_r($newFile);
            $img_src2 = "./../Images/DoctorPassphoto/" . $newFile['name'];
            if (file_exists($row['img_src'])) {
                unlink($row['img_src']);
            }
            if (move_uploaded_file($newFile['tmp_name'], $img_src2)) {
                $sql = "UPDATE `doctor` SET `img_src`='$img_src2' WHERE id='" . $_SESSION['dId'] . "';";
                if ($conn->query($sql)) {
                    echo "<script>alert('Profile Photo Updated Successfully.')</script>";
                    echo "<script>window.location.href = 'doctor.php';</script>";
                } else {
                    echo "<script>alert('Error in Updation !')</script>";
                }
            } else {
                echo "<script>alert('Error in Uploaded file')</script>";
            }
        }
    } else {
        echo "<script>Invalid User ! Login again</script>";
        echo "<script>window.location.href='./doctorLogin.php'</script>";
    }
    include './../footer.php';
    ?>

    <script src="./../JS/patient.js"></script>
    <script>
        var weekDay = new Date();
        $("#date").attr("max", weekDay.toISOString().substr(0, 10));
        const queries = <?php echo json_encode($queries) ?>;
        console.log(queries);

        $(document).ready(function() {
            $("#pending_q_no").text("<?php echo $noOfPendingQ ?>");

            function todayApntLoad() {
                var docId = <?php echo $_SESSION['dId'] ?>;
                $.ajax({
                    url: 'loadTodayApnts.php',
                    method: 'POST',
                    data: {
                        "docId": docId,
                        "prefer": $("#todayArea").val()
                    }
                }).done(function(data) {
                    $("#todayApntDataTable").html(data);
                });
            }
            todayApntLoad();
            $("#todayArea").change(function() {
                todayApntLoad();
            });

            function upcommingApntLoad() {
                $.ajax({
                    url: 'loadUpcommingApnts.php',
                    method: 'POST',
                    data: {
                        "doct_id": <?php echo $_SESSION['dId'] ?>,
                        "prefer": $("#upCommingArea").val()
                    }

                }).done(function(data) {
                    $("#upcommingApntDataTable").html(data);
                });
            }
            upcommingApntLoad();
            $("#upCommingArea").change(function() {
                upcommingApntLoad();
            });

            $("#date").change(function() {
                console.log($("#date").val());
                $.ajax({
                    method: 'POST',
                    url: 'loadApntOnDate.php',
                    data: "selectedDate=" + $("#date").val()
                }).done(function(data) {
                    $("#apnt-hist-table").html(data);
                });
            });

            $("#search-pt").keyup(function() {
                $.ajax({
                    method: 'POST',
                    url: 'loadMedicalHist.php',
                    data: "searchItem=" + $("#search-pt").val()
                }).done(function(data) {
                    $("#mdl-htry div").html(data);
                });
            });

            $("#manage-pt").keyup(function() {
                $.ajax({
                    method: 'POST',
                    url: 'loadPatProfile.php',
                    data: "searchItem=" + $("#manage-pt").val()
                }).done(function(data) {
                    $("#apnt-htry div").html(data);
                });
            });

            $("#query-btn").click(function() {
                // update the number of pending to answer query
            })

        });
        // Check Online
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('internetError.html');
        }
    </script>
</body>

</html>
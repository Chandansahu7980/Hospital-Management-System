<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Activity Page - HMS</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="./admin.css">
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    error_reporting(0);
    session_name('admin');
    session_start();
    if ($_SESSION['aId'] == '761107') {
        include './../DB/config.php';
    ?>
        <div class="frame">
            <div class="left-bar">
                <div class="name-card">
                    <div class="dp-img"></div>
                    <p>Chandan Kumar <br><span>Developer, Admin</span></p>
                </div>
                <ul>
                    <li id="dashboard-btn"><i class="fa-solid fa-chart-simple"></i>Dashboard</li>
                    <li id="department-btn"><i class="fa-solid fa-folder-tree"></i>Departments</li>
                    <li id="doctor-btn"><i class="fa-solid fa-user-doctor show-doc-list"></i>Doctor</li>
                    <li id="patient-btn"><i class="fa-solid fa-hospital-user"></i>Patient</li>
                    <li id="apnts-btn"><i class="fa-solid fa-calendar-check"></i>Appointments</li>
                    <li id="medi-hist-btn"><i class="fa-solid fa-file-medical"></i>Medical History</li>
                    <li id="queries"><i class="fa-solid fa-comments"></i>Patient Queries</li>
                    <li id="feedback-btn"><i class="fa-solid fa-comment"></i>Feedbacks</li>
                    <li id="logout-btn"><i class="fa-solid fa-right-from-bracket"></i>Log Out</li>
                </ul>
            </div>

            <div class="right-top-bar">
                <h2>Admin Panel <span id="cur-tab"></span><br><span id="cur-date"></span></h2>
                <div>
                    <p><span class="weak-day"></span>, <b><span class="date-time"></span></b></p>
                </div>
            </div>

            <div class="right-main">
                <!-- Dashboard Content  -->
                <div class="right-main-content dashboard">
                </div>

                <!-- Department content start -->
                <div class="right-main-content department">
                    <div class="add-new" onclick="window.location.href='addNewData.php?tb=dept'"><i class="fa-solid fa-plus"></i>
                        <p>Add New Department</p>
                    </div>
                    <div class="dept-tbl-detail"></div>
                </div>

                <!-- Doctor Content Start  -->
                <div class="right-main-content doctor">
                    <div class="add-new" onclick="window.location.href='addNewData.php?tb=doc'"><i class="fa-solid fa-plus"></i>
                        <p>Add New Doctor</p>
                    </div>
                    <div class="search-bar">
                        <input style="min-width: 220px;" type="search" id="search-item" placeholder="Name / Phone / Email / Licence">
                        <div>
                            <label for="spec">Department:</label>
                            <select name="dept" id="spec">
                                <option value="" selected>All</option>
                                <?php
                                $depts = $conn->query("SELECT `id`, `name` FROM `spec_list`");
                                while ($dept = $depts->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="adminPass">Admin Pass:</label>
                            <select name="adminPass" id="adminPass">
                                <option value="" selected>All</option>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                        <button type="button"><i class="fa-solid fa-rotate"></i></button>
                    </div>
                    <div class="doc-tbl-detail"></div>
                </div>

                <!-- Patient Content Start  -->
                <div class="right-main-content patient">
                    <div class="add-new" onclick="window.location.href='addNewData.php?tb=pat'"><i class="fa-solid fa-plus"></i>
                        <p>Add New Patient</p>
                    </div>
                    <div class="search-bar">
                        <input type="search" id="search-term" placeholder="Name / Phone / Email">
                        <input type="search" name="disease" id="disease" placeholder="Disease">
                        <div>
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="" selected>All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label for="treatSts">Treatment:</label>
                            <select name="treatSts" id="treatSts">
                                <option value="">All</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <button type="button"><i class="fa-solid fa-rotate"></i></button>
                    </div>
                    <div class="pat-tbl-detail"></div>
                </div>

                <!-- Appointments Content Start  -->
                <div class="right-main-content apnts">
                    <div class="add-new" onclick="window.location.href='addNewData.php?tb=apnt'"><i class="fa-solid fa-plus"></i>
                        <p>Book New Apnt</p>
                    </div>
                    <div class="search-bar">
                        <input type="search" id="searchTerm" placeholder="Patient / Doctor name">
                        <div>
                            <label for="dept">Department:</label>
                            <select name="dept" id="dept">
                                <option value="" selected>All</option>
                                <?php
                                $depts = $conn->query("SELECT `id`, `name` FROM `spec_list`");
                                while ($dept = $depts->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            Form:<input type="date" id="formDate">
                            To:<input type="date" id="toDate">
                        </div>
                        <div>
                            <label for="sts">Status:</label>
                            <select name="sts" id="sts">
                                <option value="">All</option>
                                <option value="active">Active</option>
                                <option value="attended">Attended</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                        <div>
                            <label for="apnt-type">Apnt. Type:</label>
                            <select name="apnt-type" id="apnt-type">
                                <option value="">All</option>
                                <option value="followup">FollowUp</option>
                                <option value="specific">Specific</option>
                            </select>
                        </div>
                        <button><i class="fa-solid fa-rotate"></i></button>
                    </div>
                    <div class="apnt-tbl-detail"></div>
                </div>

                <!-- Medical History Content Start  -->
                <div class="right-main-content medi-hist">
                    <div class="search-bar">
                        <input type="search" id="searchTerm" placeholder="Patient / Doctor name">
                        <div>
                            <label for="dept">Department:</label>
                            <select id="dept">
                                <option value="" selected>All</option>
                                <?php
                                $depts = $conn->query("SELECT `id`, `name` FROM `spec_list`");
                                while ($dept = $depts->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            Date: <input type="date" id="date">
                        </div>
                        <button><i class="fa-solid fa-rotate"></i></button>
                    </div>
                    <div class="medi-hist-tbl-detail"></div>
                </div>

                <!-- Patient Queries -->
                <div class="right-main-content pat_queries">
                        <div class="pat_queries_table"></div>
                </div>

                <div class="right-main-content feedback">
                    <div class="feedback-tbl-detail"></div>
                </div>

                <div class="right-main-content logout">
                    <form action="" method="post">
                        <label for="">Are you sure to logout?</label><br>
                        <button type="submit" class="logout-btn" name="admin-logout">LogOut</button>
                    </form>
                    <?php
                    if (isset($_POST['admin-logout'])) {
                        session_destroy();
                        echo "<script>window.location.href='./../index.php'</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo "Currepted Access ! <a href='./adminLogin.php'>Relogin</a> ";
    }
    ?>
    <script src="./admin.js"></script>
    <!-- Check Online -->
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./../internetError.html');
        }
    </script>

</body>

</html>
<?php
include './../DB/config.php';
error_reporting(0);

function Check0Data($n)
{
    if (is_null($n))
        return 0;
    else
        return $n;
}

$docPassList = $conn->query("SELECT doctor.id, doctor.name , spec_list.name AS specName, doctor.img_src FROM `doctor` AS doctor JOIN `spec_list` AS spec_list ON doctor.spec_id=spec_list.id WHERE doctor.adminPass='fail' ORDER BY doctor.creation_date DESC;")->fetch_all();
$jsondocPassList = json_encode($docPassList);

?>

<head>
    <link rel="stylesheet" href="./dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<div class="doc-card-container">
    <i title="Previous Doctor" id="doc-1" class="fa-solid fa-circle-chevron-left"></i>
    <div class="doc-card">
        <img src="./../Images/DoctorPassphoto/defaultDocDp.jpg">
        <div class="doc-name"> Doctor Name</div>
        <span onclick="window.location.href='docPass.php?dId='">Authorize</span>
    </div>
    <i id="doc_1" title="Next Doctor" class="fa-solid fa-circle-chevron-right"></i>
    <span onclick="window.location.href='docPass.php'">Show All <i class="fa-solid fa-up-right-from-square"></i></span>
</div>

<div class="dashboard-container">
    <div class="dashboard-1">
        <?php
        $totalPatient = $conn->query("SELECT COUNT(*) as no_of_pat FROM `patient`;")->fetch_assoc()['no_of_pat']; // Total Patients
        $totalPatientClosed = $conn->query("SELECT COUNT(*) as no_of_pat FROM `patient` WHERE treatment_status='closed';")->fetch_assoc()['no_of_pat']; //Total Patients Treatmented
        ?>
        <div class="card">
            <p>Total Patients</p>
            <p><?php echo $totalPatient; ?></p>
        </div>
        <div class="dashboard-11">
            <p>Treatment Status</p>
            <div class="right-cards">
                <div class="card">
                    <p>Treatment Ongoing</p>
                    <p><?php echo $totalPatient - $totalPatientClosed; ?> <span>(&nbsp;<?php echo round((($totalPatient - $totalPatientClosed) / $totalPatient) * 100, 2) ?>%&nbsp;)</span></p>
                </div>
                <div class="card">
                    <p>Recovery Patients</p>
                    <p><?php echo $totalPatientClosed; ?><span>(&nbsp;<?php echo round(($totalPatientClosed / $totalPatient) * 100, 2) ?>%&nbsp;)</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-2">
        <h2>Number of Doctors</h2>
        <?php
        $dashboard2table = $conn->query("SELECT spec_list.name as dept_name, COUNT(doctor.id) AS doc_count FROM spec_list JOIN doctor WHERE spec_list.id=doctor.spec_id GROUP BY spec_list.id;")->fetch_all();
        $docInDeptjson = json_encode($dashboard2table);
        ?>
        <canvas id="docInDept" height="100vh"></canvas>
    </div>

    <div class="dashboard-3">
        <h2>Busiest Department</h2>
        <?php
        $dashboard3table = $conn->query("SELECT spec_list.name, COUNT(apnts.id) FROM spec_list JOIN apnts ON apnts.spec_id=spec_list.id WHERE apnts.date = CURRENT_DATE AND CURRENT_DATE GROUP BY spec_list.name;")->fetch_all();
        $busyDeptData = json_encode($dashboard3table);
        ?>
        <select id="busy-area">
            <option value="today" selected>Today</option>
            <option value="7">Last 7 days</option>
            <option value="30">Last 30 days</option>
            <option value="all">All</option>
        </select>
        <div class="graph3area"></div>
        <canvas id="busyDept"></canvas>
    </div>

    <div class="dashboard-4">
        <h2>Doctor Performance</h2>
        <form method="post">
            <select id="deptId" name="deptId">
                <?php
                $spec_lists = $conn->query("SELECT id, name FROM `spec_list`");
                while ($spec = $spec_lists->fetch_assoc()) {
                ?>
                    <option value="<?php echo $spec['id'] ?>"><?php echo $spec['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </form>
        <canvas id="docPerformance"></canvas>
    </div>

    <div class="dashboard-5">
        <button id="setExpire">Update <i title="Expired Appointments" class="fa-solid fa-calendar-xmark"></i></button>
        <h2>Appoinment Categories</h2>
        <form action="" method="post">
            <select name="" id="timing-gap">
                <option value="total" selected>Total</option>
                <option value="week">Week</option>
                <option value="day">Day</option>
            </select>
        </form>
        <span></span>
        <canvas id="apnt-distribution"></canvas>
    </div>

    <div class="dashboard-6">
        <h2>Regular checkup VS Specific concern</h2>
        <canvas id="apnt-Type-compaer"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    let month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
    ];
    var myarrayX = [];
    var myarrayY = [];
    var dashBoard3chart;
    var dashBoard4chart;
    var dashboard5chart;
    var dashboard6chart;

    function docInDeptJS() {
        var myJson = <?php echo $docInDeptjson ?>;
        console.log(myJson);
        myJson.forEach(element => {
            myarrayX.push(element[0]);
            myarrayY.push(element[1]);
        });
        new Chart($('#docInDept'), {
            type: "bar",
            data: {
                labels: myarrayX,
                datasets: [{
                    label: "Number Of Doctos",
                    data: myarrayY,
                    barThickness: 70
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
    docInDeptJS();

    // ************************************** //
    function busyDeptFun(mYJson) {
        // Destory existing graph before updating it
        if (dashBoard3chart) {
            console.log("destroy graph");
            dashBoard3chart.destroy();
        }
        myarrayX = [];
        myarrayY = [];
        mYJson.forEach(element => {
            myarrayX.push(element[0]);
            myarrayY.push(element[1]);
        });

        if (myarrayX.length == 0) {
            $(".graph3area").html("<h1 style='color:gray'>No Data Found</h1>");
            return;
        } else {
            $(".graph3area").html('');
        }

        dashBoard3chart = new Chart($('#busyDept'), {
            type: 'pie',
            data: {
                labels: myarrayX,
                datasets: [{
                    data: myarrayY,
                    label: "Number of Appointments"
                }]
            }
        });
    }
    var busyDeptJson = <?php echo $busyDeptData ?>;
    busyDeptFun(busyDeptJson);
    $("#busy-area").change(function() {

        if ($("#busy-area").val() == 'today') {
            console.log("chagnes to today");
            busyDeptFun(busyDeptJson);
        }
        if ($("#busy-area").val() == 'all') {
            console.log("fun called due to change to all");
            <?php
            $dashboard3table4 = $conn->query("SELECT spec_list.name, COUNT(apnts.id) FROM spec_list JOIN apnts ON apnts.spec_id=spec_list.id GROUP BY spec_list.name;")->fetch_all();
            $busyDeptData4 = json_encode($dashboard3table4);
            ?>
            var busyDeptJson4 = <?php echo $busyDeptData4 ?>;
            busyDeptFun(busyDeptJson4);
        }
        if ($("#busy-area").val() == 7) {
            console.log("fun called, chagne to 7");
            <?php
            $dashboard3table2 = $conn->query("SELECT spec_list.name, COUNT(apnts.id) FROM spec_list JOIN apnts ON apnts.spec_id=spec_list.id WHERE apnts.date BETWEEN (CURRENT_DATE-INTERVAL 7 DAY) AND CURRENT_DATE GROUP BY spec_list.name;")->fetch_all();
            $busyDeptData2 = json_encode($dashboard3table2);
            ?>
            var busyDeptJson2 = <?php echo $busyDeptData2 ?>;
            busyDeptFun(busyDeptJson2);
        }
        if ($("#busy-area").val() == 30) {
            console.log("function called, change to 30");
            <?php
            $dashboard3table3 = $conn->query("SELECT spec_list.name, COUNT(apnts.id) FROM spec_list JOIN apnts ON apnts.spec_id=spec_list.id WHERE apnts.date BETWEEN (CURRENT_DATE-INTERVAL 30 DAY) AND CURRENT_DATE GROUP BY spec_list.name;")->fetch_all();
            $busyDeptData3 = json_encode($dashboard3table3);
            ?>
            var busyDeptJson3 = <?php echo $busyDeptData3 ?>;
            busyDeptFun(busyDeptJson3);
        }
    });

    // *************************************** //
    function docPerformance(data) {
        var dataArr = JSON.parse(data);
        myarrayX = [];
        myarrayY = [];
        dataArr.forEach(element => {
            myarrayX.push(element[0]);
            myarrayY.push(element[1]);
        });
        // Destory existing graph before updating it
        if (dashBoard4chart) {
            // console.log("destroy graph");
            dashBoard4chart.destroy();
        }
        dashBoard4chart = new Chart($("#docPerformance"), {
            type: 'bar',
            data: {
                labels: myarrayX,
                datasets: [{
                    data: myarrayY,
                    label: "Performed Appoinments",
                    barThickness: 70
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    function docPerformanceGetData(a) {
        $.ajax({
            url: 'updateDashboard4.php',
            method: 'POST',
            data: {
                "i": a
            }
        }).done(function(data) {
            docPerformance(data);
        });

    }
    var deptId = $("#deptId").val();
    docPerformanceGetData(deptId);
    $("#deptId").change(function() {
        deptId = $("#deptId").val();
        docPerformanceGetData(deptId);
    });

    // *************************************** //

    $("#timing-gap").change(function() {
        switch ($("#timing-gap").val()) {
            case 'total':
                dashboard5graphTotal();
                break;
            case 'week':
                dashboard5graphWeek();
                break;
            case 'day':
                dashboard5graphDay();
                break;
        }
    });

    function getLast7DayArr() {
        var arrayDays = [];
        var today = new Date();
        var tempDate = new Date();

        for (let index = 0; index < 7; index++) {
            tempDate.setDate(today.getDate() - index);
            var tempElement = tempDate.getDate() + "-" + month[tempDate.getMonth()];
            arrayDays.push(tempElement);
        }
        // console.log(arrayDays.reverse());
        return arrayDays.reverse();
    }

    function dashboard5graphDay() {
        $(".dashboard-5 span").html("");
        <?php
        // attended
        $thisDay = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND date = CURDATE();")->fetch_assoc()['num'];
        $day2 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 1 DAY;")->fetch_assoc()['num'];
        $day3 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 2 DAY;")->fetch_assoc()['num'];
        $day4 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 3 DAY;")->fetch_assoc()['num'];
        $day5 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 4 DAY;")->fetch_assoc()['num'];
        $day6 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 5 DAY;")->fetch_assoc()['num'];
        $day7 = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'attended' AND  date = CURDATE() - INTERVAL 6 DAY;")->fetch_assoc()['num'];

        // Cancelled
        $thisDayC = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND date = CURDATE();")->fetch_assoc()['num'];
        $day2C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 1 DAY;")->fetch_assoc()['num'];
        $day3C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 2 DAY;")->fetch_assoc()['num'];
        $day4C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 3 DAY;")->fetch_assoc()['num'];
        $day5C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 4 DAY;")->fetch_assoc()['num'];
        $day6C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 5 DAY;")->fetch_assoc()['num'];
        $day7C = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'cancelled' AND  date = CURDATE() - INTERVAL 6 DAY;")->fetch_assoc()['num'];

        // Expired
        $thisDayE = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND date = CURDATE();")->fetch_assoc()['num'];
        $day2E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 1 DAY;")->fetch_assoc()['num'];
        $day3E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 2 DAY;")->fetch_assoc()['num'];
        $day4E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 3 DAY;")->fetch_assoc()['num'];
        $day5E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 4 DAY;")->fetch_assoc()['num'];
        $day6E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 5 DAY;")->fetch_assoc()['num'];
        $day7E = $conn->query("SELECT COUNT(*) AS num FROM apnts WHERE status = 'expired' AND  date = CURDATE() - INTERVAL 6 DAY;")->fetch_assoc()['num'];
        ?>

        if (dashboard5chart) {
            dashboard5chart.destroy();
        }

        var mydataJson = <?php echo json_encode(array($day7, $day6, $day5, $day4, $day3, $day2, $thisDay)); ?>;
        var mydataJsonC = <?php echo json_encode(array($day7C, $day6C, $day5C, $day4C, $day3C, $day2C, $thisDayC)); ?>;
        var mydataJsonE = <?php echo json_encode(array($day7E, $day6E, $day5E, $day4E, $day3E, $day2E, $thisDayE)); ?>;


        dashboard5chart = new Chart($("#apnt-distribution"), {
            type: 'line',
            data: {
                labels: getLast7DayArr(),
                datasets: [{
                    data: mydataJson,
                    label: "Attended",
                }, {
                    data: mydataJsonC,
                    label: "Cancelled"
                }, {
                    data: mydataJsonE,
                    label: "Expired"
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        })
    }

    function dashboard5graphWeek() {
        $(".dashboard-5 span").html("");
        <?php
        $thisWeek = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='attended' AND (date >= CURDATE() - INTERVAL 1 WEEK)")->fetch_assoc()['num'];
        $week2 = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='attended' AND (date >= CURDATE() - INTERVAL 2 WEEK)")->fetch_assoc()['num'];
        $week3 = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='attended' AND (date >= CURDATE() - INTERVAL 3 WEEK)")->fetch_assoc()['num'];
        $week4 = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='attended' AND (date >= CURDATE() - INTERVAL 4 WEEK)")->fetch_assoc()['num'];

        // Cancelled
        $thisWeekC = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='cancelled' AND (date >= CURDATE() - INTERVAL 1 WEEK)")->fetch_assoc()['num'];
        $week2C = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='cancelled' AND (date >= CURDATE() - INTERVAL 2 WEEK)")->fetch_assoc()['num'];
        $week3C = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='cancelled' AND (date >= CURDATE() - INTERVAL 3 WEEK)")->fetch_assoc()['num'];
        $week4C = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='cancelled' AND (date >= CURDATE() - INTERVAL 4 WEEK)")->fetch_assoc()['num'];

        // Expired
        $thisWeekE = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='expired' AND (date >= CURDATE() - INTERVAL 1 WEEK)")->fetch_assoc()['num'];
        $week2E = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='expired' AND (date >= CURDATE() - INTERVAL 2 WEEK)")->fetch_assoc()['num'];
        $week3E = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='expired' AND (date >= CURDATE() - INTERVAL 3 WEEK)")->fetch_assoc()['num'];
        $week4E = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='expired' AND (date >= CURDATE() - INTERVAL 4 WEEK)")->fetch_assoc()['num'];
        ?>

        if (dashboard5chart) {
            dashboard5chart.destroy();
        }

        var mydataJson = <?php echo json_encode(array($week4, $week3, $week2, $thisWeek)); ?>;
        // console.log(mydataJson);
        var mydataJsonC = <?php echo json_encode(array($week4C, $week3C, $week2C, $thisWeekC)); ?>;
        var mydataJsonE = <?php echo json_encode(array($week4E, $week3E, $week2E, $thisWeekE)); ?>;
        dashboard5chart = new Chart($("#apnt-distribution"), {
            type: 'line',
            data: {
                labels: ["Last 4 Week", "Last 3 Week", "Last 2 Week", "This Week"],
                datasets: [{
                    data: mydataJson,
                    label: "Attended",
                }, {
                    data: mydataJsonC,
                    label: "Cancelled"
                }, {
                    data: mydataJsonE,
                    label: "Expired"
                }]
            },
        })
    }

    function dashboard5graphTotal() {
        $(".dashboard-5 span").html("");
        <?php
        $attendedApnt[0] = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='attended'")->fetch_assoc()['num'];
        $cancelled[0] = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='cancelled'")->fetch_assoc()['num'];
        $expired[0] = $conn->query("SELECT COUNT(*) as num FROM apnts WHERE status='expired'")->fetch_assoc()['num'];
        ?>
        if (dashboard5chart) {
            dashboard5chart.destroy();
        }
        dashboard5chart = new Chart($("#apnt-distribution"), {
            type: 'bar',
            data: {
                labels: ["Total"],
                datasets: [{
                    data: <?php echo json_encode($attendedApnt) ?>,
                    label: "Attended",
                }, {
                    data: <?php echo json_encode($cancelled) ?>,
                    label: "Cancelled"
                }, {
                    data: <?php echo json_encode($expired) ?>,
                    label: "Expired"
                }]
            },
        })
    }
    dashboard5graphTotal();

    // *************************************** //

    function dashboard6graph() {
        <?php
        $total = $conn->query("SELECT apnt_type,COUNT(id) FROM `apnts` WHERE apnt_type!='' GROUP BY apnt_type;")->fetch_all();
        $today = $conn->query("SELECT apnt_type,COUNT(id) FROM `apnts` WHERE apnt_type!='' AND date=CURRENT_DATE GROUP BY apnt_type;")->fetch_all();
        $week = $conn->query("SELECT apnt_type,COUNT(id) FROM `apnts` WHERE apnt_type!='' AND date>=CURRENT_DATE - INTERVAL 1 WEEK GROUP BY apnt_type;")->fetch_all();
        $month = $conn->query("SELECT apnt_type,COUNT(id) FROM `apnts` WHERE apnt_type!='' AND date>=CURRENT_DATE - INTERVAL 1 MONTH GROUP BY apnt_type;")->fetch_all();

        $followup = [Check0Data($total[0][1]), Check0Data($month[0][1]), Check0Data($week[0][1]), Check0Data($today[0][1])];
        $specific = [Check0Data($total[1][1]), Check0Data($month[1][1]), Check0Data($week[1][1]), Check0Data($today[1][1])];
        ?>
        dashboard6chart = new Chart($("#apnt-Type-compaer"), {
            type: 'bar',
            data: {
                labels: ['Total', 'Last Month', 'Last Week', 'Today'],
                datasets: [{
                    label: "Follow Up",
                    data: <?php echo json_encode($followup) ?>
                }, {
                    label: "Specific",
                    data: <?php echo json_encode($specific) ?>
                }]
            }
        })
    }
    dashboard6graph();

    $("#setExpire").click(function() {
        var mydate = new Date();
        if (mydate.getHours() > 20) {
            // alert("greater than 20");
            $.ajax({
                url: 'setExpiredStsApnts.php'
            }).done(function(data) {
                console.log(data);
                $("body").append(data);
            });
        } else {
            alert("Please Run This JoB After 8PM only.");
        }
    })
</script>

<script>
    const docPassList = <?php echo $jsondocPassList ?>;
    console.log(docPassList.length);
    console.log(docPassList);
    var i = 0;

    function UpdateDocCard(instance) {
        $(".doc-card img").attr("src", "./." + docPassList[instance][3]);
        $(".doc-card .doc-name").html(docPassList[instance][2] + " / " + docPassList[instance][1]);
        $(".doc-card span").click(function() {
            window.location.href = 'docPass.php?dId=' + docPassList[instance][0];
        });
    }
    UpdateDocCard(0);

    $("#doc-1").click(function() {
        ++i;
        var ra = docPassList.length - i;
        console.log(ra);
        UpdateDocCard(ra);
        if (ra == 0) {
            i = 0;
        }
    });
    $("#doc_1").click(function() {
        // alert("next clicked");
        i++;
        if (i == docPassList.length) {
            i = 0;
        }
        console.log(i);
        UpdateDocCard(i);
    });
</script>
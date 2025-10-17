<?php
session_name("doctor_session");
session_start();
// echo "helllo";
// echo $_GET['d'];
include './config.php';
$quries = $conn->query("SELECT queries.id, queries.query_text, queries.posted_time, patient.name, patient.phone,patient.email, queries.intended_dept_id FROM queries JOIN patient ON queries.pat_id=patient.id WHERE (queries.intended_dept_id=" . $_GET['d'] . " OR queries.intended_dept_id='') AND queries.status='pending' ORDER BY patient.email;")->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer Patient Query - HMS</title>
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            border: 0;
            outline: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
            overflow-y: scroll;
            gap: 1em;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .left,
        .right {
            background-color: lightblue;
            padding: 2em;
            text-align: center;
            cursor: pointer;
        }

        .left i,
        .right i {
            font-size: 2em;
        }

        .middle {
            background-color: aliceblue;
            width: 91%;
            padding: 2em;
            border-radius: 1em;
            box-shadow: 5px 5px 8px 3px gray,
                6px 6px 1px 1px skyblue;
        }

        .middle .header {
            background-color: rgba(119, 136, 153, 0.63);
            color: white;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0.5em 1em;
            border-radius: 1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .query_detail i {
            margin-right: 1em;
        }

        .query_detail form {
            display: flex;
            flex-direction: column;
        }

        .query_detail textarea {
            padding: 0.5em;
            border-radius: 0.6em;
            box-shadow: 2px 2px 5px 2px gray;
            margin-bottom: 1em;
            height: 30vh;
        }

        .query_detail form:last-child button {
            background-color: lightblue;
            padding: 0.5em;
            font-weight: bold;
        }

        .query_detail form:last-child button:hover {
            background-color: lightgreen;
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .query_detail form:first-child {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
        }

        .query_detail form:first-child select {
            width: max-content;
            float: right;
            margin: 0.5em;
            padding: 0.5em 1em;
            border: 1px solid gray;
            border-radius: 0.3em;
        }

        .query_detail form:first-child button {
            width: fit-content;
            float: right;
            cursor: pointer;
            padding: 0.5em;
        }

        .query_detail form:first-child button:hover {
            border: 1px solid gray;
            border-radius: 0.3em;
        }
    </style>
</head>

<body>
    <span onclick="window.close()" style="color:red;font-size:larger;position:absolute;right:1em;cursor:pointer"><i class="fa-solid fa-rectangle-xmark fa-fade" style="color: #d10000;"></i></span>

    <div class="container">
        <div class="left" onclick="goPrev()">
            <i class="fa-solid fa-circle-left"></i>
        </div>
        <div class="middle">
            <div class="header">
                <div class="">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <span title="Patient Name" id="p_name"></span>
                </div>
                <span title="Patient Phone" id="p_phone"></span>
                <span title="Patient Email" id="p_email"></span>
            </div>
            <div class="query_detail">
                <form action="" method="post">
                    <input type="number" name="qId" id="qId" hidden required>
                    Department: <select name="dept" id="dept">
                        <option value="0" selected>Select</option>
                        <?php
                        $depts = $conn->query("SELECT * FROM `spec_list`");
                        while ($dept = $depts->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $dept['id'] ?>" <?php if ($dept['id'] == $_GET['d']) echo "selected" ?>><?php echo $dept['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button name="updateDept">Update</button>
                </form>
                <?php
                if (isset($_POST['updateDept'])) {
                    // echo $_POST['qId'] . $_POST['dept'] . " clicked";
                    if ($conn->query("UPDATE `queries` SET `intended_dept_id`='" . $_POST['dept'] . "' WHERE id=" . $_POST['qId'])) {
                        echo "<script>alert('Query Department Updated;');location.replace(window.location.href);</script>";
                    }
                }
                ?>
                <span style="font-size: 0.5em;color:gray;">/* If the questin is not intended to your department please help to get the correct one. */</span>
                <p title="Patient Query"><i class="fa-solid fa-circle-question"></i><span id="p_query"></span>
                    <br>Date posted: <i><span id="posted_on"></span></i>
                </p>
                <form action="" method="post">
                    <input type="text" name="qId" id="qId" hidden required>
                    <textarea name="qAns" placeholder="Write Answer here...." required></textarea>
                    <button name="saveResponse">Save</button>
                </form>
                <?php
                if (isset($_POST['saveResponse'])) {
                    // echo $_POST['qId'].$_POST['qAns'];
                    if ($conn->query("UPDATE `queries` SET `doc_id`='" . $_SESSION['dId'] . "',`query_response`='" . $_POST['qAns'] . "',`answered_time`=CURRENT_TIMESTAMP,`status`='answered' WHERE id=" . $_POST['qId'])) {
                        echo "<script>alert('Response Saved.')</script>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="right" onclick="goNext()">
            <i class="fa-solid fa-circle-right"></i>
        </div>
    </div>

    <script>
        const queries = <?php echo json_encode($quries) ?>;
        console.log(queries);
        var i = 0;
        updateDetail(queries[0]);

        function updateDetail(i) {
            $("#qId").val(i[0]);
            $("#p_name").text(i[3]);
            $("#p_phone").text(i[4]);
            $("#p_email").text(i[5]);
            $("#p_query").text(i[1]);
            $("#posted_on").text(i[2]);
            $("#dept").val(i[6]);
        }

        function goPrev() {
            i--;
            if (i < 0) {
                i = queries.length - 1;
            }
            updateDetail(queries[i]);
        }

        function goNext() {
            i++;
            if (i == queries.length) {
                i = 0;
            }
            updateDetail(queries[i]);
        }
    </script>
</body>

</html>
<?php
error_reporting(0);
session_name('admin');
session_start();
include './../DB/config.php';
$result = $conn->query("SELECT * FROM `doctor` WHERE adminPass='fail' ORDER BY creation_date DESC;");

?>

<head>
    <title>Admin: Doctor Authorization - HMS</title>
    <link rel="stylesheet" href="docPass.css">
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <span onclick="window.location.href='admin.php'" class="cancel"><a href=""><i class="fa-solid fa-left-long"></i></a>&nbsp; Back</span>
    <h2>Doctor Authorization - HMS</h2>
    <hr>
    <div class="page">
        <div class="item1">
            <div class="container">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="doc-card">
                        <div class="doc-contact">
                            <img src="./.<?php echo $row['img_src'] ?> " alt="">
                            <div>
                                <p><i onclick="window.open('https://wa.me/+91<?php echo $row['phone'] ?>')" title="WhatsApp" class="fa-brands fa-square-whatsapp" style="color: #009e28;"></i> <?php echo $row['phone'] ?> <br><i title="Email" onclick="window.open('mailto:<?php echo $row['email'] ?>')" class="fa-solid fa-envelope" style="color: #004bcc;"></i> <?php echo $row['email'] ?><br><i title="Address" class="fa-solid fa-location-dot" style="color: #0527ad;"></i> <?php echo $row['address'] ?></p>
                            </div>
                        </div>
                        <div class="actions">
                            <button onclick="window.location.replace('docPass.php?dId=<?php echo $row['id'] ?>')">Authorize</button>
                            <i onclick="confirmRedir(<?php echo $row['id'] ?>)" class="fa-solid fa-trash" style="color: #eb0000;"></i>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="item2">
            <?php
            if ($_GET['dId']) {
                $doc = $conn->query("SELECT * FROM `doctor` WHERE id=" . $_GET['dId'])->fetch_assoc();
            ?>
                <div class="doc-details">
                    <img src="./.<?php echo $doc['img_src'] ?>">
                    <p><b><?php echo $doc['name'] ?></b><br><i onclick="window.open('https://wa.me/+91<?php echo $doc['phone'] ?>')" title="WhatsApp" class="fa-brands fa-square-whatsapp" style="color: #009e28;"></i> <?php echo $doc['phone'] ?> <br><i title="Email" onclick="window.open('mailto:<?php echo $doc['email'] ?>')" class="fa-solid fa-envelope" style="color: #004bcc;"></i> <?php echo $doc['email'] ?><br><i title="Address" class="fa-solid fa-location-dot" style="color: #0527ad;"></i> <?php echo $doc['address'] ?></p>
                </div>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th>Department</th>
                            <td>
                                <select name="spec_id" required>
                                    <?php
                                    $result = $conn->query("SELECT * FROM `spec_list`;");
                                    while ($dept = $result->fetch_assoc()) {
                                    ?>
                                        <option <?php if ($dept['id'] == $doc['spec_id']) echo "selected" ?> value="<?php echo $dept['id'] ?>"><?php echo $dept['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Education</th>
                            <td><input type="text" name="edu" value="<?php echo $doc['education'] ?>" required></td>
                        </tr>
                        <tr>
                            <th>License Info.</th>
                            <td><input type="text" name="license" value="<?php echo $doc['license_info'] ?>" required></td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td><input type="number" name="exeperience" value="<?php echo $doc['experience'] ?>" required></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2"><button name="doc-authorize">Authorize</button></td>
                        </tr>
                    </table>
                </form>
            <?php
                if ($_SESSION['aId'] && isset($_POST['doc-authorize'])) {
                    if ($conn->query("UPDATE `doctor` SET `education`='" . $_POST['edu'] . "',`spec_id`='" . $_POST['spec_id'] . "',`license_info`='" . $_POST['license'] . "',`experience`='" . $_POST['exeperience'] . "',`updation_date`=CURRENT_TIMESTAMP,`adminPass`='pass' WHERE id=" . $_GET['dId'])) {
                        echo "<script>alert('Doctor has been Authorized;');window.location.replace('docPass.php')</script>";
                    } else {
                        echo "Updation Error in DB";
                    }
                }
            } else {
                echo "Click Authorize to see details here...";
            }
            ?>
        </div>
    </div>

    <script>
        function confirmRedir(i) {
            var tom = confirm("Are You Sure To Delete This Profile ?");
            if (tom) {
                window.location.href = 'adminDeleteData.php?tb=doctor&id=' + i;
            }
        }
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./../internetError.html');
        }
    </script>
</body>
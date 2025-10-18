<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS - Home page</title>
    <link rel="stylesheet" href="./CSS/Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./Images/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="heading">
        <div class="logo">
            <h1>HMS</h1>
        </div>
        <div class="nav-list">
            <ul>
                <li>Home</li>
                <li>Service</li>
                <li>Gallery</li>
                <li>About us</li>
                <li>Contact us</li>
            </ul>
        </div>
        <div class="appoinment-btn">
            <button onclick="window.location.href='./Patient/patient.php'">Book Appoinment</button>
        </div>
    </div>
    <hr style="height: 2px;border:0">

    <div class="slider">
        <div class="img-wraper" id="img-wraper">
            <h1>Hospital <br>Management <br>System...</h1>
            <div class="imgOverflowDesign"></div>
        </div>

        <div class="slider-btn">
            <button id="next-slider">></button>
        </div>
    </div>

    <div class="allLogins">
        <h1>Logins</h1>
        <div class="logincards">
            <div class="card card1">
                <button onclick="window.location.href='./Patient/patientLogin.php'">Patient Login</button>
            </div>
            <div class="card card2">
                <button onclick="window.location.href='./Doctor/doctorLogin.php'">Doctor Login</button>
            </div>
            <div class="card card3">
                <button onclick="window.location.href='./admin/adminLogin.php'">Admin Login</button>
            </div>
        </div>
    </div>

    <div class="feature-container">
        <div class="headLine">
            <h1>Key Features</h1>
            <p>Take a look at some of our key features</p>
        </div>
        <div class="features-cards">
            <div class="features">
                <i class="fa-solid fa-heart-pulse"></i>
                <p>Cardiology</p>
            </div>
            <div class="features">
                <i class="fa-solid fa-skull"></i>
                <p>Orthopaedic</p>
            </div>
            <div class="features">
                <i class="fa-brands fa-creative-commons-sampling"></i>
                <p>Neurologist</p>
            </div>
            <div class="features">
                <i class="fa-solid fa-house-medical"></i>
                <p>Farma Team</p>
            </div>
            <div class="features">
                <i class="fa-solid fa-thumbs-up"></i>
                <p>High Quality Treatment</p>
            </div>
            <div class="features">
                <i class="fa-solid fa-tablets"></i>
                <p>Farma Pipeline</p>
            </div>
        </div>
    </div>

    <div class="about-hs">
        <img src="./Images/aboutHS.jpg" alt="">
        <p>Our commitment is to provide world-class medical services to our community, ensuring the well-being and health of every individual we serve. <br> We believe in delivering patient-centered care that goes beyond the ordinary. Our state-of-the-art facilities are equipped with cutting-edge technology and staffed by a dedicated team of healthcare professionals who are passionate about making a positive impact on the lives of our patients. <br>
            <b>Mission Statement:</b> <br>
            "To enhance the health and well-being of our community by providing accessible, compassionate, and quality healthcare services. We are dedicated to fostering a culture of excellence, innovation, and continuous improvement in our pursuit of delivering exceptional patient care. <br> For more information please contact us. We look forward to serving you and your loved ones with the highest standards of care.
        </p>
    </div>

    <div class="gallery-wraper">
        <h1>Our Gallery</h1>
        <div class="gallery-btn-types">
            <button id="all-btn">All</button>
            <button id="dental">Dental</button>
            <button id="cardio">Cardiology</button>
            <button id="neuro">Neurology</button>
            <button id="lab-btn">Laboratry</button>
        </div>
        <div class="imgs-container" id="all-imgs">
            <img src="./Images/laboratry/lab4.jpeg">
            <img src="./Images/dental/dental2.jpeg">
            <img src="./Images/neurology/neuro3.jpeg">
            <img src="./Images/neurology/neuro4.jpeg">
            <img src="./Images/cardiology/cardio5.jpeg">
            <img src="./Images/cardiology/cardio6.jpeg">
        </div>
        <div class="imgs-container" id="dental-imgs">
            <img src="./Images/dental/dental1.jpeg">
            <img src="./Images/dental/dental2.jpeg">
            <img src="./Images/dental/dental3.jpeg">
            <img src="./Images/dental/dental4.jpeg">
            <img src="./Images/dental/dental5.jpeg">
            <img src="./Images/dental/dental6.jpeg">
        </div>
        <div class="imgs-container" id="neuro-imgs">
            <img src="./Images/neurology/neuro1.jpeg">
            <img src="./Images/neurology/neuro2.jpeg">
            <img src="./Images/neurology/neuro3.jpeg">
            <img src="./Images/neurology/neuro4.jpeg">
            <img src="./Images/neurology/neuro5.jpeg">
            <img src="./Images/neurology/neuro6.jpeg">
        </div>
        <div class="imgs-container" id="cardio-imgs">
            <img src="./Images/cardiology/cardio1.jpeg">
            <img src="./Images/cardiology/cardio2.jpeg">
            <img src="./Images/cardiology/cardio3.jpeg">
            <img src="./Images/cardiology/cardio4.jpeg">
            <img src="./Images/cardiology/cardio5.jpeg">
            <img src="./Images/cardiology/cardio6.jpeg">
        </div>
        <div class="imgs-container" id="lab-imgs">
            <img src="./Images/laboratry/lab1.jpeg">
            <img src="./Images/laboratry/lab2.jpeg">
            <img src="./Images/laboratry/lab3.jpeg">
            <img src="./Images/laboratry/lab4.jpeg">
            <img src="./Images/laboratry/lab5.jpeg">
            <img src="./Images/laboratry/lab6.jpeg">
        </div>
    </div>

    <div class="feedback-form">
        <h2><u>Contact Form :</u></h2>
        <form action="" method="post">
            <div class="">
                <label>Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="">
                <label>Email:</label>
                <input type="email" name="emailid" required>
            </div>
            <div class="">
                <label>Mobile:</label>
                <input type="number" name="phone" required>
            </div>
            <textarea name="feedback_message" placeholder="Write your message here...." required></textarea>
            <button type="submit" name="submit-feedback">SUBMIT</button>
        </form>
    </div>
    <?php
    if (isset($_POST['submit-feedback'])) {
        include './DB/config.php';
        $feedback_msg = mysqli_real_escape_string($conn, $_POST['feedback_message']);
        if ($conn->query("INSERT INTO `feedback`(`name`, `email`, `phone`, `message`) VALUES ('" . $_POST['name'] . "','" . $_POST['emailid'] . "','" . $_POST['phone'] . "','" . $feedback_msg . "')")) {
            echo "<script>alert('Thank You For Your Valuable Feedback 😊')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
    include './footer.php';
    ?>
    <script src="./JS/script.js"></script>
    <!-- Check Online -->
    <script>
        if (!navigator.onLine) {
            console.log("Internet Issue");
            window.location.replace('./Common/internetError.html');
        }
    </script>
</body>

</html>
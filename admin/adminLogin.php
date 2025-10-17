<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HMS</title>
    <link rel="shortcut icon" href="./../Images/favicon.ico" type="image/x-icon">
    <style>
        * {
            margin: 0;
            border: 0;
            outline: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-top: 2em;
        }

        hr {
            width: 50%;
            height: 1px;
            background-color: gray;
            margin: 1em 0;
        }

        input {
            border: 1px solid blue;
            width: 100%;
            padding: 0.5em;
            margin-bottom: 0.5em;
        }

        input[type='submit'] {
            padding: 0.5em 2em;
            width: fit-content;
            background-color: blue;
            color: white;
            letter-spacing: 0.15em;
            font-weight: 700;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid blue;
            transition-duration: 0.4s;
        }

        input[type='submit']:hover,
        input:focus {
            box-shadow: 0 0 5px 1px blue;
            border-color: white;
        }
    </style>
</head>

<body>
    <h2>HMS: ADMIN</h2>
    <hr>
    <form action="" method="post">
        <label for="id">ID</label>
        <input type="text" id="id" name="id" required><br>
        <label for="pw">Password</label>
        <input type="password" name="pw" id="pw" required><br>
        <input type="submit" value="LOGIN" name="login">
    </form>
    <?php
    if (isset($_POST['login'])) {
        // echo "login clicked";
        // echo $_POST['id'];
        // echo $_POST['pw'];
        if ($_POST['id'] == 'admin') {
            if ($_POST['pw'] == 'kill') {
                session_name('admin');
                session_start();
                $_SESSION['aId'] = '761107';
                echo "<script>window.location.href='admin.php'</script>";
            } else {
                echo "Incorrect Password";
            }
        } else {
            echo "Incorrect Id";
        }
    }
    ?>
</body>

</html>
<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h1>Registration form</h1>
                <form action="check.php" method="post">
                    <input type="text" class="form-control" name="login" id="login" placeholder="login"><br>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email"><br>
                    <input type="text" class="form-control" name="fio" id="fio" placeholder="full name"><br>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="pass"><br>
                    <button class="btn btn-success">Registrate</button>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<p class="text-danger"> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
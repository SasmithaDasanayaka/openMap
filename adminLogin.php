<?php
session_start();
if (isset($_SESSION['is_user_set']) && $_SESSION['is_user_set'] === true) {
    header('location:php/admin.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('php/authenticate.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>xplomate</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
    <link rel="stylesheet" type="text/css" href="styles/adminStyle.css"/>

    <!--    <script src="./index.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/signInFunctions.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<?php
if (isset($loginError) && !empty($loginError)) {
    echo "<div class='alert alert-danger' style='position: absolute;
    left: 20px;
    top: 20px;
    z-index: 1;
    width: 400px;
    height: 100px;'>
    <div class='toast-header d-inline-block' style=' height: 30px;
    background-color: #eb9994;'>
        <strong class='mr-auto text-primary d-block'>Warning</strong>
    </div>
    <div class='toast-body'>
        <p><strong>Enter valid username and password</strong></p>
    </div>
</div>";
}
?>

<div id="sign-in-popup" class="sign-in">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Sign In</h5>
            <hr>
            <p class="card-text">* Only admins can sign in.</p>
            <form action="adminLogin.php" method="post" id="sign-in-form">
                <div class="form-group">
                    <input value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" type="text"
                           class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
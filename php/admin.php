<?php
session_start();
if (!isset($_SESSION['is_user_set'])) {
    header('location:../adminLogin.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>xplomate</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../js/adminFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/adminStyle.css"/>
</head>


<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">XPlomate</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <button id="select-location-type" class="btn btn-primary">View Rejected Locations</button>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a class="log-out" href="logout.php">Log Out</a>
        </form>
    </div>
</nav>

<div class="alert alert-danger" id="toast-warning">
    <div class="toast-header d-inline-block " id="toast-header-warning">
        <strong class="mr-auto text-primary d-block">Warning</strong>
    </div>
    <div class="toast-body">
        <p><strong></strong></p>
    </div>
</div>


<div id="map"></div>

<div class="table-div" style="width: 50%;height:80%;position: absolute;top: 100px;left: 20px;overflow-y: scroll">
    <p><strong>Pending Locations</strong></p>
    <table class="table" id="table-id" style="position: absolute">
        <thead>
        <tr class="table-header">
            <th>ID</th>
            <th>Longitudes</th>
            <th>Latitudes</th>
            <th style="width: 200px">Description</th>
            <th>Action</th>
            <th><i id="refresh" class="fa fa-refresh"></i></th>
        </tr>
        </thead>
        <tbody class="table-body" id="tbody-id">
        </tbody>
    </table>
</div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8nueSoOhRCDTTw4Wjxt1CyRd3JavCSUQ&callback=initMap&libraries=&v=weekly"
        async></script>

</body>
</html>




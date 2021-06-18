<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"/>
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

    <script type="text/javascript" src="functions.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<!--<body>-->
<body>

<div class="alert alert-danger" id="toast-warning">
    <div class="toast-header d-inline-block " id="toast-header-warning">
        <strong class="mr-auto text-primary d-block">Warning</strong>
    </div>
    <div class="toast-body">
        <p><strong></strong></p>
    </div>
</div>

<div id="popUp" class="pop-up">
    <form id="form">
        <div class="container">
            <h4>Save Location</h4>
            <hr>
            <h6>Tags</h6>
            <div class="row">
                <div class="form-group">
                    <select class="mul-select" multiple="multiple" id="multiSelect">
                        <option value="0">Hotel</option>
                        <option value="1">Restaurant</option>
                        <option value="2">Club</option>
                        <option value="3">Shopping Complex</option>
                        <option value="4">Temple</option>
                        <option value="5">Hospital</option>
                        <option value="6">School</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <h6>Description</h6>
                </div>
                <div class="col-md-8">
                    <textarea id='description' placeholder='Description'></textarea>
                </div>
            </div>
            <div class="row" style="position: absolute;bottom: 5px;width: 90%">
                <div class="col-md-4 ">
                </div>
                <div class="col-md-8 d-flex justify-content-around">
                    <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
                    <button type="button" class="btn btn-danger" onclick="cancelSave()">Cancel</button>
                </div>
            </div>
        </div>
    </form>

</div>

<div id="filterPopUp" class="filter-pop-up">
    <form id="formFilter">
        <div class="container">
            <h4>Filter Location</h4>
            <h6>Tags</h6>
            <hr>
            <div class="row">
                <select class="mul-select" multiple="multiple" id="multiSelectFilter" >
                    <option value="0">Hotel</option>
                    <option value="1">Restaurant</option>
                    <option value="2">Club</option>
                    <option value="3">Shopping Complex</option>
                    <option value="4">Temple</option>
                    <option value="5">Hospital</option>
                    <option value="6">School</option>
                </select>
            </div>
            <div class="row pt-5">
                <div class="col-md-4 ">
                </div>
                <div class="col-md-8 d-flex justify-content-around">
                    <button type="button" class="btn btn-danger" onclick="cancelFilter()">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="map" style="position: relative;width: 100%"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8nueSoOhRCDTTw4Wjxt1CyRd3JavCSUQ&callback=initMap&libraries=&v=weekly"
        async></script>


</body>

</html>
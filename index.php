<!DOCTYPE html>
<html>

<head>
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


</head>

<body style="height: 100%">
<style>
    .mul-select {
        width: 100%;
    }
</style>

<div id="popUp">
    <form id="form">
        <div class="container">
            <h4>Save Location</h4>
            <hr>
            <h6>Tags</h6>
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" checked id="hotel" value="0">
                    <label for="hotel">Hotel</label>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" id="restaurant" value="1">
                    <label for="restaurant">Restaurant</label>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <select class="mul-select" multiple="true">-->
                <!--                        <option value="Cambodia">Cambodia</option>-->
                <!--                        <option value="Khmer">Khmer</option>-->
                <!--                        <option value="Thiland">Thiland</option>-->
                <!--                        <option value="Koren">Koren</option>-->
                <!--                        <option value="China">China</option>-->
                <!--                        <option value="English">English</option>-->
                <!--                        <option value="USA">USA</option>-->
                <!--                    </select>-->
                <!--                </div>-->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" id="club" value="2">
                    <label for="club">Club</label>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" id="hospital" value="3">
                    <label for="hospital">Hospital</label>
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

<div id="filterPopUp">
    <form id="formFilter">
        <div class="container">
            <h4>Filter Location</h4>
            <h6>Tags</h6>
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" id="hotel" value="0" name="filter-input">
                    <label for="hotel">Hotel</label>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" id="restaurant" value="1" name="filter-input">
                    <label for="restaurant">Restaurant</label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" id="club" value="2" name="filter-input">
                    <label for="club">Club</label>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" id="hospital" value="3" name="filter-input">
                    <label for="hospital">Hospital</label>
                </div>
            </div>
            <hr>
            <div class="row" style="position: absolute;bottom: 5px;width: 90%">
                <div class="col-md-4 ">
                </div>
                <div class="col-md-8 d-flex justify-content-around">
                    <button type="button" class="btn btn-danger" onclick="cancelFilter()">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="map" style="position: relative"></div>


<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8nueSoOhRCDTTw4Wjxt1CyRd3JavCSUQ&callback=initMap&libraries=&v=weekly"
        async></script>
</body>

<script>
    $(document).ready(function () {
        $(".mul-select").select2({
            placeholder: "select country", //placeholder
            tags: true,
            tokenSeparators: ['/', ',', ';', " "]
        });
    })
</script>

</html>
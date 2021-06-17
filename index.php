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
    let map;
    let marker;
    let allSavedLocations;
    const tagsDescribeArray = ["Hotel", "Restaurant", "Club", "Hospital"];
    let allSavedMarkers = [];
    let allSavedUniqueLoc = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8,
        });

        loadALlSavedLocations();

        map.addListener('click', (event) => {
            placeMarker(event.latLng);
        });


        // Create the DIV to hold the control and call the CenterControl()
        // constructor passing in this DIV.
        const centerControlDiv = document.createElement("div");
        CenterControl(centerControlDiv, map);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(centerControlDiv);
        centerControlDiv.addEventListener('click', (e) => {
            document.getElementById('popUp').style.visibility = 'visible'
        });

        const filterControlDiv = document.createElement("div");
        FilterControl(filterControlDiv, map);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(filterControlDiv);
        filterControlDiv.addEventListener('click', (e) => {
            document.getElementById('filterPopUp').style.visibility = 'visible'
        });

        // Select all checkboxes with the name 'settings' using querySelectorAll.
        var checkboxes = document.querySelectorAll("input[type=checkbox][name=filter-input]");
        let enabledCheckBoxes = []

        // Use Array.forEach to add an event listener to each checkbox.
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function () {
                enabledCheckBoxes =
                    Array.from(checkboxes) // Convert checkboxes to an array to use filter and map.
                        .filter(i => i.checked) // Use Array.filter to remove unchecked checkboxes.
                        .map(i => i.value) // Use Array.map to extract only the checkbox values from the array of objects.

                console.log("marker before", marker)
                marker && marker.setMap(null)
                console.log("marker after", marker)
                if (enabledCheckBoxes.length != 0) {
                    allSavedMarkers.forEach(marker => {
                        marker.setMap(null)
                    })
                } else {
                    setAllMarkers(allSavedUniqueLoc)
                }


                enabledCheckBoxes.forEach(ele => {
                    const checkedBoxValue = parseInt(ele)
                    let filteredLoc = allSavedLocations.filter(ele => parseInt(ele.tag_id) === checkedBoxValue)
                    let markerLocations = [];
                    markerLocations.push(filteredLoc[0]);
                    filteredLoc.forEach(ele => {
                        let tem = markerLocations;
                        let ispresent = false;
                        tem.forEach(e => {
                            if (e.id === ele.id) {
                                ispresent = true;
                            }
                        })
                        !ispresent && markerLocations.push(ele);
                    })
                    setAllMarkers(markerLocations);
                })
            })
        });
    }

    function placeMarker(location) {
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        } else {
            if (marker.map) {
                marker.setPosition(location);
                var transitLayer = new google.maps.TransitLayer();
                transitLayer.setMap(map);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }
    }

    function setAllMarkers(markerLocationsArray) {
        markerLocationsArray.forEach(marker => {
            const lat = parseFloat(marker.latitude)
            const lng = parseFloat(marker.longitude)
            let markers = new google.maps.Marker({
                position: {lat, lng},
                map: map,
                title: marker.description,
            });
            allSavedMarkers.push(markers)
        })
    }

    function saveData() {
        const description = document.getElementById('description').value;
        let tagsArray = [];
        var checkboxes = document.getElementsByTagName("input");
        var isChecked = false;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == "checkbox") {
                if (checkboxes[i].checked) {
                    isChecked = true;
                    tagsArray.push(parseInt(checkboxes[i].value))

                }
            }
        }
        if (marker) {
            if (isChecked) {
                if (description != '') {
                    const position = marker.getPosition().toJSON()
                    const tags = tagsArray
                    const dataObj = {
                        position,
                        des: description,
                        tags
                    }
                    $.post("saveLocations.php", {
                        dataObj
                    }, (data, status) => {
                        if (status === "success") {
                            document.getElementById('popUp').style.visibility = 'hidden';
                            alert("Successfully added location!");
                            document.getElementById("form").reset();
                        } else {
                            alert("Error occured in saving location! Please try again ");
                        }

                    })
                } else {
                    alert("Please fill the description");
                }
            } else {
                alert("Please select a tag");
            }
        } else {
            alert("Please select a location in the map");
        }
    }

    function loadALlSavedLocations() {
        $.get("loadLocations.php", (data, status) => {
            const res = JSON.parse(data)
            allSavedLocations = res;
            let markerLocations = [];
            markerLocations.push(res[0]);
            res.forEach(ele => {
                let tem = markerLocations;
                let ispresent = false;
                tem.forEach(e => {
                    if (e.id === ele.id) {
                        ispresent = true;
                    }
                })
                !ispresent && markerLocations.push(ele);
            })
            allSavedUniqueLoc = markerLocations;
            markerLocations.forEach(marker => {
                const lat = parseFloat(marker.latitude)
                const lng = parseFloat(marker.longitude)
                let markers = new google.maps.Marker({
                    position: {lat, lng},
                    map: map,
                    title: marker.description,
                });
                allSavedMarkers.push(markers)
            })
        })

    }

    function cancelSave() {
        document.getElementById('popUp').style.visibility = 'hidden';
        document.getElementById("form").reset();
    }

    function cancelFilter() {
        document.getElementById('filterPopUp').style.visibility = 'hidden';
        document.getElementById("formFilter").reset();
        setAllMarkers(allSavedUniqueLoc);
    }

    initMap()
</script>
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
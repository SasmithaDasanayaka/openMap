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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="height: 100%">


<div style="z-index: 10000000000000000000" id="form">
    <table class="map1">
        <tr>
            <input name="id" type='hidden' id='id'/>
            <td><a>Description:</a></td>
            <td><textarea id='description' placeholder='Description'></textarea></td>
        </tr>
        <tr>
            <td><b>Confirm Location ?:</b></td>
            <td><input id='confirmed' type='checkbox' name='confirmed'></td>
        </tr>

        <tr>
            <td></td>
            <td><input type='button' value="save"/></td>
        </tr>
    </table>
</div>
<div id="map"></div>


<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8nueSoOhRCDTTw4Wjxt1CyRd3JavCSUQ&callback=initMap&libraries=&v=weekly"
        async
></script>
</body>

<script>
    let map;
    let marker;
    let infowindow;

    function initMap() {
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById("map"), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8,
        });


        map.addListener('click', (event) => {
            placeMarker(event.latLng);
        });


        // Create the DIV to hold the control and call the CenterControl()
        // constructor passing in this DIV.
        const centerControlDiv = document.createElement("div");
        CenterControl(centerControlDiv, map);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(centerControlDiv);
        // centerControlDiv.addEventListener('click', (event) => {
        //     console.log(event, locationDetails)
        //     $("#form").show();
        //     infowindow.setContent(document.getElementById("form"));
        //     infowindow.open(map, marker);
        // })
        centerControlDiv.addEventListener('click', (e) => {

        });


    }

    function placeMarker(location) {
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        } else {
            marker.setPosition(location);
            var transitLayer = new google.maps.TransitLayer();
            transitLayer.setMap(map);
        }
    }

    /**
     * The CenterControl adds a control to the map that recenters the map on
     * Chicago.
     * This constructor takes the control DIV as an argument.
     * @constructor
     */
    function CenterControl(controlDiv, map) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "rgb(61, 176, 12)";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Click to recenter the map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "#fff";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "16px";
        controlText.style.lineHeight = "38px";
        controlText.style.paddingLeft = "5px";
        controlText.style.paddingRight = "5px";
        controlText.innerHTML = "Save Location";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        // controlUI.addEventListener("click", () => {
        //     map.setCenter(chicago);
        // });
    }


    initMap()
</script>
</html>
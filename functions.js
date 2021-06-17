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
    loadALlSavedLocations();
    filter();


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

function filter(){
    map.addListener('click', (event) => {
        document.getElementById('filterPopUp').style.visibility = 'hidden';
        document.getElementById("formFilter").reset();
        setAllMarkers(allSavedUniqueLoc);
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
    controlUI.title = "Click to save the location";
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

}

function FilterControl(controlDiv, map) {
    // Set CSS for the control border.
    const controlUI = document.createElement("div");
    controlUI.style.backgroundColor = "#4445c7";
    controlUI.style.border = "2px solid #fff";
    controlUI.style.borderRadius = "3px";
    controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
    controlUI.style.cursor = "pointer";
    controlUI.style.marginTop = "8px";
    controlUI.style.marginBottom = "22px";
    controlUI.style.textAlign = "center";
    controlUI.title = "Click to filter locations";
    controlDiv.appendChild(controlUI);
    // Set CSS for the control interior.
    const controlText = document.createElement("div");
    controlText.style.color = "#fff";
    controlText.style.fontFamily = "Roboto,Arial,sans-serif";
    controlText.style.fontSize = "16px";
    controlText.style.lineHeight = "38px";
    controlText.style.paddingLeft = "5px";
    controlText.style.paddingRight = "5px";
    controlText.innerHTML = "Filter Location";
    controlUI.appendChild(controlText);

}
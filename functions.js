let map;
let marker;
let allSavedLocations;
let allSavedMarkers = [];
let allSavedUniqueLoc = [];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 8,
        fullscreenControl: false
    });
    map.addListener('click', (event) => {
        placeMarker(event.latLng);
    });


    const loginControl = document.createElement("div");
    LoginControl(loginControl, map);
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(loginControl);
    loginControl.addEventListener('click', (e) => {
        console.log('working')
    });

    // Create the DIV to hold the control and call the CenterControl()
    // constructor passing in this DIV.
    const saveControlDiv = document.createElement("div");
    CenterControl(saveControlDiv, map);
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(saveControlDiv);
    saveControlDiv.addEventListener('click', (e) => {
        document.getElementById('popUp').classList.remove('pop-up');
        document.getElementById('popUp').classList.add('grow-pop-up');
        $(".mul-select").select2({
            placeholder: "select tags", //placeholder
            tags: true,
            tokenSeparators: ['/', ',', ';', " "],
            allowClear: true
        });
    });

    const filterControlDiv = document.createElement("div");
    FilterControl(filterControlDiv, map);
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(filterControlDiv);
    filterControlDiv.addEventListener('click', (e) => {
        document.getElementById('filterPopUp').classList.remove('filter-pop-up');
        document.getElementById('filterPopUp').classList.add('grow-filter-pop-up');
        $(".mul-select").select2({
            placeholder: "select tags", //placeholder
            tags: true,
            tokenSeparators: ['/', ',', ';', " "],
            allowClear: true
        });
    });

    //load saved locations
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

function filter() {
    map.addListener('click', (event) => {
        document.getElementById('filterPopUp').classList.remove('grow-filter-pop-up');
        document.getElementById('filterPopUp').classList.add('filter-pop-up');
        $("#multiSelectFilter").val(null).trigger("change");
        setAllMarkers(allSavedUniqueLoc);
    });
    $('#multiSelectFilter').on('change', function (e) {
        var strTagsArray = $('#multiSelectFilter').val() && $('#multiSelectFilter').val();
        if (strTagsArray && strTagsArray.length != 0) {
            var tagsArray = strTagsArray.map(ele => parseInt(ele));
            marker && marker.setMap(null)

            //remove all markers
            allSavedMarkers.forEach(marker => {
                marker.setMap(null)
            })

            tagsArray.forEach(tag => {
                let filteredLoc = allSavedLocations.filter(ele => parseInt(ele.tag_id) === tag)
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

        } else {
            setAllMarkers(allSavedUniqueLoc)
        }
    });
}

function saveData() {
    const description = document.getElementById('description').value;
    let tagsArray = $('#multiSelect').val();
    let isTagSet = false;
    if (tagsArray && tagsArray.length != 0) {
        tagsArray = tagsArray.map(ele => parseInt(ele))
        isTagSet = true;
    }
    if (marker) {
        if (isTagSet) {
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
                    console.log("return: ", data)
                    if (status === "success") {
                        document.getElementById('popUp').classList.remove('grow-pop-up');
                        document.getElementById('popUp').classList.add('pop-up');
                        document.getElementById("form").reset();
                        $("#multiSelect").val(null).trigger("change");
                        setTimeout(() => {
                            $("#multiSelect").empty().trigger('change');
                            $('#toast-warning strong').html("Succes");
                            $('#toast-warning p').html("Succesfully Saved the location");
                            $('#toast-warning').removeClass('alert-danger');
                            $('#toast-warning').addClass('alert-success');
                            $('#toast-header-warning').css({'background-color': '#b6e86d'});
                            $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
                        }, 700)


                        setTimeout(() => {
                            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
                            $('#toast-warning').removeClass('alert-success');
                            $('#toast-warning').addClass('alert-danger');
                            $('#toast-header-warning').css({'background-color': '#eb9994'});
                            $('#toast-warning strong').html("Warning");
                        }, 3700)
                    } else {
                        $('#toast-warning p').html("Error occurred in saving location!");
                        $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
                        setTimeout(() => {
                            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
                        }, 3000)
                    }

                })
            } else {
                $('#toast-warning p').html("Please enter a description");
                $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
                setTimeout(() => {
                    $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
                }, 3000)
            }
        } else {
            $('#toast-warning p').html("Please select a tag");
            $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
            setTimeout(() => {
                $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
            }, 3000)
        }
    } else {
        $('#toast-warning p').html("Please select a location in the map");
        $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
        setTimeout(() => {
            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
        }, 3000)
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
    document.getElementById('popUp').classList.remove('grow-pop-up');
    document.getElementById('popUp').classList.add('pop-up');
    $("#multiSelect").val(null).trigger("change");
    document.getElementById("form").reset();
}

function cancelFilter() {
    document.getElementById('filterPopUp').classList.remove('grow-filter-pop-up');
    document.getElementById('filterPopUp').classList.add('filter-pop-up');
    $("#multiSelectFilter").val(null).trigger("change");
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
    controlUI.style.marginTop = "20px";
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

function LoginControl(controlDiv, map) {
    // Set CSS for the control border.
    const btnUI = document.createElement("button");
    btnUI.classList.add('fa');
    btnUI.classList.add('fa-home');
    controlDiv.appendChild(btnUI);
    // Set CSS for the control interior.
    const icon = document.createElement("i");
    // controlText.style.color = "#fff";
    // controlText.style.fontFamily = "Roboto,Arial,sans-serif";
    // controlText.style.fontSize = "16px";
    // controlText.style.lineHeight = "38px";
    // controlText.style.paddingLeft = "5px";
    // controlText.style.paddingRight = "5px";
    // controlText.innerHTML = "Filter Location";
    icon.classList.add('fa-solid');
    icon.classList.add('fa-right-to-bracket');

    btnUI.appendChild(icon);

}
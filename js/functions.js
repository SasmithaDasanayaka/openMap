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
        marker && marker.setMap(null)
        document.getElementById('filterPopUp').classList.remove('filter-pop-up');
        document.getElementById('filterPopUp').classList.add('grow-filter-pop-up');
        setTimeout(() => {
            let filteredLoc = allSavedLocations.filter(ele =>
                parseInt(ele.age) === 0 &&
                parseInt(ele.race) === 0 &&
                parseInt(ele.gender) === 0 &&
                parseInt(ele.religion) === 0 &&
                parseInt(ele.disability) === 0 &&
                parseInt(ele.socioeconomic) === 0)
            allSavedMarkers.forEach(marker => {
                marker.setMap(null)
            })
            if (filteredLoc && filteredLoc.length != 0) {
                setAllMarkers(filteredLoc);
            }
        }, 10)
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
            icon: 'http://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=%7c5680FC%7c000000&.png'
        });
    } else {
        if (marker.map) {
            marker.setPosition(location);
            var transitLayer = new google.maps.TransitLayer();
            transitLayer.setMap(map);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: 'http://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=%7c5680FC%7c000000&.png'
            });
        }
    }
}

function setAllMarkers(markerLocationsArray) {
    markerLocationsArray.forEach(marker => {
        const lat = parseFloat(marker.latitude);
        const lng = parseFloat(marker.longitude);
        const infoWindowString = `<div id="content">
                                            <div id="siteNotice">
                                                ${marker.description}
                                            </div>
                                           </div>`;
        const infowindow = new google.maps.InfoWindow({
            content: infoWindowString,
        });
        let markers = new google.maps.Marker({
            position: {lat, lng},
            map: map,
            title: marker.description,
        });
        markers.addListener("click", () => {
            infowindow.open({
                anchor: markers,
                map,
                shouldFocus: false,
            });
        });
        allSavedMarkers.push(markers)
    })
}

function filter() {
    map.addListener('click', (event) => {
        document.getElementById('filterPopUp').classList.remove('grow-filter-pop-up');
        document.getElementById('filterPopUp').classList.add('filter-pop-up');
        document.getElementById('formFilter').reset();
        setAllMarkers(allSavedLocations);
    });

    $(document).on('change', '#filterPopUp select', (event) => {
        const age = parseInt($('#selector-filter-age').val());
        const race = parseInt($('#selector-filter-race').val());
        const religion = parseInt($('#selector-filter-religion').val());
        const gender = parseInt($('#selector-filter-gender').val());
        const disability = parseInt($('#selector-filter-disability').val());
        const socioeconomic = parseInt($('#selector-filter-socioeconomy').val());

        const filterMaps = {};
        if (age !== -1) filterMaps['age'] = age;
        if (race !== -1) filterMaps['race'] = race;
        if (religion !== -1) filterMaps['religion'] = religion;
        if (gender !== -1) filterMaps['gender'] = gender;
        if (disability !== -1) filterMaps['disability'] = disability;
        if (socioeconomic !== -1) filterMaps['socioeconomic'] = socioeconomic;


        marker && marker.setMap(null);
        //remove all markers
        allSavedMarkers.forEach(marker => {
            marker.setMap(null)
        })
        let filteredLoc = [];
        allSavedLocations.forEach(location => {
            let isLocationFiltered = false;
            for (let key of Object.keys(filterMaps)) {
                if (filterMaps[key] === parseInt(location[key])) {
                    isLocationFiltered = true;
                    break;
                    p
                }
            }
            if (isLocationFiltered) {
                filteredLoc.push(location);
            }
        })

        if (filteredLoc && filteredLoc.length != 0) {
            setAllMarkers(filteredLoc);
        }
    })
}

function saveData() {
    const description = document.getElementById('description').value;
    const age = document.getElementById('selector-age').value;
    const race = document.getElementById('selector-race').value;
    const gender = document.getElementById('selector-gender').value;
    const religion = document.getElementById('selector-religion').value;
    const disability = document.getElementById('selector-disability').value;
    const socioeconomy = document.getElementById('selector-socioeconomy').value;

    if (marker) {
        if (description != '') {
            const position = marker.getPosition().toJSON()
            const dataObj = {
                position,
                des: description,
                age,
                race,
                gender,
                religion,
                disability,
                socioeconomy
            }
            $.post("php/saveLocations.php", {
                dataObj
            }, (data, status) => {
                if (status === "success") {
                    document.getElementById('popUp').classList.remove('grow-pop-up');
                    document.getElementById('popUp').classList.add('pop-up');
                    document.getElementById("form").reset();
                    setTimeout(() => {
                        $('#toast-warning strong').html("Succes");
                        $('#toast-warning p').html("Succesfully Saved the location");
                        $('#toast-warning').removeClass('alert-danger');
                        $('#toast-warning').addClass('alert-success');
                        $('#toast-header-warning').css({'background-color': '#b6e86d'});
                        $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
                    }, 900)

                    setTimeout(() => {
                        $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
                    }, 3900)


                    setTimeout(() => {
                        $('#toast-warning').removeClass('alert-success');
                        $('#toast-warning').addClass('alert-danger');
                        $('#toast-header-warning').css({'background-color': '#eb9994'});
                        $('#toast-warning strong').html("Warning");
                    }, 4400)
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
        $('#toast-warning p').html("Please select a location in the map");
        $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
        setTimeout(() => {
            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
        }, 3000)
    }
}

function loadALlSavedLocations() {
    $.get("php/loadLocations.php", {flag: 1}, (data, status) => {
        const res = JSON.parse(data)
        allSavedLocations = res;
        setTimeout(() => {
            allSavedLocations.forEach(marker => {
                const lat = parseFloat(marker.latitude)
                const lng = parseFloat(marker.longitude)
                const infoWindowString = `<div id="content">
                                            <div id="siteNotice">
                                                ${marker.description}
                                            </div>
                                           </div>`;
                const infowindow = new google.maps.InfoWindow({
                    content: infoWindowString,
                });
                let markers = new google.maps.Marker({
                    position: {lat, lng},
                    map: map,
                    title: marker.description,
                });
                markers.addListener("click", () => {
                    infowindow.open({
                        anchor: markers,
                        map,
                        shouldFocus: false,
                    });
                });
                allSavedMarkers.push(markers)
            })
        }, 2000)
    })

}

function cancelSave() {
    document.getElementById('popUp').classList.remove('grow-pop-up');
    document.getElementById('popUp').classList.add('pop-up');
    document.getElementById("form").reset();

}

function cancelFilter() {
    marker && marker.setMap(map)
    document.getElementById('filterPopUp').classList.remove('grow-filter-pop-up');
    document.getElementById('filterPopUp').classList.add('filter-pop-up');
    document.getElementById('formFilter').reset();
    setAllMarkers(allSavedLocations);
}

function resetFilter() {
    document.getElementById('formFilter').reset();
    let filteredLoc = allSavedLocations.filter(ele =>
        parseInt(ele.age) === 0 &&
        parseInt(ele.race) === 0 &&
        parseInt(ele.gender) === 0 &&
        parseInt(ele.religion) === 0 &&
        parseInt(ele.disability) === 0 &&
        parseInt(ele.socioeconomic) === 0)
    allSavedMarkers.forEach(marker => {
        marker.setMap(null)
    })
    if (filteredLoc && filteredLoc.length != 0) {
        setAllMarkers(filteredLoc);
    }
}


initMap()

function CenterControl(controlDiv, map) {
    const icon = document.createElement("i");
    icon.style.cursor = "pointer";
    icon.style.width = '40px';
    icon.style.height = '40px';
    icon.style.marginTop = "20px";
    icon.style.marginRight = "10px";
    icon.style.padding = '4px 2px 2px 8px';
    icon.classList.add('fa');
    icon.classList.add('fa-plus-square-o');
    icon.style.fontSize = '30px';
    icon.title = "Save location";
    icon.style.color = 'rgb(133, 133, 133)';
    icon.style.backgroundColor = 'white';
    icon.style.borderBottom = '1px solid #d3d8e0';
    icon.style.borderTopLeftRadius = '2px';
    icon.style.borderTopRightRadius = '2px';
    controlDiv.appendChild(icon);

}

function FilterControl(controlDiv, map) {
    const icon = document.createElement("i");
    icon.style.cursor = "pointer";
    icon.style.width = '40px';
    icon.style.height = '40px';
    icon.style.marginTop = "0px";
    icon.style.marginRight = "10px";
    icon.style.padding = '4px 2px 2px 8px';
    icon.classList.add('fa');
    icon.classList.add('fa-filter');
    icon.style.fontSize = '30px';
    icon.title = "Filter locations";
    icon.style.color = 'rgb(133, 133, 133)';
    icon.style.backgroundColor = 'white';
    icon.style.borderBottomLeftRadius = '2px';
    icon.style.borderBottomRightRadius = '2px';

    controlDiv.appendChild(icon);
}


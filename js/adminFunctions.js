let map;
let marker;
let allAcceptLocations;
let allAcceptUniqueLoc = [];
let selectedFlag = 0;
const filtersArray = ["Prefer not to answer", "0-19", "20-39", "40-60", "61+", "Person of Color", "Black", "Indigenous/Native American", "Latinx", "Asian/Pacific Islander", "White", "Middle Eastern/North African/Arab", "Multiracial / Two or more races", "Immigrant", "Foreign Born Person", "Female", "Male", "Transgender", "Gender Queer", "Gender Non-Conforming", "Gender Non-Binary", "Lesbian", "Gay", "Bisexual", "Queer", "Pansexual", "Asexual", "Agender", "Demisexual", "Straight", "Intersex", "Two-Spirit", "Agnostic", "Atheist", "Buddhist", "Eastern Orthodox", "Hindu, Jain, or Sikh", "Humanist", "Jewish", "Muslim", "None/Nonreligious", "Protestant", "Roman Catholic", "Unitarian Universalist", "Other", "Cognitive", "Emotional", "Hearing", "Mental", "Physical", "Visual", "Working class", "Lower middle class", "Upper middle class", "Upper class"]


function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 7,
    });

    loadALlSavedLocations(0);
}


function loadALlSavedLocations(flag) {
    $.get("loadLocations.php", {flag}, (data, status) => {

        const res = JSON.parse(data);
        if (res.length != 0) {
            allAcceptLocations = res;
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
            allAcceptUniqueLoc = markerLocations;
            allAcceptUniqueLoc.forEach(ele => {
                    const toottipTitle = `Age: ${filtersArray[parseInt(ele.age)]},Religion: ${filtersArray[parseInt(ele.religion)]}, Gender: ${filtersArray[parseInt(ele.gender)]},&#013; Race: ${filtersArray[parseInt(ele.race)]}, Disability: ${filtersArray[parseInt(ele.disability)]}, Socioeconomic class: ${filtersArray[parseInt(ele.socioeconomic)]}`.replace(/[ ]/g, "\u00a0");
                    if (flag === 0) {
                        $("#table-id tbody").append(`<tr scope='row' data-toggle='tooltip' data-placement='bottom' title=${toottipTitle} data-html="true"> ` +
                            `<td id=table-${ele.id} > ` + ele.id + "</td>" +
                            "<td>" + ele.longitude + "</td>" +
                            "<td>" + ele.latitude + "</td>" +
                            "<td>" + ele.description + "</td>" +
                            "<td>" + `<i id=eye-${ele.id} class='fa fa-eye'></i>` +
                            `<i id=accept-${ele.id} class='fa fa-check-circle-o'></i>` +
                            `<i id=reject-${ele.id} class='fa fa-window-close-o'></i>` + "</td>" +

                            "</tr>");

                        $(`#eye-${ele.id}`).click((e) => {
                            let temLocation = {
                                lat: parseFloat(ele.latitude),
                                lng: parseFloat(ele.longitude)
                            };
                            placeMarker(temLocation);
                        })

                        $(`#accept-${ele.id}`).click((e) => {
                            accept(ele.id);
                        })
                        $(`#reject-${ele.id}`).click((e) => {
                            reject(ele.id);
                        })
                    } else if (flag === 2) {
                        $("#table-id tbody").append(`<tr scope='row' data-toggle='tooltip' data-placement='bottom' title=${toottipTitle}>` +
                            `<td id=table-${ele.id} > ` + ele.id + "</td>" +
                            "<td>" + ele.longitude + "</td>" +
                            "<td>" + ele.latitude + "</td>" +
                            "<td>" + ele.description + "</td>" +
                            "<td>" + `<i id=eye-${ele.id} class='fa fa-eye'></i>` +
                            "</td>" +
                            "</tr>");

                        $(`#eye-${ele.id}`).click((e) => {
                            let temLocation = {
                                lat: parseFloat(ele.latitude),
                                lng: parseFloat(ele.longitude)
                            };
                            placeMarker(temLocation);
                        })
                    }


                }
            )

        }
    })
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
                map: map,
            });
        }
    }
    map.setCenter(marker.getPosition());
}

function accept(location_id) {
    $.post('adminActions.php', {location_id, accept: 'yes'}, () => {
        setTimeout(() => {
            $('#toast-warning strong').html("Succes");
            $('#toast-warning p').html("Succesfully Accepted the location");
            $('#toast-warning').removeClass('alert-danger');
            $('#toast-warning').addClass('alert-success');
            $('#toast-header-warning').css({'background-color': '#b6e86d'});
            $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
            $('#refresh').click();
        }, 900)

        setTimeout(() => {
            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
        }, 3900)
    })
}

function reject(location_id) {
    $.post('adminActions.php', {location_id, accept: 'no'}, () => {
        setTimeout(() => {
            $('#toast-warning strong').html("Succes");
            $('#toast-warning p').html("Succesfully Rejected the location");
            $('#toast-warning').removeClass('alert-danger');
            $('#toast-warning').addClass('alert-success');
            $('#toast-header-warning').css({'background-color': '#b6e86d'});
            $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
            $('#refresh').click();
        }, 900)

        setTimeout(() => {
            $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
        }, 3900)
    })
}


$(document).ready(() => {
    $('#refresh').click((e) => {
        $("#tbody-id").empty();
        loadALlSavedLocations(selectedFlag);
        marker && marker.setMap(null);
    })
    $('#select-location-type').click((e) => {
        marker && marker.setMap(null);
        $("#tbody-id").empty();
        selectedFlag = selectedFlag === 0 ? 2 : 0;
        let btnText = selectedFlag === 0 ? 'View Rejected Locations' : 'View Pending Locations';
        let title = selectedFlag === 0 ? 'Pending Locations' : 'Rejected Locations';
        $('#select-location-type').html(btnText);
        $('strong').html(title);
        loadALlSavedLocations(selectedFlag);
    })
})
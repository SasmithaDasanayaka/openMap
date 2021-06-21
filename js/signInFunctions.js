$('#sign-in-form').submit((e) => {

})


function triggerToast(message) {
    $('#toast-warning p').html(message);
    $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
    setTimeout(() => {
        $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
    }, 3000)
}

$(document).ready(function () {
    history.pushState(null, document.title, location.href);
});
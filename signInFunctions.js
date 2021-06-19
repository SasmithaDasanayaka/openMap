function signIn() {
    const adminUsername = 'Admin';
    const adminPw = 'Admin@123';

    const username = $('#username').val();
    const pw = $('#password').val();
    if (username === '' || pw === '') {
        triggerToast("Fill both username and password")
    } else {
        if (adminUsername === username) {
            if (adminPw === pw) {
                console.log('success')

            } else {
                triggerToast("Invalid password")

            }
        } else {
            triggerToast("Invalid username")
        }
    }
}


function triggerToast(message) {
    $('#toast-warning p').html(message);
    $('#toast-warning').css({'left': '20px', 'transition-duration': '0.5s'});
    setTimeout(() => {
        $('#toast-warning').css({'left': '-400px', 'transition-duration': '0.5s'});
    }, 3000)
}
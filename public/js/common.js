function loadbutton() {
    $('.submitbtn').attr('disabled', true);
    $('.submitbtn').text('Please wait..');
}

function stopbutton() {
    $('.submitbtn').attr('disabled', false);
    $('.submitbtn').text('Submit');
}
function clearSession() {
    localStorage.removeItem('token');
    localStorage.removeItem('auth');
}

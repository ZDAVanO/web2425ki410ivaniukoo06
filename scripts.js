
// POST AJAX
document.getElementById('postAjaxSubmit').addEventListener('click', function() {
    var postData = document.getElementById('ajaxPostData').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('postAjaxResponse').innerHTML = '<div class="alert alert-success mt-2" role="alert">' + xhr.responseText + '</div>';
        }
    };
    xhr.send('ajaxPostData=' + encodeURIComponent(postData));
});

// GET AJAX
document.getElementById('getAjaxSubmit').addEventListener('click', function() {
    var getData = document.getElementById('ajaxGetData').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './ajax.php?ajaxGetData=' + encodeURIComponent(getData), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('getAjaxResponse').innerHTML = '<div class="alert alert-success mt-2" role="alert">' + xhr.responseText + '</div>';
        }
    };
    xhr.send();
});


function hashPassword(event, passwordFieldId) {
    event.preventDefault();
    const passwordField = document.getElementById(passwordFieldId);
    const hashedPassword = sha256(passwordField.value); // Use a SHA-256 hashing library
    passwordField.value = hashedPassword;
    event.target.submit();
}

function encryptPassword(event, passwordFieldId) {
    event.preventDefault();
    const passwordField = document.getElementById(passwordFieldId);
    const encryptionKey = CryptoJS.enc.Utf8.parse('12345678901234567890123456789012'); // 16 символів
    const iv = CryptoJS.enc.Utf8.parse('1234567891011121'); // 16 символів

    const encryptedPassword = CryptoJS.AES.encrypt(passwordField.value, encryptionKey, {
        iv: iv,
        mode: CryptoJS.mode.CBC
    }).toString();

    passwordField.value = encryptedPassword;
    event.target.submit();
}


function submit_reg_form(event, passwordFieldId, hashedFieldId, encryptedFieldId) {
    event.preventDefault();
    const passwordField = document.getElementById(passwordFieldId);
    const hashedField = document.getElementById(hashedFieldId);
    const encryptedField = document.getElementById(encryptedFieldId);

    hashedField.value = sha256(passwordField.value); // Use a SHA-256 hashing library

    encryptionKey = 'your_secret_key';
    const iv = '1234567891011121'; // Initialization vector (16 bytes)
    const encryptedPassword = CryptoJS
        .AES
        .encrypt(passwordField.value, CryptoJS.enc.Utf8.parse(encryptionKey), {
            iv: CryptoJS.enc.Utf8.parse(iv),
            mode: CryptoJS.mode.CTR,
            padding: CryptoJS.pad.NoPadding
        })
        .toString();
    encryptedField.value = encryptedPassword;

    event.target.submit();
}





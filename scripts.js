
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



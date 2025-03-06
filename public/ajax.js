
document.getElementById('load-time').innerText = new Date().toLocaleString();

document.getElementById('ajax-get-btn').addEventListener('click', () => {
  fetch('/ajax-get')
    .then(response => response.json())
    .then(data => {
      document.getElementById('ajax-get-response').innerText = data.message;
      document.getElementById('ajax-get-timestamp').innerText = data.timestamp;
    });
});

document.getElementById('ajax-post-form').addEventListener('submit', (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  fetch('/ajax-post', {
    method: 'POST',
    body: new URLSearchParams(formData)
  })
  .then(response => response.json())
  .then(data => {
    document.getElementById('ajax-post-response').innerText = data.message;
    document.getElementById('ajax-post-timestamp').innerText = data.timestamp;
  });
});



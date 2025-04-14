function performLoadTest() {
    const url = 'http://127.0.0.1:8000/server.php';

    function sendBatch() {
        for (let i = 0; i < 10; i++) {
            fetch(url)
                .then(response => console.log(`Request ${i + 1} completed with status:`, response.status))
                .catch(error => console.error(`Request ${i + 1} failed:`, error));
        }
    }

    // Send 100 requests and repeat indefinitely
    function repeatRequests() {
        sendBatch();
        setTimeout(repeatRequests, 100); // Immediately repeat after the batch
    }

    repeatRequests();
}

// Trigger the load test when the page loads
window.onload = performLoadTest;
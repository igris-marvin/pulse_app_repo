<!DOCTYPE html>
<html>
<head>
    <title>Live Update</title>
</head>
<body>
    <h1>Live Value Updates</h1>
    <h1 id="values">Loading...</h1>

    <script>
        var ws = new WebSocket('ws://localhost:8080');
        
        ws.onmessage = function(event) {
            document.getElementById('values').innerText = event.data;
        };

        ws.onopen = function() {
            console.log('WebSocket connection established');
        };

        ws.onerror = function(error) {
            console.log('WebSocket error: ' + error);
        };

        ws.onclose = function() {
            console.log('WebSocket connection closed');
        };
    </script>
</body>
</html>

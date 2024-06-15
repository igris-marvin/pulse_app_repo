const express = require('express');
const mysql = require('mysql2');
const WebSocket = require('ws');

const app = express();
const port = 3000;

// Create a MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '', // Add your password here
    database: 'testdb'
});

db.connect(err => {
    if (err) throw err;
    console.log('Connected to database');
});

// Serve static files from the public directory
app.use(express.static('public'));

// Start the server
const server = app.listen(port, '0.0.0.0', () => {
    console.log(`Server running at http://localhost:${port}/`);
});

// Set up WebSocket server
const wss = new WebSocket.Server({ server });

wss.on('connection', ws => {
    console.log('Client connected');

    // Send initial value
    sendValue(ws);

    // Set interval to send updated value every 5 seconds
    const intervalId = setInterval(() => {
        sendValue(ws);
    }, 5000);

    ws.on('close', () => {
        clearInterval(intervalId);
        console.log('Client disconnected');
    });
});

function sendValue(ws) {
    db.query('SELECT value FROM sample_table WHERE id = 1', (err, result) => {
        if (err) throw err;
        if (result.length > 0) {
            ws.send(result[0].value);
        } else {
            ws.send('No value found');
        }
    });
}

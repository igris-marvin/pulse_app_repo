const fs = require('fs');
const WebSocket = require('ws');
const chokidar = require('chokidar');

const wss = new WebSocket.Server({ port: 8080 });
const filePath = 'C:/xampp/htdocs/read_pulse_data/bmp.txt'; // Replace with the path to your file

wss.on('connection', ws => {
    console.log('Client connected');

    const sendFileContents = () => {
        fs.readFile(filePath, 'utf8', (err, data) => {
            if (err) {
                console.error('Error reading file:', err);
                return;
            }
            ws.send(data);
        });
    };

    // Initial send
    sendFileContents();

    // Watch the file for changes
    const watcher = chokidar.watch(filePath);
    watcher.on('change', sendFileContents);

    ws.on('close', () => {
        console.log('Client disconnected');
        watcher.close();
    });
});

console.log('WebSocket server running on ws://localhost:8080');
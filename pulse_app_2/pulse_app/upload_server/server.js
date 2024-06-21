const fs = require('fs');
const chokidar = require('chokidar');
const express = require('express');
const mysql = require('mysql2');
const config = require('./config');

const app = express();

// Database connection setup
const connection = mysql.createConnection(config.db);

connection.connect(err => {
  if (err) {
    console.error('Database connection error:', err.stack);
    return;
  }
  console.log('Connected to database');
});

// Network path to the file you want to watch
const networkFilePath = '\\\\MARVIN-IGRIS\\Users\\Public\\Documents\\bpm\\file.txt';

// Watcher setup function
const startFileWatcher = () => {
  const watcher = chokidar.watch(networkFilePath, {
    persistent: true,
  });

  watcher.on('change', (path) => {
    console.log(`File ${path} has been changed`);

    fs.readFile(path, 'utf8', (err, data) => {
      if (err) {
        console.error('Error reading file', err);
        return;
      }

      // Example query to insert or update file content into the database
      const query = 'INSERT INTO your_table (file_content) VALUES (?)';
      connection.query(query, [data], (error, results) => {
        if (error) {
          console.error('Error executing query', error.stack);
          return;
        }
        console.log('Data inserted with ID:', results.insertId);
      });
    });
  });

  watcher.on('error', error => console.error(`Watcher error: ${error}`));
};

// HTTP endpoint to start the watcher
app.get('/start-watching', (req, res) => {
  startFileWatcher();
  res.send('File watcher started');
});

// Start the Express server
const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Node.js server listening on port ${PORT}`);
});

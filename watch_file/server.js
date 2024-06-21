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
const networkFilePath = 'C:/Users/Public/Documents/bpm/bpm.txt';

// Watcher setup function
const startFileWatcher = (memberId) => {
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

      // Split file data into individual numbers
      const pulseRates = data.split('\n').map(line => line.trim()).filter(line => line !== '');

      if (pulseRates.length === 0) {
        console.log('No data to insert');
        return;
      }

      // Prepare and execute queries
      const queries = pulseRates.map(pulseRate => {
        return new Promise((resolve, reject) => {
          const query = `
            INSERT INTO pulse_data (pulse_rate, device_id)
            VALUES (?, (SELECT e.pulse_device_id FROM emotion_regulator_app e WHERE e.member_id = ?));
          `;
          connection.query(query, [pulseRate, memberId], (error, results) => {
            if (error) {
              reject(error);
              return;
            }
            resolve(results.insertId);
          });
        });
      });

      Promise.all(queries)
        .then(ids => {
          console.log('Data inserted with IDs:', ids);
        })
        .catch(error => {
          console.error('Error executing queries', error.stack);
        });
    });
  });

  watcher.on('error', error => console.error(`Watcher error: ${error}`));
};

// HTTP endpoint to start the watcher
app.get('/start-watching', (req, res) => {
  const memberId = req.query.memberId;
  if (!memberId) {
    res.status(400).send('Member ID is required');
    return;
  }
  startFileWatcher(memberId);
  res.send('File watcher started');
});

// Start the Express server
const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Node.js server listening on port ${PORT}`);
});

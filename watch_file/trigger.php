<?php
$nodeServerUrl = 'http://localhost:3000/start-watching'; // Replace with your Node.js server URL

// Build the URL with the member ID as a query parameter
$urlWithMemberId = $nodeServerUrl . '?memberId=' . urlencode($memberId);

// Use file_get_contents to send a request to the Node.js server
$response = file_get_contents($urlWithMemberId);

// Handle the response
if ($response === false) {
    echo 'Failed to trigger Node.js server';
} else {
    echo 'Node.js server triggered successfully';
}
?>

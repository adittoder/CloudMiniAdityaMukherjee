<?php
$servername = "your-cloud-db-server";
$username = "your-db-username";
$password = "your-db-password";
$dbname = "your-db-name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to save email campaign data
function saveCampaign($email, $campaign_name, $status) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO campaigns (email, campaign_name, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $campaign_name, $status);
    $stmt->execute();
    $stmt->close();
}
?>

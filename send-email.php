<?php
// Simple PHP mail handler with SendGrid or another service API.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $campaign_name = $_POST['campaign_name'];
    $email_content = $_POST['email_content'];

    // Validate inputs
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Example: Send email using SendGrid API (you can use Mailgun, SES, etc.)
        sendEmail($email, $campaign_name, $email_content);
        
        // Store campaign in the database (optional)
        // Save to MySQL or cloud DB here

        echo json_encode(['message' => 'Campaign sent successfully!']);
    } else {
        echo json_encode(['message' => 'Invalid email address']);
    }
}

function sendEmail($to, $campaign_name, $content) {
    // Example SendGrid API integration
    $apiKey = 'YOUR_SENDGRID_API_KEY';
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("noreply@yourdomain.com", "Email Marketing");
    $email->setSubject($campaign_name);
    $email->addTo($to);
    $email->addContent("text/html", $content);

    $sendgrid = new \SendGrid($apiKey);
    try {
        $response = $sendgrid->send($email);
        return $response;
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage();
    }
}
?>

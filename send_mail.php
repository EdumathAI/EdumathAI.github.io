<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['contact-email'];
    $subject = $_POST['contact-subject'];
    $message = $_POST['contact-message'];

    $to = "mronald.reagan@gmail.com";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "<html><body>";
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    $body .= "<p><strong>Sujet:</strong> " . htmlspecialchars($subject) . "</p>";
    $body .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
    $body .= "</body></html>";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Échec de l'envoi du message.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>

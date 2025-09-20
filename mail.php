<?php
$name = trim($_POST['contact-name']);
$phone = trim($_POST['contact-phone']);
$email = trim($_POST['contact-email']);
$issue = trim($_POST['contact-issue']); // dropdown
$subject = trim($_POST['contact-subject']);
$message = trim($_POST['contact-message']);

if ($name == "") {
    $msg['err'] = "\n Name cannot be empty!";
    $msg['field'] = "contact-name";
    $msg['code'] = FALSE;
} else if ($phone == "") {
    $msg['err'] = "\n Phone number cannot be empty!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if (!preg_match("/^[0-9 \\-\\+]{4,17}$/i", $phone)) {
    $msg['err'] = "\n Please enter a valid phone number!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if ($email == "") {
    $msg['err'] = "\n Email cannot be empty!";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg['err'] = "\n Please enter a valid email address!";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if ($issue == "") {
    $msg['err'] = "\n Please select an issue type!";
    $msg['field'] = "contact-issue";
    $msg['code'] = FALSE;
} else if ($subject == "") {
    $msg['err'] = "\n Subject cannot be empty!";
    $msg['field'] = "contact-subject";
    $msg['code'] = FALSE;
} else if ($message == "") {
    $msg['err'] = "\n Message cannot be empty!";
    $msg['field'] = "contact-message";
    $msg['code'] = FALSE;
} else {
    $to = 'support@softgem.org';
    $mail_subject = 'Softgem Contact Form: ' . $subject;
    
    $_message = '<html><head></head><body>';
    $_message .= '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>';
    $_message .= '<p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>';
    $_message .= '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
    $_message .= '<p><strong>Issue Type:</strong> ' . htmlspecialchars($issue) . '</p>';
    $_message .= '<p><strong>Subject:</strong> ' . htmlspecialchars($subject) . '</p>';
    $_message .= '<p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>';
    $_message .= '</body></html>';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Softgem <support@softgem.org>' . "\r\n";

    mail($to, $mail_subject, $_message, $headers, '-f support@softgem.org');

    $msg['success'] = "\n Your message has been sent successfully.";
    $msg['code'] = TRUE;
}
echo json_encode($msg);
?>

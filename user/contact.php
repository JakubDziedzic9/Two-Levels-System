<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../includes/language.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'pl'])) {
    setLanguage($_GET['lang']);
}

$currentLang = getLanguage();

require __DIR__ . '/../assets/PHPMailer-Master/src/PHPMailer.php';
require __DIR__ . '/../assets/PHPMailer-Master/src/SMTP.php';
require __DIR__ . '/../assets/PHPMailer-Master/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = translate('invalid_email');
    } else {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.yourmailserver.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'youremail@domain.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('recipient@domain.com');
            $mail->Subject = "New message from $name";
            $mail->isHTML(false);
            $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            $mail->send();
            $success = translate('message_sent');
        } catch (Exception $e) {
            $error = translate('email_error') . ": {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('contact'); ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include_once '../includes/header_user.php'; ?>

    <main>
        <div class="contact-container">
            <h1><?php echo translate('contact_us'); ?></h1>

            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <p class="success-message"><?php echo $success; ?></p>
            <?php endif; ?>

            <form action="contact.php" method="post" class="contact-form">
                <div class="form-group">
                    <label for="name"><?php echo translate('name'); ?>:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email"><?php echo translate('email'); ?>:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message"><?php echo translate('message'); ?>:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit"><?php echo translate('send'); ?></button>
                </div>
            </form>

            <div class="back-link">
                <a href="index.php"><?php echo translate('back_to_panel'); ?></a>
            </div>
        </div>
    </main>
</body>
</html>
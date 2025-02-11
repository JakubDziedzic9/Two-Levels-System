<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../includes/language.php';

if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'pl'])) {
    setLanguage($_GET['lang']);
}

$currentLang = getLanguage();
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('user_panel'); ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include_once '../includes/header_user.php'; ?>

    <main>
        <h1><?php echo translate('user_panel'); ?></h1>
        <p><?php echo translate('user_welcome'); ?></p>
    </main>
</body>
</html>
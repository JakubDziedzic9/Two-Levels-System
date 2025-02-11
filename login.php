<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth.php';
require_once 'includes/language.php';

if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'pl'])) {
    setLanguage($_GET['lang']);
}

$currentLang = getLanguage();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = connectDB();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: admin/index.php');
        } else {
            header('Location: user/index.php');
        }
        exit();
    } else {
        $error = translate('invalid_credentials');
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('login'); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="language-switcher dropdown">
                <select onchange="window.location.href=this.value">
                    <option value="?lang=en" <?php echo $currentLang === 'en' ? 'selected' : ''; ?>>English</option>
                    <option value="?lang=pl" <?php echo $currentLang === 'pl' ? 'selected' : ''; ?>>Polski</option>
                </select>
            </div>
        </nav>
    </header>

    <main>
        <div class="login-container">
            <h1><?php echo translate('login'); ?></h1>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="username" placeholder="<?php echo translate('username'); ?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="<?php echo translate('password'); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit"><?php echo translate('login'); ?></button>
                </div>
            </form>

            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="back-link">
                <a href="index.php"><?php echo translate('back_to_home'); ?></a>
            </div>
        </div>
    </main>
</body>
</html>
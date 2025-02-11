<?php
require_once '../includes/auth.php';
requireAdmin();
require_once '../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/ckeditor/ckeditor.js"></script>
</head>
<body>
    <?php include_once '../includes/header_admin.php'; ?>

    <main>
        <div class="content-container">
            <h1>Add New Content</h1>

            <form method="POST" class="content-form">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="body">Content:</label>
                    <textarea id="body" name="body" required></textarea>
                </div>

                <div class="form-group">
                    <label for="language">Language:</label>
                    <select id="language" name="language" required>
                        <option value="en">English</option>
                        <option value="pl">Polish</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit">Add Content</button>
                </div>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $body = $_POST['body'];
                $language = $_POST['language'];

                if (empty($title) || empty($body) || empty($language)) {
                    echo "<p class='error-message'>All fields are required!</p>";
                    exit;
                }

                $pdo = connectDB();
                $sql = "INSERT INTO content (title, body, language) VALUES (:title, :body, :language)";

                try {
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
                    $stmt->bindParam(':language', $language, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        echo "<p class='success-message'>Content has been successfully added!</p>";
                    } else {
                        echo "<p class='error-message'>Error adding content.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error-message'>Database error: " . $e->getMessage() . "</p>";
                }
            }
            ?>
        </div>
    </main>

    <script>
        window.onload = function () {
            if (typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace('body');
                console.log('CKEditor loaded successfully.');
            } else {
                console.error('CKEditor failed to load. Check the file path.');
            }
        };
    </script>
</body>
</html>
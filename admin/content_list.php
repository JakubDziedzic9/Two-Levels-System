<?php
require_once '../includes/auth.php';
requireAdmin();
require_once '../includes/db_connect.php';

$pdo = connectDB();
$stmt = $pdo->query('SELECT * FROM content ORDER BY created_at DESC');
$contentList = $stmt->fetchAll();

include_once '../includes/header_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <main>
        <div class="content-container">
            <h1>Content List</h1>

            <?php if (empty($contentList)): ?>
                <p class="info-message">No content available. <a href="content_add.php">Add new content</a>.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Preview</th>
                                <th>Language</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contentList as $content): ?>
                                <tr>
                                    <td><?= htmlspecialchars($content['id']) ?></td>
                                    <td><?= htmlspecialchars($content['title']) ?></td>
                                    <td class="content-preview"><?= substr(strip_tags($content['body']), 0, 100) ?>...</td>
                                    <td><?= htmlspecialchars($content['language']) ?></td>
                                    <td><?= htmlspecialchars($content['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
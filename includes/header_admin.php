<header>
    <nav>
        <div class="logo">
            <a href="../admin/index.php">Admin Panel</a>
        </div>
        <div class="nav-links">
            <a href="../admin/content_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) === 'content_list.php' ? 'active' : ''; ?>">Content List</a>
            <a href="../admin/content_add.php" class="<?php echo basename($_SERVER['PHP_SELF']) === 'content_add.php' ? 'active' : ''; ?>">Add Content</a>
            <a href="../admin/logout.php">Logout</a>
        </div>
    </nav>
</header>
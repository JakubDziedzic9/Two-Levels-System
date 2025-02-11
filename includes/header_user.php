<header>
    <nav>
        <div class="logo">
            <a href="../user/index.php"><?php echo translate('user_panel'); ?></a>
        </div>
        <div class="nav-links">
            <a href="../user/contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : ''; ?>">
                <?php echo translate('contact'); ?>
            </a>
            <a href="../admin/logout.php"><?php echo translate('logout'); ?></a>
            <div class="language-switcher">
                <select onchange="window.location.href=this.value">
                    <option value="?lang=en" <?php echo getLanguage() === 'en' ? 'selected' : ''; ?>>English</option>
                    <option value="?lang=pl" <?php echo getLanguage() === 'pl' ? 'selected' : ''; ?>>Polski</option>
                </select>
            </div>
        </div>
    </nav>
</header>
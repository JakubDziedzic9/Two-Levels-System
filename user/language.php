<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en'; 
}

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if (in_array($lang, ['en', 'pl'])) { 
        $_SESSION['lang'] = $lang;
    }
}

function getCurrentLanguage() {
    return $_SESSION['lang'];
}
?>
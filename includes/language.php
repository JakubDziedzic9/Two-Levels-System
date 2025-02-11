<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setLanguage($lang) {
    $_SESSION['lang'] = $lang;
}

function getLanguage() {
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
}

function translate($key) {
    $translations = [
        'en' => [
'welcome' => 'Welcome',
    'welcome_message' => 'This is the main page. Feel free to explore!',
    'home' => 'Home',
    'login' => 'Login',
    'logout' => 'Logout',
    'admin_panel' => 'Admin Panel',
    'user_panel' => 'User Panel',
    'user_welcome' => 'Welcome to the user panel!',
    'contact' => 'Contact Us',
    'back_to_home' => 'Back',
    'contact_us' => 'Contact Us',
    'name' => 'Name',
    'email' => 'Email',
    'message' => 'Message',
    'send' => 'Send',
    'back_to_panel' => 'Back to User Panel',
    'message_sent' => 'Your message has been sent successfully!',
    'invalid_email' => 'Invalid email address.',
    'email_error' => 'Error sending email',
    'username' => 'Username',
    'password' => 'Password',
    'invalid_credentials' => 'Invalid username or password'
        ],
        'pl' => [
    'welcome' => 'Witamy',
    'welcome_message' => 'To jest strona główna. Zapraszamy do eksploracji!',
    'home' => 'Strona główna',
    'login' => 'Zaloguj się',
    'logout' => 'Wyloguj',
    'admin_panel' => 'Panel administratora',
    'user_panel' => 'Panel użytkownika',
    'user_welcome' => 'Witamy w panelu użytkownika!',
    'contact' => 'Kontakt',
    'back_to_home' => 'Powrót',
    'contact_us' => 'Kontakt',
    'name' => 'Imię',
    'email' => 'Email',
    'message' => 'Wiadomość',
    'send' => 'Wyślij',
    'back_to_panel' => 'Powrót do Panelu Użytkownika',
    'message_sent' => 'Twoja wiadomość została wysłana pomyślnie!',
    'invalid_email' => 'Nieprawidłowy adres email.',
    'email_error' => 'Błąd wysyłania wiadomości',
    'username' => 'Nazwa użytkownika',
    'password' => 'Hasło',
    'invalid_credentials' => 'Nieprawidłowa nazwa użytkownika lub hasło'
        ]
    ];

    $lang = getLanguage();
    return $translations[$lang][$key] ?? $key;
}
?>
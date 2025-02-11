# Two-Levels-System
This application is a web-based system with two levels of access: **Administrator** and **User**. It is designed as a basic framework for managing content and user interactions. The application includes the following features:

1. **Separate Panels**:
   - **Administrator Panel**: For managing content and administrative tasks.
   - **User Panel**: For accessing content and interacting with the system.

2. **Content Management**:
   - Administrators can add content using a WYSIWYG editor (CKEditor).
   - Content is stored in a database and displayed in a list format.

3. **Contact Page**:
   - Users can send messages via a contact form.
   - Messages are sent to a specified email address using the PHPMailer library.

4. **Login System**:
   - Login functionality with redirection based on user roles (Administrator/User).
   - Session management for secure access.

5. **Multilingual Support**:
   - The system supports multiple languages (e.g., English and Polish).
   - Language selection is available for users.
   - 
Installation
1. **Clone the Repository**:
   - Clone the project into your local server directory (e.g., `htdocs` in XAMPP) using `git clone` or copy the files manually.

2. **Import the Database**:
   - Open your database management tool (e.g., phpMyAdmin).
   - Import the `project_db.sql` file into your database.
   - The database contains two tables:
     - **users**: Stores user credentials and roles.
     - **content**: Stores content added by administrators.

3. **Configure the Application**:
   - Update the database connection details in `includes/config.php`:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'project_db');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     ```

4. **Set Up Email Sending**:
   - Configure PHPMailer in `user/contact.php`:
     ```php
     $mail->isSMTP();
     $mail->Host = 'smtp.yourmailserver.com'; // SMTP server
     $mail->SMTPAuth = true;
     $mail->Username = 'youremail@domain.com'; // Your email
     $mail->Password = 'your-email-password'; // Email password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption
     $mail->Port = 587; // SMTP port
     ```
   - Ensure your email server supports these settings.

5. **Run the Application**:
   - Open your browser and navigate to `http://localhost/project_name`.
Features
1. Login
- The login page is located at `user/login.php`.
- After logging in:
  - Administrators are redirected to `admin/index.php`.
  - Users are redirected to `user/index.php`.
2. Administrator Panel
- **Add Content**: `admin/content_add.php`.
- **View Content**: `admin/content_list.php`.
- **Logout**: `admin/logout.php`.
3. User Panel
- **Contact Page**: `user/contact.php` (requires login).
- **Language Selection**: Users can switch between available languages.
Notes
- **Security**:
  - Passwords are stored in plain text in the database. This is not secure for production environments. Use password hashing (e.g., `password_hash()` and `password_verify()` in PHP) for better security.
  - Input validation and sanitization are implemented to prevent SQL injection and XSS attacks.

- **Customization**:
  - Add more languages by extending the `includes/language.php` file.
  - Enhance the application by adding features like content editing and deletion.

<?php
require_once 'config.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        try {
            $pdo = getDBConnection();
            
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && $password === $user['password']) {
                date_default_timezone_set('Asia/Manila');
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['login_time'] = date('F j, Y g:i A');
                header('Location: index.php');
                exit();
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $error = 'An error occurred. Please try again.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['reg_username']);
    $password = $_POST['reg_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields.';
    } elseif (strlen($username) < 3) {
        $error = 'Username must be at least 3 characters long.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        try {
            $pdo = getDBConnection();
            
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            
            if ($stmt->fetch()) {
                $error = 'Username already exists. Please choose another.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())");
                $stmt->execute([
                    'username' => $username,
                    'password' => $password
                ]);
                
                $success = 'Registration successful! Please login.';
            }
        } catch (PDOException $e) {
            $error = 'An error occurred during registration. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Resume Portfolio</title>
    <link rel="stylesheet" href="css/auth-style.css">
</head>
<body>
    <!-- Animated Wave Background -->
    <div class="wave-background"></div>
    
    <div class="auth-container">
        <div class="auth-box">
            <!-- Login Form -->
            <div class="form-container" id="loginForm">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Login to view the resume</p>
                
                <?php if ($error && isset($_POST['login'])): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
                
                <p class="switch-form">
                    Don't have an account? 
                    <a href="#" onclick="toggleForms(); return false;">Register here</a>
                </p>
            </div>
            
            <!-- Register Form -->
            <div class="form-container" id="registerForm" style="display: none;">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Register to get access</p>
                
                <?php if ($error && isset($_POST['register'])): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="reg_username">Username</label>
                        <input type="text" id="reg_username" name="reg_username" placeholder="Choose a username" required minlength="3">
                    </div>
                    
                    <div class="form-group">
                        <label for="reg_password">Password</label>
                        <input type="password" id="reg_password" name="reg_password" placeholder="Choose a password" required minlength="6">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                    
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>
                
                <p class="switch-form">
                    Already have an account? 
                    <a href="#" onclick="toggleForms(); return false;">Login here</a>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }
        
        <?php if ($error && isset($_POST['register'])): ?>
            toggleForms();
        <?php endif; ?>
    </script>
</body>
</html>
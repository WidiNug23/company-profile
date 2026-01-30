<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<!-- Feather Icons CDN -->
<script src="https://unpkg.com/feather-icons"></script>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #1a73e8, #4facfe);
    overflow: hidden;
}

.login-container {
    display: flex;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    max-width: 900px;
    width: 90%;
    min-height: 500px;
    animation: fadeInUp 1s ease forwards;
}

@keyframes fadeInUp {
    0% {opacity:0; transform: translateY(30px);}
    100% {opacity:1; transform: translateY(0);}
}

.login-left {
    flex: 1;
    padding: 50px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.welcome-text {
    font-size: 28px;
    font-weight: 700;
    color: #1a3c6b;
    margin-bottom: 10px;
}

.login-left h2 {
    font-size: 22px;
    color: #333;
    font-weight: 600;
    margin-bottom: 25px;
}

.login-left p {
    font-size: 14px;
    color: #555;
    margin-bottom: 30px;
}

.login-left input[type="email"] {
    width: 100%;
    padding: 14px 18px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 15px;
    background: #f9faff;
    transition: all 0.3s;
}

.login-left input:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 12px rgba(26,115,232,0.3);
    outline: none;
}

/* PASSWORD WRAPPER */
.password-wrapper {
    display: flex;
    align-items: center;
    position: relative;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 10px;
    background: #f9faff;
    margin-bottom: 20px;
    transition: border 0.3s, box-shadow 0.3s;
}

.password-wrapper:focus-within {
    border-color: #1a73e8;
    box-shadow: 0 0 12px rgba(26,115,232,0.3);
}

.password-wrapper input {
    flex: 1;
    padding: 14px 45px 14px 18px;
    border: none;
    font-size: 15px;
    border-radius: 10px;
    background: transparent;
    outline: none;
}

/* TOGGLE PASSWORD ICON */
.toggle-password {
    position: absolute;
    right: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
}

.toggle-password:hover {
    color: #1a73e8;
}

/* LOGIN BUTTON */
.login-left button {
    width: 100%;
    padding: 16px 0;
    background: linear-gradient(135deg, #1a73e8, #4facfe);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(26,115,232,0.3);
}

.login-left button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26,115,232,0.4);
}

/* ERROR ALERT */
.error-message {
    background: #ffeded;
    color: #d32f2f;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    border-left: 5px solid #ff4d4f;
    animation: fadeInAlert 0.6s ease;
}

@keyframes fadeInAlert {
    0% { opacity:0; transform:translateX(-20px); }
    100% { opacity:1; transform:translateX(0);}
}

/* RIGHT IMAGE */
.login-right {
    flex: 1;
    background: url('{{ asset("storage/pexels-jplenio-2128162.jpg") }}') no-repeat center center;
    background-size: cover;
    position: relative;
}

.login-right::after {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(26,115,232,0.35);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .login-container { flex-direction: column; min-height: auto; }
    .login-right { height: 200px; }
    .login-left { padding: 30px 20px; }
    .login-left h2 { font-size: 20px; margin-bottom: 20px; }
    .welcome-text { font-size: 24px; }
}
</style>
</head>
<body>

<div class="login-container">
    <div class="login-left">
        <div class="welcome-text">Selamat Datang, Admin!</div>
        <h2>Silakan login untuk melanjutkan</h2>
        <p>Masukkan email dan password Anda untuk mengakses dashboard.</p>

        <!-- ERROR ALERT -->
        @if ($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>

            <!-- PASSWORD FIELD -->
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()" data-feather="eye"></span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="login-right"></div>
</div>

<script>
feather.replace(); // Replace semua icon feather

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggle = document.querySelector('.toggle-password');

    if(passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggle.setAttribute('data-feather', 'eye-off');
    } else {
        passwordInput.type = 'password';
        toggle.setAttribute('data-feather', 'eye');
    }
    feather.replace(); // Update icon
}
</script>

</body>
</html>

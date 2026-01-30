<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Admin</title>
<!-- Feather Icons CDN -->
<script src="https://unpkg.com/feather-icons"></script>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #1a73e8, #2563eb);
    }

    .register-container {
        display: flex;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.2);
        overflow: hidden;
        max-width: 900px;
        width: 90%;
        min-height: 500px;
    }

    /* LEFT SIDE: FORM */
    .register-left {
        flex: 1;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .register-left h2 {
        color: #1a3c6b;
        font-size: 32px;
        margin-bottom: 30px;
        text-align: left;
    }

    .register-left input[type="text"],
    .register-left input[type="email"],
    .register-left input[type="password"],
    .select-wrapper select {
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    .register-left input:focus,
    .select-wrapper select:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 6px rgba(26,115,232,0.4);
        outline: none;
        background-color: #f9fbff;
    }

    /* PASSWORD WRAPPER */
    .password-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 20px;
    }

    .password-wrapper input {
        width: 100%;
        padding: 12px 40px 12px 16px; /* padding kanan untuk icon */
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        line-height: 1.4;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 12px;
        cursor: pointer;
        color: #888;
    }

    .toggle-password:hover {
        color: #1a73e8;
    }

    .register-left button {
        width: 100%;
        padding: 14px 0;
        background-color: #1a73e8;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    .register-left button:hover {
        background-color: #155ab6;
        transform: translateY(-2px);
    }

    .success-message { color: #22c55e; font-size: 14px; margin-bottom: 15px; text-align: left; }
    .error-message { color: #ff4d4f; font-size: 14px; margin-bottom: 15px; text-align: left; }

    /* RIGHT SIDE: IMAGE */
    .register-right {
        flex: 1;
        background: url('{{ asset("storage/pexels-jplenio-2128162.jpg") }}') no-repeat center center;
        background-size: cover;
    }

    /* STYLING ROLE DROPDOWN */
    .select-wrapper {
        width: 100%;
        margin-bottom: 20px;
        position: relative;
    }

    .select-wrapper::after {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #888;
        font-size: 12px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .register-container { flex-direction: column; min-height: auto; }
        .register-right { height: 200px; }
        .register-left { padding: 30px 20px; }
        .register-left h2 { font-size: 28px; margin-bottom: 20px; }
        .register-left input[type="text"],
        .register-left input[type="email"],
        .register-left input[type="password"],
        .select-wrapper select { font-size: 14px; padding: 10px 14px; }
        .register-left button { font-size: 14px; padding: 12px 0; }
    }
</style>
</head>
<body>

<div class="register-container">

    <!-- LEFT: FORM -->
    <div class="register-left">
        <h2>Daftar Admin Baru</h2>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.register.post') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>

            <!-- ROLE DROPDOWN -->
            <div class="select-wrapper">
                <select name="role_id" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}">
                            {{ ucfirst($role->role_name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" data-feather="eye" onclick="togglePassword('password', this)"></span>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="password-wrapper">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
                <span class="toggle-password" data-feather="eye" onclick="togglePassword('password_confirmation', this)"></span>
            </div>

            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- RIGHT: IMAGE -->
    <div class="register-right"></div>

</div>

<script>
feather.replace(); // Render feather icons

function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('data-feather', 'eye-off');
    } else {
        input.type = 'password';
        icon.setAttribute('data-feather', 'eye');
    }
    feather.replace(); // Update icon
}
</script>

</body>
</html>

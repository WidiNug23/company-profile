<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Pimpinan</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/feather-icons"></script>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e40af);
}
.login-container{
    background:#fff;
    width:420px;
    padding:40px;
    border-radius:18px;
    box-shadow:0 20px 60px rgba(0,0,0,.25);
}
h1{
    font-size:26px;
    font-weight:700;
    margin-bottom:10px;
    color:#1e293b;
}
p{
    font-size:14px;
    color:#64748b;
    margin-bottom:25px;
}
input{
    width:100%;
    padding:14px;
    margin-bottom:18px;
    border-radius:10px;
    border:1px solid #cbd5e1;
    background:#f8fafc;
}
.password-wrapper{
    position:relative;
}
.toggle-password{
    position:absolute;
    right:14px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#64748b;
}
button{
    width:100%;
    padding:15px;
    background:#1e40af;
    border:none;
    color:#fff;
    font-weight:700;
    border-radius:12px;
    cursor:pointer;
}
.error-message{
    background:#fee2e2;
    color:#b91c1c;
    padding:12px;
    border-radius:10px;
    margin-bottom:18px;
}
</style>
</head>
<body>

<div class="login-container">
    <h1>Dashboard Pimpinan</h1>
    <p>Silakan login untuk melihat monitoring website</p>

    @if($errors->any())
        <div class="error-message">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('pimpinan.login.post') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>

        <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()" data-feather="eye"></span>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script>
feather.replace();
function togglePassword(){
    const p=document.getElementById('password');
    p.type=p.type==='password'?'text':'password';
    feather.replace();
}
</script>
</body>
</html>

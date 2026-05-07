<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PKL SIJA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top left, rgba(0, 80, 150, 0.18), transparent 25%),
                        linear-gradient(180deg, #f7fbff 0%, #ebf2f8 100%);
            color: #102a43;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .form-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 40px 120px rgba(16, 42, 67, 0.14);
            border: 1px solid rgba(16, 42, 67, 0.08);
            overflow: hidden;
        }
        .form-card header {
            padding: 32px 28px 22px;
            background: linear-gradient(135deg, #003056 0%, #005a8c 100%);
            color: #ffffff;
        }
        .form-card header h1 {
            margin: 0 0 8px;
            font-size: 28px;
            line-height: 1.1;
        }
        .form-card header p {
            margin: 0;
            opacity: 0.88;
            font-size: 14px;
        }
        .form-body {
            padding: 30px 28px 28px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #102a43;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d5e1ef;
            border-radius: 16px;
            font-size: 14px;
            background: #f9fbff;
            color: #102a43;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #003056;
            box-shadow: 0 0 0 4px rgba(0, 80, 150, 0.12);
        }
        .form-error {
            margin-top: 8px;
            color: #dc3545;
            font-size: 13px;
        }
        .error-banner {
            padding: 16px 18px;
            border-radius: 18px;
            background: #fff5f5;
            border: 1px solid #f5c6cb;
            color: #721c24;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .login-btn {
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            border: none;
            background: #003056;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .login-btn:hover {
            background: #002845;
            transform: translateY(-1px);
        }
        .credentials {
            margin-top: 24px;
            padding: 18px 20px;
            border-radius: 20px;
            background: #f1f6ff;
            border: 1px solid #dbe9ff;
        }
        .credentials h4 {
            margin: 0 0 10px;
            font-size: 15px;
            color: #003056;
        }
        .credentials p {
            margin: 0 0 10px;
            line-height: 1.6;
            color: #102a43;
            font-size: 14px;
        }
        code {
            background: #e8f1ff;
            color: #0f4a8a;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="form-card">
        <header>
            <h1>Masuk ke Sistem PKL SIJA</h1>
            <p>Login dengan akun Admin atau Siswa untuk mengelola booking dan profil.</p>
        </header>
        <div class="form-body">
            @if ($errors->any())
                <div class="error-banner">
                    <strong>Login Gagal!</strong>
                    <div style="margin-top: 10px;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group @error('username') error @enderror">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('password') error @enderror">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="button-group">
                    <button type="submit" class="login-btn">Masuk</button>
                </div>
            </form>

            <div class="credentials">
                <h4>📌 Kredensial Akun</h4>
                <p><strong>Admin:</strong><br>
                Username: <code>gwadmin</code><br>
                Password: <code>acm</code></p>
                <p><strong>Siswa (Contoh):</strong><br>
                Username: <code>001</code><br>
                Password: <code>001</code></p>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Kue Kharisma</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5deb3 0%, #f4d4a8 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        .store-name {
            font-family: 'Brush Script MT', cursive;
            font-size: 42px;
            text-align: center;
            color: #2c2c2c;
            margin-bottom: 10px;
            font-style: italic;
        }

        .welcome-text {
            text-align: center;
            color: #4a4a4a;
            font-size: 14px;
            letter-spacing: 2px;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .form-card {
            background: #f5f5f0;
            border-radius: 20px;
            padding: 35px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #4a4a4a;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8b7355;
            font-size: 18px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8b7355;
            font-size: 20px;
            user-select: none;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #6b5845;
        }

        .toggle-password svg {
            width: 22px;
            height: 22px;
            stroke: #8b7355;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .toggle-password:hover svg {
            stroke: #6b5845;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: none;
            border-radius: 25px;
            background: #e8e4d0;
            color: #6b6b6b;
            font-size: 14px;
            outline: none;
        }

        .form-control::placeholder {
            color: #a89f8c;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b6b6b;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-password {
            color: #8b7355;
            text-decoration: none;
            border-bottom: 1px solid #8b7355;
        }

        .forgot-password:hover {
            color: #6b5845;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(135deg, #9d8b6f 0%, #8b7355 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #6b6b6b;
        }

        .register-link a {
            color: #8b7355;
            text-decoration: none;
            border-bottom: 1px solid #8b7355;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="store-name">Toko kue kharisma</h1>
        <p class="welcome-text">WELCOME BACK</p>

        <div class="form-card">
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <svg id="eyeIcon" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingatkan saya</span>
                    </label>
                    <a href="#" class="forgot-password">Lupa password</a>
                </div>

                <button type="submit" class="btn-login">Masuk</button>

                <p class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                `;
            }
        }
    </script>
</body>
</html>


<script>
    // Show message if redirected from checkout
    @if(session('message'))
        setTimeout(() => {
            alert("{{ session('message') }}");
        }, 500);
    @endif
</script>

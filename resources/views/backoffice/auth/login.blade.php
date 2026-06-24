{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Klinik Harapan Ibu dan Anak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

    <style>
        body {
            background: #e5e5e5;
        }

        .login-wrapper {
            min-height: 100vh;
            padding: 32px;
        }

        .login-card {
            width: 100%;
            min-height: 82vh;
            background: #ffffff;
            display: grid;
            grid-template-columns: 1fr 1.25fr;
            overflow: hidden;
        }

        .left-panel {
            position: relative;
            background-image: url("{{ asset('admin/assets/img/login-klinik.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 620px;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.30);
        }

        .brand {
            position: absolute;
            top: 48px;
            left: 48px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #0877e8;
            font-size: 24px;
            font-weight: 800;
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #0877e8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .quote-box {
            position: absolute;
            left: 70px;
            right: 70px;
            bottom: 54px;
            z-index: 2;
            padding: 38px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.70);
            backdrop-filter: blur(8px);
        }

        .quote-box h2 {
            color: #1f75cc;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .quote-box p {
            color: #5f6b7a;
            font-size: 16px;
            line-height: 1.7;
        }

        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .form-box {
            width: 100%;
            max-width: 430px;
        }

        .form-box h1 {
            color: #1f2937;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-box p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 42px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            display: block;
        }

        .input-group {
            position: relative;
            margin-bottom: 24px;
        }

        .input-group input {
            width: 100%;
            height: 54px;
            border-radius: 14px;
            border: none;
            background: #e8edf3;
            padding: 0 18px 0 52px;
            color: #1f2937;
            outline: none;
            font-size: 15px;
        }

        .input-group input:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.18);
            background: #f1f5f9;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7b8794;
        }

        .forgot {
            float: right;
            font-size: 13px;
            font-weight: 700;
            color: #0b67c2;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            height: 58px;
            border-radius: 18px;
            border: none;
            background: #2649bd;
            color: white;
            font-size: 17px;
            font-weight: 800;
            box-shadow: 0 8px 14px rgba(38, 73, 189, 0.25);
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            background: #1e3fa7;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 42px 0;
            color: #c4cbd5;
            font-weight: 700;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #e5e7eb;
        }

        .btn-register {
            width: 100%;
            height: 54px;
            border-radius: 18px;
            border: none;
            background: #86f285;
            color: #116b2a;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 14px rgba(34, 197, 94, 0.22);
        }

        .info-box {
            margin-top: 46px;
            padding: 18px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: #f1f5f9;
            border-radius: 16px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .footer {
            background: #eef2f7;
            padding: 24px 34px;
            display: flex;
            justify-content: space-between;
            color: #64748b;
            font-size: 14px;
        }

        .footer a {
            color: #64748b;
            margin-left: 28px;
            text-decoration: none;
        }

        @media (max-width: 1024px) {
            .login-card {
                grid-template-columns: 1fr;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                min-height: 80vh;
            }

            .footer {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .footer a {
                margin: 0 10px;
            }
        }
    </style>
</head>

<body>
    <main class="login-wrapper">
        <div class="login-card">

            <div class="left-panel">
                <div class="brand">
                    <div class="brand-icon">
                        ❤
                    </div>
                    <span>Klinik Harapan Ibu dan Anak</span>
                </div>

                <div class="quote-box">
                    <h2>Solusi Terpercaya untuk<br>Ibu dan Buah Hati.</h2>
                    <p>
                        Kami menghadirkan kenyamanan digital untuk memantau kesehatan
                        keluarga Bunda dalam satu sentuhan.
                    </p>
                </div>
            </div>

            <div class="right-panel">
                <div class="form-box">
                    <h1>Selamat Datang</h1>
                    <p>
                        Silakan masuk untuk mengakses rekam medis dan jadwal konsultasi Anda.
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-icon">✉</span>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus
                            >
                        </div>

                        <label class="form-label">
                            Password
                            <a href="#" class="forgot">Lupa Password?</a>
                        </label>
                        <div class="input-group">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                name="password" 
                                required
                            >
                        </div>

                        @if ($errors->any())
                            <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:12px;margin-bottom:18px;font-size:14px;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <button type="submit" class="btn-login">
                            Masuk ke Akun
                        </button>

                        <div class="divider">Atau</div>

                        <button type="button" class="btn-register">
                            👥 Daftar Baru
                        </button>

                        <div class="info-box">
                            <strong style="color:#0b67c2;">ℹ</strong>
                            <span>
                                Halaman ini digunakan pasien untuk masuk ke sistem klinik.
                                Keamanan data Anda adalah prioritas utama kami di Digital
                                Sanctuary for Maternal Care.
                            </span>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <footer class="footer">
            <div>© 2026 Klinik Harapan Ibu dan Anak. Digital Sanctuary for Maternal Care.</div>
            <div>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kontak Kami</a>
            </div>
        </footer>
    </main>
</body>
</html> --}}
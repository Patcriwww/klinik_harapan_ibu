<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pasien - Klinik Harapan Ibu dan Anak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
            color: #1f2937;
            overflow: hidden;
        }

        .register-page {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .register-content {
            flex: 1;
            display: grid;
            grid-template-columns: 44% 56%;
            height: calc(100vh - 58px);
            overflow: hidden;
        }

        .left-panel {
            position: relative;
            height: 100%;
            background-image: url("{{ asset('admin/assets/img/login-klinik.jpg') }}");
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.25);
        }

        .brand {
            position: absolute;
            top: 42px;
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
            width: 48px;
            height: 48px;
            border-radius: 18px;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.22);
        }

        .brand-icon svg {
            width: 25px;
            height: 25px;
        }

        .quote-box {
            position: absolute;
            left: 64px;
            right: 64px;
            bottom: 42px;
            z-index: 2;
            padding: 32px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.74);
            backdrop-filter: blur(8px);
        }

        .quote-box h2 {
            margin: 0 0 16px;
            color: #1f75cc;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
        }

        .quote-box p {
            margin: 0;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
        }

        .right-panel {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 60px;
            background: #ffffff;
        }

        .form-box {
            width: 100%;
            max-width: 430px;
            transform: scale(0.90);
            transform-origin: center;
        }

        .brand-title {
            color: #006fd6;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .form-box h1 {
            margin: 0 0 8px;
            color: #111827;
            font-size: 30px;
            font-weight: 800;
        }

        .form-box .subtitle {
            margin: 0 0 28px;
            color: #4b5563;
            font-size: 16px;
            line-height: 1.45;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #111827;
        }

        .input-group {
            position: relative;
            margin-bottom: 19px;
        }

        .input-group input {
            width: 100%;
            height: 52px;
            border: none;
            outline: none;
            border-radius: 15px;
            background: #e8edf3;
            padding: 0 18px;
            font-size: 15px;
            color: #111827;
            box-shadow: 0 5px 8px rgba(15, 23, 42, 0.15);
        }

        .input-group input:focus {
            background: #f1f5f9;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
        }

        .password-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .btn-register-submit {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 999px;
            background: #a7d8b8;
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 14px rgba(34, 197, 94, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 8px;
        }

        .btn-register-submit:hover {
            background: #8fcca5;
        }

        .terms-box {
            margin-top: 16px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #eef2f7;
            color: #475569;
            display: flex;
            gap: 12px;
            font-size: 12px;
            line-height: 1.45;
            box-shadow: 0 4px 8px rgba(15, 23, 42, 0.16);
        }

        .terms-box input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #2563eb;
        }

        .terms-box a {
            color: #006fd6;
            font-weight: 800;
            text-decoration: none;
        }

        .login-link {
            margin-top: 28px;
            text-align: center;
            color: #4b5563;
            font-size: 14px;
        }

        .login-link a {
            color: #006fd6;
            font-weight: 800;
            text-decoration: none;
        }

        .error-box {
            margin-bottom: 16px;
            padding: 13px 15px;
            border-radius: 14px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 13px;
            font-weight: 700;
        }

        .footer {
            height: 58px;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            color: #475569;
            font-size: 13px;
        }

        .footer a {
            color: #475569;
            text-decoration: none;
            margin-left: 28px;
        }

        @media (max-width: 1024px) {
            body { overflow: auto; }

            .register-page {
                height: auto;
                min-height: 100vh;
            }

            .register-content {
                grid-template-columns: 1fr;
                height: auto;
            }

            .left-panel { display: none; }

            .right-panel {
                min-height: calc(100vh - 58px);
                padding: 28px;
            }

            .form-box { transform: none; }

            .password-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .footer {
                height: auto;
                padding: 18px;
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .footer a {
                margin: 0 8px;
            }
        }
    </style>
</head>

<body>
<main class="register-page">
    <section class="register-content">

        <div class="left-panel">
            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 20s-6.5-3.9-8.7-8.1C1.7 8.8 3.4 5.5 6.7 5.2c1.8-.2 3.3.7 4.2 2 .9-1.3 2.4-2.2 4.2-2 3.3.3 5 3.6 3.4 6.7C18.5 16.1 12 20 12 20Z" fill="white"/>
                    </svg>
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
                <div class="brand-title">Klinik Harapan</div>
                <h1>Daftar Akun Baru</h1>
                <p class="subtitle">
                    Lengkapi data diri Teman Sehat untuk memulai pendaftaran.
                </p>

                @if ($errors->any())
                    <div class="error-box">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('pasien.register.store') }}" method="POST">
                    @csrf

                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap"
                               required>
                    </div>

                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Masukkan email"
                               required>
                    </div>

                    <label class="form-label">Nomor Handphone</label>
                    <div class="input-group">
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               placeholder="Masukkan nomor handphone">
                    </div>

                    <div class="password-row">
                        <div>
                            <label class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password"
                                       name="password"
                                       placeholder="Password"
                                       required>
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Konfirmasi</label>
                            <div class="input-group">
                                <input type="password"
                                       name="password_confirmation"
                                       placeholder="Konfirmasi"
                                       required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-register-submit">
                        Daftar Akun
                        <span>→</span>
                    </button>

                    <label class="terms-box">
                        <input type="checkbox" required>
                        <span>
                            Saya menyetujui
                            <a href="#">Syarat & Ketentuan</a>
                            serta
                            <a href="#">Kebijakan Privasi</a>
                            yang berlaku di Klinik Harapan.
                        </span>
                    </label>

                    <div class="login-link">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>

    </section>

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
</html>
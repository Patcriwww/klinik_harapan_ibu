<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Klinik Harapan Ibu dan Anak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

    <style>
      * {
          box-sizing: border-box;
      }
  
      body {
          margin: 0;
          min-height: 100vh;
          font-family: Arial, Helvetica, sans-serif;
          background: #ffffff;
          color: #1f2937;
          overflow: hidden;
      }
  
      .login-page {
          height: 100vh;
          display: flex;
          flex-direction: column;
      }
  
      .login-content {
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
          padding: 36px 60px;
          background: #ffffff;
      }
  
      .form-box {
          width: 100%;
          max-width: 430px;
          transform: scale(0.92);
          transform-origin: center;
      }
  
      .form-box h1 {
          margin: 0 0 10px;
          color: #111827;
          font-size: 30px;
          font-weight: 800;
      }
  
      .form-box .subtitle {
          margin: 0 0 34px;
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
  
      .label-row {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
  
      .forgot {
          color: #006fd6;
          font-size: 13px;
          font-weight: 800;
          text-decoration: none;
      }
  
      .input-group {
          position: relative;
          margin-bottom: 22px;
      }
  
      .input-group input {
          width: 100%;
          height: 52px;
          border: none;
          outline: none;
          border-radius: 15px;
          background: #e8edf3;
          padding: 0 18px 0 52px;
          font-size: 15px;
          color: #111827;
      }
  
      .input-group input:focus {
          background: #f1f5f9;
          box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
      }
  
      .input-icon {
          position: absolute;
          left: 18px;
          top: 50%;
          transform: translateY(-50%);
          color: #7b8794;
          display: flex;
          align-items: center;
      }
  
      .input-icon svg {
          width: 20px;
          height: 20px;
      }
  
      .btn-login {
          width: 100%;
          height: 54px;
          border: none;
          border-radius: 16px;
          background: #2649bd;
          color: #ffffff;
          font-size: 16px;
          font-weight: 800;
          cursor: pointer;
          box-shadow: 0 8px 14px rgba(38, 73, 189, 0.22);
      }
  
      .divider {
          display: flex;
          align-items: center;
          gap: 16px;
          margin: 34px 0;
          color: #c4cbd5;
          font-size: 13px;
          font-weight: 800;
      }
  
      .divider::before,
      .divider::after {
          content: "";
          flex: 1;
          height: 1px;
          background: #e5e7eb;
      }
  
      .btn-register {
          width: 100%;
          height: 52px;
          border: none;
          border-radius: 16px;
          background: #86f285;
          color: #116b2a;
          font-size: 15px;
          font-weight: 800;
          cursor: pointer;
          box-shadow: 0 8px 14px rgba(34, 197, 94, 0.18);
      }
  
      .info-box {
          margin-top: 38px;
          padding: 18px 20px;
          border-radius: 17px;
          background: #f1f5f9;
          color: #475569;
          display: flex;
          gap: 14px;
          font-size: 13px;
          line-height: 1.55;
      }
  
      .info-icon {
          color: #0877e8;
          display: flex;
          padding-top: 2px;
      }
  
      .info-icon svg {
          width: 18px;
          height: 18px;
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
          body {
              overflow: auto;
          }
  
          .login-page {
              height: auto;
              min-height: 100vh;
          }
  
          .login-content {
              grid-template-columns: 1fr;
              height: auto;
          }
  
          .left-panel {
              display: none;
          }
  
          .right-panel {
              min-height: calc(100vh - 58px);
              padding: 28px;
          }
  
          .form-box {
              transform: none;
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
    <main class="login-page">
        <section class="login-content">

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
                    <h1>Selamat Datang</h1>
                    <p class="subtitle">
                        Silakan masuk untuk mengakses rekam medis dan jadwal konsultasi Anda.
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label class="form-label">Email</label>
                        <div class="input-group">
                          <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6.5h16v11H4v-11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                          </span>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                        </div>

                        <div class="label-row">
                            <label class="form-label">Password</label>
                            <a href="#" class="forgot">Lupa Password?</a>
                        </div>

                        <div class="input-group">
                          <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M6 10h12v10H6V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </span>
                            <input
                                type="password"
                                name="password"
                                required
                            >
                        </div>

                        @if ($errors->any())
                            <div class="error-box">
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
                          <div class="info-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" fill="currentColor"/>
                                <path d="M12 10v7M12 7h.01" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                            <div>
                                Halaman ini digunakan pasien untuk masuk ke sistem klinik.
                                Keamanan data Anda adalah prioritas utama kami di Digital
                                Sanctuary for Maternal Care.
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>

        <footer class="footer">
            <div>© 2024 Klinik Harapan Ibu dan Anak. Digital Sanctuary for Maternal Care.</div>
            <div>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kontak Kami</a>
            </div>
        </footer>
    </main>
</body>
</html>
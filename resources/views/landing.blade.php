<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang — Aplikasi Pengelolaan Data Peserta Sertifikasi</title>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #2563eb;
            --dark-blue: #1e3a8a;
            --bg-gradient: linear-gradient(135deg, #1d4ed8 0%, #2563eb 60%, #3b82f6 100%);
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: var(--text-dark);
            overflow-x: hidden;
            margin: 0;
        }


        .navbar-custom {
            padding: 1.25rem 0;
            background: transparent;
        }

        .welcome-brand {
            font-weight: 800;
            font-size: 1.35rem;
            color: #ffffff;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .welcome-brand i {
            font-size: 1.5rem;
            color: #93c5fd;
        }

        .nav-link-custom {
            color: #e0e7ff !important;
            font-weight: 500;
            font-size: 0.95rem;
            margin-right: 1.5rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            color: #ffffff !important;
        }


        .hero-section {
            background: var(--bg-gradient);
            color: #ffffff;
            padding: 1rem 0 5rem 0;
            position: relative;
            border-bottom-left-radius: 32px;
            border-bottom-right-radius: 32px;
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .hero-wrapper {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding-top: 1.5rem;
            padding-bottom: 2rem;
        }

        .welcome-badge {
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.25rem;
            backdrop-filter: blur(8px);
        }

        .hero-title {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 1.25rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #e0e7ff;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-weight: 400;
        }


        .btn-white {
            background-color: #ffffff;
            color: var(--primary-blue);
            font-weight: 700;
            border-radius: 12px;
            padding: 0.85rem 2.25rem;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15);
            transition: all 0.25s ease;
            border: none;
            text-decoration: none;
        }

        .btn-white:hover {
            background-color: #f1f5f9;
            color: var(--dark-blue);
            box-shadow: 0 12px 24px -5px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: #ffffff;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.85rem 2rem;
            transition: all 0.25s ease;
            background: transparent;
            text-decoration: none;
        }

        .btn-outline-white:hover {
            background-color: rgba(255, 255, 255, 0.12);
            border-color: #ffffff;
            color: #ffffff;
        }


        .features-section {
            padding: 5rem 0;
            margin-top: -1rem;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 3.5rem auto;
        }

        .section-title {
            font-size: 2.1rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .section-desc {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
        }


        .feature-card {
            background: var(--card-bg);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 2.25rem;
            height: 100%;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .feature-card:hover {
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.08);
            border-color: #cbd5e1;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            background: #eff6ff;
            color: var(--primary-blue);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 0;
        }


        .welcome-footer {
            background-color: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 2rem 1rem;
            font-size: 0.9rem;
            border-top: 1px solid #1e293b;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.1rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .hero-section {
                border-radius: 0;
            }
        }
    </style>
</head>

<body>


    <header class="hero-section">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <a href="{{ route('login') }}" class="btn btn-outline-white btn-sm px-3 py-2 me-1">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-white btn-sm px-3 py-2">Daftar</a>
                    </div>
                </div>
            </nav>


            <div class="hero-wrapper">
                <div class="welcome-badge">
                    <i class="bi bi-stars"></i>
                    Sistem Informasi Sertifikasi
                </div>
                <h1 class="hero-title">Kelola Data Sertifikasi Lebih Cepat & Terstruktur!</h1>
                <p class="hero-subtitle">
                    Website buatan anak SMK yang mudah dipakai dan fleksibel!
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('login') }}" class="btn btn-white btn-lg">Masuk ke Aplikasi</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-white btn-lg">Buat Akun Baru</a>
                </div>
            </div>
        </div>
        <div></div>
    </header>


    <section id="fitur" class="features-section">
        <div class="container" style="max-width: 1100px;">
            <div class="section-header">
                <h2 class="section-title">Sekilas Tentang Aplikasi</h2>
                <p class="section-desc">
                    Dirancang dan dibuat untuk menggantikan pencatat manual yang lama dan ribet!
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-database-check"></i>
                        </div>
                        <h3>Manajemen Terpusat</h3>
                        <p>Seluruh data peserta dan skema sertifikasi tersimpan rapi dalam satu basis data yang terstruktur.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3>Pencarian Cepat</h3>
                        <p>Temukan data peserta secara instan berdasarkan nama atau NIK melalui fitur filter yang responsif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3>Multi Hak Akses</h3>
                        <p>Pembedaan peran yang jelas antara Admin (pengelola penuh) dan User (pelihat informasi).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="welcome-footer">
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

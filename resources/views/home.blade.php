<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Home</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #ffffff;
        }

        /* Hero Section - Split Layout */
        .hero-bg {
            background-color: #1b72e8;
            background-image: url('/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
            padding-top: 64px;
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            min-height: 600px;
            padding: 60px 40px;
            gap: 60px;
        }

        .hero-image-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .hero-image-side img {
            max-width: 85%;
            max-height: 500px;
            width: auto;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            object-fit: contain;
        }

        /* Placeholder untuk hero dengan emoji */
        .hero-image-placeholder {
            width: 100%;
            max-width: 450px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            color: rgba(255, 255, 255, 0.3);
            border: 3px dashed rgba(255, 255, 255, 0.3);
        }

        .hero-content-side {
            flex: 1;
            color: white;
            z-index: 2;
        }

        .hero-tag {
            font-size: 14px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .hero-search-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .hero-search-input {
            flex: 1;
            min-width: 250px;
            padding: 16px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: white;
            color: #202124;
        }

        .hero-search-input:focus {
            outline: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
        }

        .hero-search-select {
            padding: 16px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            background-color: #ffffff;
            color: #202124;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 200px;
        }

        .hero-search-select option {
            color: #202124;
        }

        .hero-search-select:focus {
            outline: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
        }

        .hero-btn-primary {
            background-color: #ffffff;
            color: #1b72e8;
            padding: 16px 24px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 18px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 60px;
        }

        .hero-btn-primary:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .hero-btn-secondary {
            background-color: transparent;
            color: #ffffff;
            padding: 16px 40px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: white;
            transform: translateY(-2px);
        }

        /* Navbar transparan tanpa background */
        .navbar-custom {
            background-color: transparent;
            backdrop-filter: none;
            box-shadow: none;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
        }

        .nav-link {
            color: #ffffff;
            transition: all 0.2s ease;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            background-color: transparent;
            border: 2px solid transparent;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-register {
            background-color: #ffffff;
            color: #1b72e8;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            border: 2px solid #ffffff;
        }

        .btn-register:hover {
            background-color: transparent;
            color: #ffffff;
            border-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .btn-login {
            background-color: #ffffff;
            color: #1b72e8;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            border: 2px solid #ffffff;
            margin-right: 12px;
        }

        .btn-login:hover {
            background-color: transparent;
            color: #ffffff;
            border-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .btn-reset {
            background-color: #ffffff;
            color: #1b72e8;
            padding: 14px 24px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid #ffffff;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            text-decoration: none;
            display: inline-block;
        }

        .btn-reset:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .section-title {
            font-size: 38px;
            font-weight: 700;
            color: #202124;
            margin-bottom: 40px;
            text-align: center;
        }

        .course-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(27, 114, 232, 0.2);
        }

        .course-image {
            height: 220px; 
            width: 100%;
            overflow: hidden;
            background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .course-image .placeholder-text {
            color: white;
            font-size: 72px;
            font-weight: bold;
        }

        .course-content {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .category-badge {
            display: inline-block;
            background-color: #e3f2fd;
            color: #1b72e8;
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            width: fit-content;
        }

        .course-title {
            font-size: 20px;
            font-weight: 700;
            color: #202124;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .course-description {
            font-size: 14px;
            color: #5f6368;
            margin-bottom: 16px;
            line-height: 1.6;
            flex: 1;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #5f6368;
            padding-bottom: 16px;
            border-bottom: 1px solid #e8eaed;
            margin-bottom: 16px;
        }

        .btn-detail {
            background-color: #1b72e8;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 6px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
            display: block;
        }

        .btn-detail:hover {
            background-color: #1557b0;
            box-shadow: 0 4px 12px rgba(27, 114, 232, 0.4);
            transform: translateY(-2px);
        }

        .content-section {
            padding: 60px 0;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: #ffffff;
            border-radius: 12px;
        }

        .empty-state-text {
            color: #5f6368;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .filter-active {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid #1b72e8;
        }

        .filter-info {
            color: #1b72e8;
            font-weight: 600;
        }

        footer {
            background-color: #1b72e8;
            color: #ffffff;
            padding: 40px 0;
            text-align: center;
            margin-top: 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        /* Grid untuk Kursus - 3 Kolom */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        @media (max-width: 1024px) {
            .courses-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-container {
                flex-direction: column;
                min-height: auto;
                padding: 40px 20px;
                gap: 40px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-image-side {
                order: 2;
            }

            .hero-content-side {
                order: 1;
            }

            .hero-image-side img {
                max-width: 90%;
                max-height: 400px;
            }
        }

        @media (max-width: 768px) {
            .courses-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-search-form {
                flex-direction: column;
            }
            
            .hero-search-input,
            .hero-search-select,
            .hero-btn-primary,
            .hero-btn-secondary,
            .btn-reset {
                width: 100%;
                min-width: 100%;
            }

            .hero-title {
                font-size: 28px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .section-title {
                font-size: 28px;
            }

            .hero-container {
                padding: 30px 20px;
            }

            .hero-image-side img {
                max-width: 100%;
                max-height: 350px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <nav class="navbar-custom">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-white"><strong>STUDIFY</strong></h1>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-login text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="btn-register text-sm font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - Split Layout -->
    <div class="hero-bg">
        <div class="hero-container">
            <!-- Left Side - Image -->
            <div class="hero-image-side">
                <!-- Ganti path ini dengan gambar Anda -->
                @if(file_exists(public_path('images/hero-img7.jpg')))
                    <img src="{{ asset('images/hero-img7.jpg') }}" alt="Students Learning">
                @else
                    <!-- Placeholder jika gambar belum ada -->
                    <div class="hero-image-placeholder">
                        📚
                    </div>
                @endif
            </div>

            <!-- Right Side - Content -->
            <div class="hero-content-side">
                <p class="hero-tag">Kursus Digital Terbaik & Terpercaya</p>
                <h2 class="hero-title">
                    Waktunya Upgrade Diri! Hanya di STUDIFY
                </h2>
                <p class="hero-subtitle">
                    Belajar Lebih Cepat, Lebih Menyenangkan. 
                    Bersama Studify, Temukan Superpower Akademikmu
                </p>

                <!-- Search Form dalam Hero -->
                <form method="GET" action="{{ route('home') }}" class="hero-search-form">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari kursus..." 
                        class="hero-search-input"
                    >
                    <select name="category" class="hero-search-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="hero-btn-primary" title="Cari">
                        🔍
                    </button>
                    @if(request('search') || request('category'))
                        <a href="{{ route('home') }}" class="btn-reset">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if(request('search') || request('category'))
    <div class="max-w-7xl mx-auto px-8 mt-6">
        <div class="filter-active">
            <div class="filter-info">
                <strong>Filter Aktif:</strong>
                @if(request('search'))
                    Pencarian: "{{ request('search') }}"
                @endif
                @if(request('category'))
                    @if(request('search')) | @endif
                    Kategori: "{{ $categories->find(request('category'))->name ?? '' }}"
                @endif
            </div>
            <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:underline font-semibold">Hapus Filter</a>
        </div>
    </div>
    @endif

    @if(!request('search') && !request('category') && $popularCourses->count() > 0)
    <div class="content-section" id="courses">
        <div class="max-w-7xl mx-auto px-8">
            <h3 class="section-title">Kursus Terpopuler</h3>
            <div class="courses-grid"> 
                @foreach($popularCourses as $course)
                <div class="course-card">
                    <div class="course-image">
                        <span class="placeholder-text">{{ strtoupper(substr($course->name, 0, 1)) }}</span>
                    </div>
                    <div class="course-content">
                        <span class="category-badge">
                            {{ $course->category->name }}
                        </span>
                        <h4 class="course-title">{{ $course->name }}</h4>
                        <p class="course-description">{{ Str::limit($course->description, 100) }}</p>
                        <div class="course-meta">
                            <span>👨‍🏫 {{ $course->teacher->name }}</span>
                            <span>👥 {{ $course->student_count }} siswa</span>
                        </div>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="content-section" style="background-color: #ffffff;">
        <div class="max-w-7xl mx-auto px-8">
            <h3 class="section-title">
                @if(request('search') || request('category'))
                    Hasil Pencarian
                @else
                    Semua Kursus
                @endif
            </h3>
            
            @if($courses->count() > 0)
            <div class="courses-grid">
                @foreach($courses as $course)
                <div class="course-card">
                    <div class="course-image">
                        <span class="placeholder-text">{{ strtoupper(substr($course->name, 0, 1)) }}</span>
                    </div>
                    <div class="course-content">
                        <span class="category-badge">
                            {{ $course->category->name }}
                        </span>
                        <h4 class="course-title">{{ $course->name }}</h4>
                        <p class="course-description">{{ Str::limit($course->description, 100) }}</p>
                        <div class="course-meta">
                            <span>👨‍🏫 {{ $course->teacher->name }}</span>
                            <span>👥 {{ $course->student_count }} siswa</span>
                        </div>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $courses->appends(request()->query())->links() }}
            </div>
            @else
            <div class="empty-state">
                <p class="empty-state-text">
                    @if(request('search') || request('category'))
                        Tidak ada kursus yang sesuai dengan pencarian Anda
                    @else
                        Tidak ada kursus yang tersedia saat ini
                    @endif
                </p>
                @if(request('search') || request('category'))
                    <a href="{{ route('home') }}" class="btn-detail" style="display: inline-block; margin-top: 16px;">
                        Lihat Semua Kursus
                    </a>
                @endif
            </div>
            @endif
        </div>
    </div>

   <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" class="text-white py-4 mt-auto">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</body>
</html>
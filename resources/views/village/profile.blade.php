@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ asset('assets/img/pages/profile-banner.png') }}') center/cover;
        opacity: 0.2;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
    }
    
    .stat-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        padding: 30px;
        text-align: center;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .stat-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }
    
    .umkm-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }
    
    .umkm-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .section {
        padding: 80px 0;
    }
    
    .section-alt {
        background-color: #f8f9fa;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #6c757d;
        text-align: center;
        margin-bottom: 50px;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
    }
    
    .smooth-scroll {
        scroll-behavior: smooth;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container-xxl">
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Desa Manud Jaya</h1>
                    <h2 class="h4 mb-4">Memberdayakan Ekonomi Desa Melalui Platform Digital</h2>
                    <p class="lead mb-4">
                        Platform e-dagang yang menghubungkan UMKM lokal Desa Manud Jaya dengan pasar luas, 
                        mengurangi lapisan distribusi, dan meningkatkan transparansi keuangan untuk 
                        kemandirian ekonomi desa.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('product.index') }}" class="btn btn-light btn-lg px-5">
                            <i class="ti ti-shopping-cart me-2"></i>Mulai Berbelanja
                        </a>
                        <a href="{{ route('umkm.register.show') }}" class="btn btn-outline-light btn-lg px-5">
                            <i class="ti ti-store me-2"></i>Daftar Sebagai UMKM
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/img/illustrations/girl-with-laptop.png') }}" 
                         alt="Platform E-Dagon" 
                         class="img-fluid"
                         style="max-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="section" id="tentang">
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-title text-start">Tentang Desa Manud Jaya</h2>
                <p class="lead">
                    Desa Manud Jaya adalah pilot project dari LSM Cipta Bumi Sentosa Abadi yang berfokus 
                    pada pemberdayaan masyarakat desa melalui teknologi informasi.
                </p>
                <p>
                    Sebagai desa yang memiliki potensi besar di sektor UMKM, pertanian, dan wisata, 
                    Desa Manud Jaya menghadapi tantangan seperti dampak pandemi dan akses pasar yang terbatas.
                </p>
                <p>
                    Platform e-dagon hadir sebagai solusi untuk menghubungkan produk UMKM dengan pasar 
                    yang lebih luas, terutama konsumen perkotaan, sekaligus memberikan visibilitas 
                    laporan keuangan yang transparan untuk UMKM.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/pages/profile-banner.png') }}" 
                     alt="Desa Manud Jaya" 
                     class="img-fluid rounded"
                     style="box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</div>

<!-- Impact Metrics Section -->
<div class="section section-alt" id="impact">
    <div class="container-xxl">
        <h2 class="section-title">Dampak Platform</h2>
        <p class="section-subtitle">
            Platform E-Dagon telah memberikan dampak positif bagi UMKM Desa Manud Jaya
        </p>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-primary">
                    <div class="card-body">
                        <div class="stat-icon text-primary">
                            <i class="ti ti-truck-delivery fs-large"></i>
                        </div>
                        <h3 class="fw-bold">40%</h3>
                        <p class="text-muted mb-0">Pengurangan Lapisan Distribusi</p>
                        <small class="text-muted">Produk dari petani sampai ke konsumen lebih efisien</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-success">
                    <div class="card-body">
                        <div class="stat-icon text-success">
                            <i class="ti ti-chart-line fs-large"></i>
                        </div>
                        <h3 class="fw-bold">100%</h3>
                        <p class="text-muted mb-0">Akurasi Laporan Keuangan</p>
                        <small class="text-muted">Transparansi penuh untuk UMKM</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-warning">
                    <div class="card-body">
                        <div class="stat-icon text-warning">
                            <i class="ti ti-trending-up fs-large"></i>
                        </div>
                        <h3 class="fw-bold">50%</h3>
                        <p class="text-muted mb-0">Peningkatan Omset</p>
                        <small class="text-muted">Dari UMKM yang tergabung</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon text-info">
                            <i class="ti ti-checklist fs-large"></i>
                        </div>
                        <h3 class="fw-bold">{{ number_format($stats['total_umkm'], 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">UMKM Tergabung</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon text-primary">
                            <i class="ti ti-package fs-large"></i>
                        </div>
                        <h3 class="fw-bold">{{ number_format($stats['total_products'], 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Produk Tersedia</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon text-success">
                            <i class="ti ti-shopping-cart fs-large"></i>
                        </div>
                        <h3 class="fw-bold">{{ number_format($totalOrders, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Transaksi Berhasil</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UMKM Members Section -->
<div class="section" id="umkm">
    <div class="container-xxl">
        <h2 class="section-title">UMKM Terdaftar</h2>
        <p class="section-subtitle">
            UMKM lokal Desa Manud Jaya yang telah bergabung dengan platform E-Dagon
        </p>
        
        @if($umkmMembers->count() > 0)
            <div class="row">
                @foreach($umkmMembers as $umkm)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card umkm-card">
                            @if($umkm->store_logo)
                                <img src="{{ asset('storage/' . $umkm->store_logo) }}" 
                                     class="card-img-top" 
                                     alt="{{ $umkm->store_name }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="ti ti-store fs-1 text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $umkm->store_name ?? $umkm->name }}</h5>
                                <p class="text-muted mb-2">
                                    <i class="ti ti-user me-1"></i>{{ $umkm->store_owner_name ?? $umkm->name }}
                                </p>
                                @if($umkm->umkm_category)
                                    <span class="badge bg-primary">
                                        {{ ucfirst($umkm->umkm_category) }}
                                    </span>
                                @endif
                                @if($umkm->city)
                                    <p class="text-muted small mt-2">
                                        <i class="ti ti-map-pin me-1"></i>{{ $umkm->city }}
                                    </p>
                                @endif
                                @if($umkm->store_description)
                                    <p class="card-text text-muted small mt-3">
                                        {{ Str::limit($umkm->store_description, 100) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                    <i class="ti ti-arrow-right me-2"></i>Lihat Semua Produk
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <i class="ti ti-store fs-1 text-muted mb-3"></i>
                <p class="text-muted">Belum ada UMKM yang terdaftar</p>
            </div>
        @endif
    </div>
</div>

<!-- Featured Products Section -->
<div class="section section-alt" id="produk">
    <div class="container-xxl">
        <h2 class="section-title">Produk Unggulan</h2>
        <p class="section-subtitle">
            Produk lokal berkualitas dari UMKM Desa Manud Jaya
        </p>
        
        @if($featuredProducts->count() > 0)
            <div class="row">
                @foreach($featuredProducts as $product)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                            <div class="card product-card h-100">
                                @if($product->hasImage())
                                    <img src="{{ $product->getThumbnailUrl() }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="ti ti-package fs-1 text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <span class="badge bg-success mb-2">Produk Lokal</span>
                                    <h6 class="card-title mb-2">{{ Str::limit($product->name, 40) }}</h6>
                                    <p class="card-text fw-bold text-primary mb-0">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="ti ti-eye me-2"></i>Lihat Semua Produk
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <i class="ti ti-package fs-1 text-muted mb-3"></i>
                <p class="text-muted">Belum ada produk yang tersedia</p>
            </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-5 fw-bold mb-4">Bergabunglah Bersama Kami!</h2>
                <p class="lead mb-4">
                    Dukung UMKM lokal Desa Manud Jaya dengan berbelanja produk berkualitas langsung dari petani dan pengrajin lokal. 
                    Setiap pembelian Anda mendukung kemandirian ekonomi desa.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-lg">
                        <i class="ti ti-shopping-cart me-2"></i>Mulai Berbelanja
                    </a>
                    <a href="{{ route('umkm.register.show') }}" class="btn btn-outline-light btn-lg">
                        <i class="ti ti-store me-2"></i>Daftar Sebagai UMKM
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="ti ti-store fs-1" style="font-size: 150px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Smooth scroll to sections when clicking navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add scroll animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all stat cards and product cards
    document.querySelectorAll('.stat-card, .umkm-card, .product-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>
@endpush


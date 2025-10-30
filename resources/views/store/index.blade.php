@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row align-items-end mb-3">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
            <h3 class="mb-2">Cari Toko UMKM</h3>
            <form method="get" action="{{ route('store.index') }}" class="row g-2">
                <div class="col-12 col-md-6">
                    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Nama toko / kategori / kota">
                </div>
                <div class="col-6 col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <select name="city" class="form-select">
                        <option value="">Semua Kota</option>
                        @foreach($cities as $c)
                            <option value="{{ $c }}" {{ $city === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-search me-1"></i>Cari</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-4 text-lg-end">
            <a href="{{ route('store.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </div>

    <div class="row">
        @forelse($merchants as $merchant)
            @php
                $logoUrl = $merchant->store_logo
                    ? (str_starts_with($merchant->store_logo, 'http') ? $merchant->store_logo : asset('storage/' . $merchant->store_logo))
                    : asset('images/shoplogo.png');
            @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <a href="{{ route('store.show', $merchant) }}" class="text-decoration-none text-reset">
                    <div class="card h-100">
                        <div class="card-body d-flex gap-3 align-items-center">
                            <img src="{{ $logoUrl }}" alt="{{ $merchant->store_name ?? $merchant->name }}" class="rounded" width="56" height="56" style="object-fit: cover;">
                            <div>
                                <div class="fw-semibold">{{ $merchant->store_name ?? $merchant->name }}</div>
                                <div class="text-muted small">{{ $merchant->city ?: '-' }}</div>
                                @if($merchant->is_verified)
                                    <span class="badge bg-success mt-1">Terverifikasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center text-muted py-5">Toko tidak ditemukan.</div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $merchants->links() }}
    </div>
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            @php
                $logoUrl = $merchant->store_logo
                    ? (str_starts_with($merchant->store_logo, 'http') ? $merchant->store_logo : asset('storage/' . $merchant->store_logo))
                    : asset('images/shoplogo.png');
            @endphp
            <img src="{{ $logoUrl }}" alt="{{ $merchant->store_name ?? $merchant->name }}" class="rounded" width="80" height="80" style="object-fit: cover;">
        </div>
        <div class="col">
            <h2 class="mb-1">{{ $merchant->store_name ?? $merchant->name }}</h2>
            <div class="text-muted">
                {{ $merchant->city ?: '-' }} • {{ ucfirst($merchant->umkm_category ?? 'umkm') }}
            </div>
            @if($merchant->is_verified)
                <span class="badge bg-success mt-2">Terverifikasi</span>
            @endif
        </div>
    </div>

    @if($merchant->store_description)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-2">Tentang Toko</h5>
                    <p class="mb-0">{{ $merchant->store_description }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Produk</h4>
            <span class="text-muted">{{ $products->count() }} item</span>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                @include('product.index._product', ['product' => $product])
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center text-muted py-5">Belum ada produk.</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection



@extends('layouts.app')

@push('styles')
<style>
    .stat-card {
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Merchant /</span> Dashboard</h4>

    <!-- Navigation Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-pills flex-column flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('merchant.profile') }}">
                        <i class="ti-xs ti ti-store me-1"></i> Store Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('merchant.dashboard') }}">
                        <i class="ti-xs ti ti-chart-line me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        <i class="ti-xs ti ti-package me-1"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        <i class="ti-xs ti ti-settings me-1"></i> Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Summary Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-currency-dollar text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pendapatan</span>
                    <h3 class="card-title mb-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-arrow-up"></i> Bulan ini
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-shopping-cart text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pesanan</span>
                    <h3 class="card-title mb-2">{{ number_format($totalOrders, 0, ',', '.') }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-arrow-up"></i> Aktif
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-package text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Produk</span>
                    <h3 class="card-title mb-2">{{ number_format($totalProducts, 0, ',', '.') }}</h3>
                    <small class="text-muted fw-semibold">
                        Tersedia
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-trending-up text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Konversi</span>
                    <h3 class="card-title mb-2">{{ $totalOrders > 0 ? number_format(($totalOrders / ($totalOrders + 100)) * 100, 1) : '0' }}%</h3>
                    <small class="text-success fw-semibold">
                        Rate bulan ini
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="ti ti-chart-line me-2"></i>Riwayat Transaksi (12 Bulan Terakhir)
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="monthSelector" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Periode
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="monthSelector">
                            <li><a class="dropdown-item" href="#" onclick="loadChartData('all', event)">12 Bulan Terakhir</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="transactionChart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Performance and Recent Orders -->
    <div class="row">
        <!-- Product Performance Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="ti ti-chart-bar me-2"></i>Performa Produk Teratas
                    </h5>
                </div>
                <div class="card-body">
                    <div id="productPerformanceChart"></div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="ti ti-shopping-bag me-2"></i>Pesanan Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentOrders as $order)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="mb-0">#{{ substr($order->number, 0, 8) }}...</h6>
                                        <span class="badge {{ $order->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                        <p class="mb-1">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</p>
                                    <small class="text-muted">Rp {{ number_format($order->order_total, 0, ',', '.') }}</small>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('order.index') }}" class="btn btn-outline-primary btn-sm">
                                Lihat Semua Pesanan
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="ti ti-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Belum ada pesanan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let transactionChart;
let productChart;

// Load transaction chart data
function loadTransactionChart() {
    fetch('{{ route("merchant.dashboard.transactions") }}')
        .then(response => response.json())
        .then(data => {
            const options = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true
                        }
                    }
                },
                colors: ['#696cff', '#71dd37'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.3,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [
                    {
                        name: 'Pendapatan (Rp)',
                        data: data.revenue
                    },
                    {
                        name: 'Jumlah Pesanan',
                        data: data.orders
                    }
                ],
                xaxis: {
                    categories: data.months,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };

            transactionChart = new ApexCharts(document.querySelector("#transactionChart"), options);
            transactionChart.render();
        })
        .catch(error => console.error('Error loading transaction data:', error));
}

// Load product performance chart data
function loadProductChart() {
    fetch('{{ route("merchant.dashboard.products") }}')
        .then(response => response.json())
        .then(data => {
            const options = {
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: true
                    }
                },
                colors: ['#696cff'],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 5,
                        dataLabels: {
                            position: 'right'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + ' unit';
                    }
                },
                series: [{
                    name: 'Jumlah Terjual',
                    data: data.quantities
                }],
                xaxis: {
                    categories: data.products,
                    labels: {
                        style: {
                            fontSize: '11px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val + ' unit';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' unit terjual';
                        }
                    }
                }
            };

            productChart = new ApexCharts(document.querySelector("#productPerformanceChart"), options);
            productChart.render();
        })
        .catch(error => console.error('Error loading product data:', error));
}

// Load both charts on page load
document.addEventListener('DOMContentLoaded', function() {
    loadTransactionChart();
    loadProductChart();
});
</script>
@endpush


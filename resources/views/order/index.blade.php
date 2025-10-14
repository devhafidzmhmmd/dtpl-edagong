@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('All Products') }}</a></li>
    <li class="breadcrumb-item">{{ __('Order History') }}</li>
@stop

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ __('Order History') }}</h1>
            <a href="{{ route('product.index') }}" class="btn btn-primary text-white">{{ __('Continue Shopping') }}</a>
        </div>
        <hr>

        @if($orders->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Order Number') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <strong>#{{ $order->number }}</strong>
                                                </td>
                                                <td>
                                                    {{ $order->created_at->format('d M Y') }}
                                                    <br>
                                                    <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusClass = match($order->status) {
                                                            'completed' => 'success',
                                                            'processing' => 'warning',
                                                            'cancelled' => 'danger',
                                                            default => 'secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge badge-{{ $statusClass }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong>{{ format_price($order->total()) }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                        {{ __('View Details') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ __('No Orders Found') }}</h4>
                            <p class="text-muted">{{ __('You haven\'t placed any orders yet.') }}</p>
                            <a href="{{ route('product.index') }}" class="btn btn-primary">
                                {{ __('Start Shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

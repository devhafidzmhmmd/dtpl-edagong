@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('All Products') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('Order History') }}</a></li>
    <li class="breadcrumb-item">{{ __('Order #') }}{{ $order->number }}</li>
@stop

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ __('Order #') }}{{ $order->number }}</h1>
            <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">{{ __('Back to Orders') }}</a>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Order Items') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->product->getThumbnailUrl() ?: '/images/product.jpg' }}" 
                                                         alt="{{ $item->name }}" 
                                                         class="rounded me-3" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div>
                                                        <strong>{{ $item->name }}</strong>
                                                        @if($item->product)
                                                            <br>
                                                            <small class="text-muted">
                                                                <a href="{{ route('product.show', $item->product->masterProduct ? $item->product->masterProduct->slug : $item->product->slug) }}">
                                                                    {{ __('View Product') }}
                                                                </a>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ format_price($item->price) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><strong>{{ format_price($item->total) }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Order Summary') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>{{ __('Order Number') }}:</strong>
                            </div>
                            <div class="col-6 text-end">
                                #{{ $order->number }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>{{ __('Order Date') }}:</strong>
                            </div>
                            <div class="col-6 text-end">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>{{ __('Status') }}:</strong>
                            </div>
                            <div class="col-6 text-end">
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
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>{{ __('Subtotal') }}:</strong>
                            </div>
                            <div class="col-6 text-end">
                                {{ format_price($order->items->sum('total')) }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>{{ __('Total') }}:</strong>
                            </div>
                            <div class="col-6 text-end">
                                <strong>{{ format_price($order->total()) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->billpayer)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Billing Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <strong>{{ $order->billpayer->getName() }}</strong><br>
                            @if($order->billpayer->email)
                                {{ $order->billpayer->email }}<br>
                            @endif
                            @if($order->billpayer->phone)
                                {{ $order->billpayer->phone }}<br>
                            @endif
                        </div>
                    </div>
                @endif

                @if($order->shippingAddress)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Shipping Address') }}</h5>
                        </div>
                        <div class="card-body">
                            <strong>{{ $order->shippingAddress->getName() }}</strong><br>
                            {{ $order->shippingAddress->getAddress() }}<br>
                            @if($order->shippingAddress->city)
                                {{ $order->shippingAddress->city }},
                            @endif
                            @if($order->shippingAddress->postalcode)
                                {{ $order->shippingAddress->postalcode }}<br>
                            @endif
                            @if($order->shippingAddress->country)
                                {{ $order->shippingAddress->country->name }}
                            @endif
                        </div>
                    </div>
                @endif

                @if($order->notes)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Order Notes') }}</h5>
                        </div>
                        <div class="card-body">
                            {{ $order->notes }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

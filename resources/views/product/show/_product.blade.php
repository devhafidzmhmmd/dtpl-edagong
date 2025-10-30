@php
    $product = App\Http\Helpers\ProductHelpers::overrideProduct($product);
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <?php $img = $product->hasImage() ? $product->getImageUrl('medium') : '/images/product-medium.jpg' ?>
            <img src="{{ $img  }}" id="product-image" />
        </div>

        <div class="thumbnail-container">
            @foreach($product->getMedia() as $media)
                <div class="thumbnail mr-1">
                    <img class="mw-100" src="{{ $media->getUrl('thumbnail') }}"
                         onclick="document.getElementById('product-image').setAttribute('src', '{{ $media->getUrl("medium") }}')"
                    />
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <div class="row pb-3">
            @if($product->discount)
                <span class="badge bg-danger mb-2">PROMOO!!</span>
                <hr>
            @endif
            <div class="col">
                <h2>{{ $product->name }}</h2>
            </div>
            <div class="col text-end">
                @if($product->discount)
                    <h4 class="text-primary"><del>{{ $product->price_display }}</del> <span>{{ $product->after_discount_display }}</span></h4>
                @else
                    <h4 class="text-primary">{{ $product->price_display }}</h4>
                @endif
            </div>
        </div>
        @unless(empty($product->propertyValues))
            <table class="table table-sm">
                <tbody>
                @foreach($product->propertyValues as $propertyValue)
                    <tr>
                        <th>{{ $propertyValue->property->name }}</th>
                        <td>{{ $propertyValue->title }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <hr>
        @endunless

        @unless(empty($product->description))
            <hr>
            <p class="text-secondary">{!!  nl2br($product->description) !!}</p>
            <hr>
        @endunless

        @php
            $merchant = $product->merchant ?? $product->user ?? null;
            $logo = $merchant && $merchant->store_logo
                ? (str_starts_with($merchant->store_logo, 'http') ? $merchant->store_logo : asset('storage/' . $merchant->store_logo))
                : asset('images/shoplogo.png');
        @endphp
        @if($merchant)
        <a href="{{ route('store.show', $merchant) }}" class="text-decoration-none text-reset">
            <div class="d-flex align-items-center gap-3 mb-3 py-2 border rounded bg-light" style="padding-left: 1rem;">
                <img src="{{ $logo }}"
                     alt="{{ $merchant->store_name ?? $merchant->name }}" class="rounded-circle" height="48" width="48" style="object-fit: cover;">
                <div>
                    <div class="fw-semibold">{{ $merchant->store_name ?? $merchant->name }}</div>
                    @if(method_exists($merchant, 'getFullNameAttribute') && $merchant->full_name)
                        <div class="text-muted small">{{ $merchant->full_name }}</div>
                    @endif
                    @if(method_exists($merchant, 'isUmkmSeller') && $merchant->isUmkmSeller())
                        <div class="badge bg-warning text-dark mt-1">UMKM Seller</div>
                    @endif
                </div>
            </div>
        </a>
        @endif

        @if (Auth::user() != null &&Auth::user()->type == 'client')
        <div class="row">
            <form action="{{ route('cart.add', $product) }}" method="post" class="mb-4">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success btn-lg" @if(!$product->price) disabled @endif>Add to cart</button>
            </form>
        </div>
        @endif
        </div>
    </div>
</div>
<article class="card shadow-sm">
    <a href="{{ route('product.show', $product->slug) }}">
        <img class="card-img-top"
        @if($product->hasImage())
            src="{{ $product->getThumbnailUrl() }}"
        @else
            src="/images/product.jpg"
        @endif
        alt="{{ $product->name }}" />
    </a>

    <div class="card-body">
        <h5><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h5>
        @php
            $price = $product->price;
            $discount = $price - ($price * 0.2);
        @endphp
        <p class="card-text"><del>{{ format_price($price) }}</del> <span>{{ format_price($discount) }}</span></p>
    </div>
</article>

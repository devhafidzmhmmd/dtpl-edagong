<article class="card shadow-sm position-relative">

    <div class="hot-deal-badge" style="
        position:absolute;
        top:12px;
        left:12px;
        z-index:2;
        padding:6px 12px 6px 12px;
        font-size:0.95rem;
        font-weight:600;
        color:#fff;
        background: linear-gradient(90deg, #ffd700 15%, #ff3838 55%, #ff9e00 100%);
        border-radius:20px;
        letter-spacing:0.5px;
        display:flex;
        align-items:center;
        gap:6px;
        animation: glitter-promo 1.2s infinite alternate;
    ">
        <span style="font-size:1.3em; margin-right: 3px;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" 
                xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;">
                <path d="M12 2C13.38 3.39 14 4.82 14 6.29c0 1.75-1.09 2.81-2 3.33-.91-.52-2-1.58-2-3.33C10 4.82 10.62 3.39 12 2z" fill="#ff7700"/>
                <path d="M12 2V20.08c-2.46-.2-4.84-2.78-4.84-5.58C7.16 11.88 10.09 10.92 12 8.5c1.9 2.42 4.83 3.38 4.83 6 0 2.8-2.38 5.38-4.83 5.58V2z" fill="#ff3838" />
            </svg>
        </span>
        <span class="glitter-text">PROMOO!!</span>
    </div>

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
        <h5>
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h5>
        @php
            $price = $product->price;
            $discount = $price - ($price * 0.2);
            $originalPrice = number_format($price, 0, ',', '.');
            $discountPrice = number_format($discount, 0, ',', '.');
        @endphp
        <p class="card-text"><del>Rp. {{ $originalPrice }}</del> <span>Rp. {{ $discountPrice }}</span></p>
    </div>
</article>

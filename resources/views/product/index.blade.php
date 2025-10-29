@extends('layouts.app')

@section('categories-menu')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesMenu" aria-controls="categoriesMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="categoriesMenu">
            <ul class="navbar-nav">
            @foreach($taxonomies as $taxonomy)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $taxonomy->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @include('product.index._category_level', ['taxons' => $taxonomy->rootLevelTaxons()])
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </nav>
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">All Products</a></li>
    @if($taxon)
        @include('product._breadcrumbs')
    @endif
@stop

@section('content')
<style>
    @keyframes glitter-promo {
        0% {
            box-shadow: 0 0 10px #ffe066cc;
            filter: brightness(1.1);
        }
        50% {
            box-shadow: 0 0 18px #ffd800cc;
            filter: brightness(1.2);
        }
        100% {
            box-shadow: 0 0 14px #ffe177;
            filter: brightness(1.1);
        }
    }
    .glitter-text {
        background: linear-gradient(90deg, #fff7b1 10%, #fff 24%, #fd6800 70%, #ffd482 100%);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        -webkit-text-stroke: 1.2px #ffbb008c;
        text-shadow:
            0 0 9px #ffd700,
            0 0 4px #ff3838,
            0 2px 6px #fff, 
            0 0 16px #ff9800b2;
        animation: glitter-textflicker 1.7s infinite linear;
        letter-spacing: 0.8px;
        font-weight: bold;
    }

    @keyframes glitter-textflicker {
        0%, 100%   { filter: brightness(1); text-shadow: 0 0 10px #fff1; }
        18%        { filter: brightness(1.3); text-shadow: 0 0 18px #ffd800a7; }
        40%        { filter: brightness(1.13); }
        60%        { filter: brightness(1.22); text-shadow: 0 0 26px #ffc40089; }
        85%        { filter: brightness(0.97); }
    }
    </style>
    <div class="container">
        @if($taxon && $taxon->hasImage())
            <div style="background-image: url('{{ $taxon->getImageUrl('header') }}'); height: 150px;"
                 class="mb-2">
                <h1 class="p-3 text-light" style="text-shadow: #333 0 0 11px">{{ $taxon->name }}</h1>
            </div>
        @endif
        <div class="row">

            <div class="col-md-3">
                @include('product.index._filters', ['properties' => $properties, 'filters' => $filters])
            </div>

            <div class="col-md-9">
                @if($taxon && $products->isEmpty() && $taxon->children->count())
                    <div class="card card-default mb-4">
                        <div class="card-header">{{ $taxon->name }} Subcategories</div>

                        <div class="card-body">
                            <div class="row">
                            @foreach($taxon->children as $child)
                                <div class="col-12 col-sm-6 col-md-4 mb-4">
                                    @include('product.index._category', ['taxon' => $child])
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(!$products->isEmpty())
                <div class="card card-default">
                    <div class="card-header">{{ $taxon ?  'Products in ' . $taxon->name : 'All Products' }}</div>

                    <div class="card-body">
                        <div class="row">

                            @foreach($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 mb-4 pt-3">
                                    @include('product.index._product')
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

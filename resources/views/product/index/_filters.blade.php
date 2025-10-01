<form class="card card-default mb-3" action="{{
    $taxon ?
    route('product.category', [$taxon->taxonomy->slug, $taxon])
    :
    route('product.index')
}}">
    <div class="card-header">Filters
        <button class="btn btn-sm btn-primary float-right pt-0 pb-0">Apply</button>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
        </div>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($properties as $property)
            @include('product.index._property', ['property' => $property, 'filters' => $filters[$property->slug] ?? []])
        @endforeach
    </ul>
</form>

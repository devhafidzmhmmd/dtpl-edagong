<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ProductHelpers;
use App\Http\Requests\ProductIndexRequest;
use Illuminate\Foundation\Auth\User;
use Vanilo\Category\Contracts\Taxon;
use Vanilo\Category\Models\TaxonomyProxy;
use Vanilo\Foundation\Models\Product;
use Vanilo\Foundation\Search\ProductSearch;
use Vanilo\Properties\Models\PropertyProxy;

class ProductController extends Controller
{
    private ProductSearch $productFinder;

    public function __construct(ProductSearch $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function index(ProductIndexRequest $request, string $taxonomyName = null, Taxon $taxon = null)
    {
        $taxonomies = TaxonomyProxy::get();
        $properties = PropertyProxy::get();

        if ($taxon) {
            $this->productFinder->withinTaxon($taxon);
        }

        foreach ($request->filters($properties) as $property => $values) {
            $this->productFinder->havingPropertyValuesByName($property, $values);
        }

        ## find by product name if parameter exists
        if ($name = $request->findByName('name')) {
            $this->productFinder->nameContains($name);
        }

        return view('product.index', [
            'products'   => $this->productFinder->getResults()->map(function ($product) {
                return ProductHelpers::overrideProduct($product);
            }),
            'taxonomies' => $taxonomies,
            'taxon'      => $taxon,
            'properties' => $properties,
            'filters'    => $request->filters($properties)
        ]);
    }

    public function show(string $slug)
    {
        if (!$product = $this->productFinder->findBySlug($slug)) {
            abort(404);
        }

        $product = ProductHelpers::overrideProduct($product);

        return view('product.show', [
            'product' => $product,
            'productType' => shorten($product::class),
        ]);
    }
}

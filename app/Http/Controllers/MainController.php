<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct(public Page $page, public Category $category, public Product $product, public Image $image) {}

    public function home()
    {
        $sectionName = 'home';
        $productsFromEachCategory = $this->product->getSomeFromEachCategory();
        $data = $this->page->getBySeoSlug(slug: 'home.index');

        return view('pages.home', compact('data',  'sectionName', 'productsFromEachCategory'));
    }

    public function about()
    {
        $sectionName = 'about';
        $data = $this->page->getBySeoSlug(slug: 'about.index');

        return view('pages.about', compact('data',  'sectionName'));
    }

    public function policies()
    {
        $sectionName = 'policies';
        $data = $this->page->getBySeoSlug(slug: 'policies.index');

        return view('pages.policies', compact('data',  'sectionName'));
    }

    public function category(Request $request, string $categorySlug)
    {
        $orderBy = "";
        if ($request->input('order_by') !== null) {
            if (in_array($request->input('order_by'), ['high_price', 'low_price', 'ascending_name', 'descending_name'])) {
                $orderBy = $request->input('order_by');
            }
        }

        $data = $this->category->getByCategorySlug(slug: $categorySlug);
        $products = $this->product->searchByCategoryId(categoryId: $data->id, orderBy: $orderBy);
        $sectionName = $categorySlug;

        return view('pages.category', compact('data', 'products', 'sectionName', 'orderBy'));
    }

    public function productDetail(string $category, string $productSlug)
    {
        $category = $this->category->getByCategorySlug(slug: $category);
        $data = $this->product->getDetailByCategoryIdAndSlug($category->id, $productSlug);
        $images = $this->image->getAllByProductId($data->id);
        $relatedProducts = $this->product->getRelatedById(id: $data->id, categoryId: $data->category_id, count: 10);
        $sectionName = "{$category}-{$productSlug}";

        return view('pages.product-detail', compact('category', 'data', 'images', 'sectionName', 'relatedProducts'));
    }

    public function search(Request $request, $search = null)
    {
        if ($request->filled('search')) {
            return redirect()->route('search.index', $request->string('search'));
        }

        if (!$search) {
            return redirect()->route('home.index');
        }

        $categoriesIds = $this->category->search($search);
        $products = $this->product->search($search, $categoriesIds);

        return view('pages.search', [
            'products' => $products,
            'search' => $search,
            'sectionName' => 'search',
        ]);
    }

    public function cartAndFavorites()
    {
        $name = Route::currentRouteName();
        $title = 'Favoritos';
        if ($name === 'cart.index') {
            $title = 'Cotización';
        }

        return view('pages.cart-favorites', compact('title', 'name'));
    }

    public function verifyItems(Request $request)
    {
        try {
            $products = $this->product->getAllByArrayIds($request->all());

            $products = $products->map(function ($item) {
                [$categoryName] = explode('/', $item->category->slug);
                $item->url = route('product.detail', [
                    'categorySlug' => $categoryName,
                    'productSlug' => $item->slug,
                ]);
                $item->img = asset('storage/' . $item->image);
                $item->final_price = $item->final_price;
                return $item->only(['id', 'name', 'image', 'price', 'discount', 'final_price', 'url']);
            });

            return response()->json([
                'status' => 200,
                'message' => "",
                'data' => $products->toArray()
            ]);
        } catch (RequestException $exception) {

            $response = json_decode($exception->response->getBody()->getContents());

            return response()->json([
                'status' => $response->statusCode,
                'message' => is_array($response->message) ? reset($response->message) : $response->message,
                'data' => []
            ], 422);
        }
    }

    public function cacheClear()
    {
        Cache::flush();
        return redirect()->route('filament.admin.pages.dashboard');
    }
}

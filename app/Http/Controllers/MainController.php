<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct(public Page $page) {}

    public function home()
    {
        $sectionName = 'home';
        $data = $this->page->getBySeoSlug(slug: 'home.index');

        return view('pages.home', compact('data',  'sectionName'));
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

        $sectionName = $categorySlug;

        return view('pages.category', compact('sectionName', 'orderBy'));
    }

    public function productDetail(string $category, string $productSlug)
    {
        $sectionName = "productDetail";
        return view('pages.product-detail', compact('sectionName'));
    }

    public function search(Request $request, $search = null)
    {
        if ($request->filled('search')) {
            return redirect()->route('search.index', $request->string('search'));
        }

        if (!$search) {
            return redirect()->route('home.index');
        }

        return view('pages.search', [
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
            return response()->json([
                'status' => 200,
                'message' => "",
                'data' => []
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

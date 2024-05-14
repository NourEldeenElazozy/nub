<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\color;
use App\Models\product;
use App\Models\productImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('sections', 'products.section', '=', 'sections.id')
            ->select('products.*', 'sections.name AS section_name');
        // تطبيق الترتيب
        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->sort === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('products.name', 'asc');
        }

        // تطبيق البحث
        if ($request->has('search')) {
            $query->where('products.name', 'like', '%' . $request->search . '%');
        }

        // تطبيق الترقيم
        $products = $query->paginate(10);

        return response()->json($products);
    }
    public function getSections()
{
    $sections = DB::table('sections')->get();

    return response()->json($sections);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();

        $colors = color::where('product', $product->id)->get();
        $image = productImage::where('product', $product->id)->get();
        return response()->json([
            'product' => $product,
            'colors' => $colors,
            'image' => $image
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

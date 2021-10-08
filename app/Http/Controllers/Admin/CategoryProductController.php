<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }


    public function categories($idProduct){
        $product = $this->product->find($idProduct);

        if(!$product)
            return redirect()->back();
        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact(['product', 'categories']));
    }

    public function categoriesAvaliable(Request $request, $idProduct){
        /** @var Product $product */
        $product = $this->product->find($idProduct);

        if(!$product)
            return redirect()->back();

        $filters = $request->except('_token');

        $categories = $product->categoriesAvaliable($request->filter);
        return view('admin.pages.products.categories.avaliable', compact(['product', 'categories', 'filters']));
    }

    public function attachCategoriesProduct(Request $request, $idProduct){
        /** @var Product $product */
        $product = $this->product->find($idProduct);

        if(!$product)
            return redirect()->back();

        if(!is_array($request->categories) || count($request->categories) < 1)
            return redirect()->back()->with('error', 'Escolha pelo menos uma validação');

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories.index', $idProduct);
    }

    public function detachCategoriesProduct($idProduct, $idCategory){
        /** @var Product $product */
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);
        if(!$product || !$category)
            return redirect()->back();

        $product->categories()->detach($category);
        return redirect()->route('products.categories.index', $idProduct);

    }

    public function products($idCategory){
        /** @var Category $category */
        $category = $this->category->find($idCategory);

        if(!$category)
            return redirect()->back();
        $products = $category->products()->paginate();

        return view('admin.pages.category.products.products', compact(['products', 'category']));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

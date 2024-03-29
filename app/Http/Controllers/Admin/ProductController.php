<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->middleware('can:Product');
        $this->repository = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();


        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("tentants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function show($idProduct)
    {
        $product = $this->repository->find($idProduct);

        if(!$product)
            return redirect()->back();

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($idProduct)
    {
        $product = $this->repository->find($idProduct);

        if(!$product)
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdateProduct  $request
     * @param  int  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $idProduct)
    {
        $product = $this->repository->find($idProduct);

        if(!$product)
            return redirect()->back();

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("tentants/{$tenant->uuid}/products");
        }
        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProduct)
    {
        $product = $this->repository->find($idProduct);

        if(!$product)
            return redirect()->back();

        if($product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request){

        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', compact([
            'products',
            'filters'
        ]));

    }
}

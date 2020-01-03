<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Http\Requests\Product\ProductAddRequest;
use App\Http\Requests\Product\ProductEditRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['images','category'])->get();

        return view('admin.product.index', compact('products'));
    }

    public function getProductID($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $product;
        } else {
            return redirect()->route('product.index')->with('error', trans('message.errorProduct'));
        }
    }

    public function getImageID($product_id) {
        $image = Image::where('product_id', $product_id)->first();
        if ($image) {

            return $image;
        } else {

            return redirect()->route('image.index')->with('error', trans('message.errorImage'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categoris'] = Category::all();

        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->status = $request->status;
        $products->description = $request->description;
        $products->category_id = $request->category;
        $products->save();


        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $images = new Image();
            $images->image = $filename;
            $images->product_id = $products->id;
            $request->images->storeAs('public/images', $filename);
            $images->save();
        }

        return redirect()->route('product.index')->with('success', trans('message.createSuccess'));
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
        $product = $this->getProductID($id);
        $categories = Category::all();
        $image = $product->images;

        return view('admin.product.edit', compact('product', 'categories', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductEditRequest $request, $id)
    {
        $products = $this->getProductID($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->status = $request->status;
        $products->description = $request->description;
        $products->category_id = $request->category;
        $products->save();
        $image = $this->getImageID($id);
        $image->product_id = $products->id;
        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $image->image = $filename;
            $request->images->storeAs('public/images', $filename);
        }
        $image->save();

        return redirect()->route('product.index')->with('success', trans('message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->getProductID($id);
        $product->delete();

        return response()->json(true);
    }
}

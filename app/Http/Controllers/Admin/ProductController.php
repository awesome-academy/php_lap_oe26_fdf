<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Product\ProductAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductEditRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $productRepository;
    private $categoryRepository;
    private $imageRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ImageRepositoryInterface $imageRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getWith(['images', 'category']);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categoris'] = $this->categoryRepository->getAll();

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
        $data = $request->only([
            'name',
            'price',
            'status',
            'description',
        ]);
        $data['category_id'] = $request->get('category');

        $product = $this->productRepository->create($data);

        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $data = [
                'image' => $filename,
                'product_id' => $product->id,
            ];
            $request->images->storeAs('public/images', $filename);

            $this->imageRepository->create($data);
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
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->getAll();
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
        $data = $request->only([
            'name',
            'price',
            'status',
            'description',
        ]);
        $data['category_id'] = $request->get('category');

        $product = $this->productRepository->update($data, $id);

        $image = $this->imageRepository->getImageID($id);
        $id_image = $image->id;
        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $data = [
                'image' => $filename,
                'product_id' => $product->id,
            ];
            $request->images->storeAs('public/images', $filename);
        }
        $this->imageRepository->update($data, $id_image);

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
        $product = $this->productRepository->delete($id);

        return response()->json(true);
    }
}

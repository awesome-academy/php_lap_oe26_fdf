<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Http\Requests\Image\ImageAddRequest;
use App\Http\Requests\Image\ImageEditRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::with('product')->get();

        return view('admin.image.index', compact('images'));
    }

    public function getImageID($id) {
        $image = Image::find($id);
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
        $data['products'] = Product::all();

        return view('admin.image.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageAddRequest $request)
    {
        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $images = new Image();
            $images->image = $filename;
            $images->product_id = $request->product;
            $request->images->storeAs('public/images', $filename);
            $images->save();
        }

        return redirect()->route('image.index')->with('success', trans('message.createSuccess'));
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
        $data['image'] = $this->getImageID($id);
        $data['products'] = Product::all();

        return view('admin.image.edit', $data);
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
        $image = $this->getImageID($id);
        $image->product_id = $request->product;
        if ($request->hasFile('images')) {
            $filename = $request->images->getClientOriginalName();
            $image->image = $filename;
            $request->images->storeAs('public/images', $filename);
        }
        $image->save();

        return redirect()->route('image.index')->with('success', trans('message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = $this->getImageID($id);
        $image->delete();

        return response()->json(true);
    }
}

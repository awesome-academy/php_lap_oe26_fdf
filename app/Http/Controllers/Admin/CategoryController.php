<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\CategoryAddRequest;
use App\Http\Requests\Category\CategoryEditRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = Category::all();

        return view('admin.category.index', $data);
    }

    public function getCategoryID($id)
    {
        $categories = Category::find($id);
        if ($categories) {
            return $categories;
        } else {
            return redirect()->route('category.index')->with('error', trans('message.errorCategory'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAddRequest $request)
    {
        $categories = new Category();
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->parent_id = $request->parent;
        $categories->save();

        return redirect()->route('category.index')->with('success', trans('message.createSuccess'));
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
        $data['category'] = $this->getCategoryID($id);

        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryEditRequest $request, $id)
    {
        $categories = $this->getCategoryID($id);
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->parent_id = $request->parent;
        $categories->save();

        return redirect()->route('category.index')->with('success', trans('message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = $this->getCategoryID($id);
        $categories->delete();

        return response()->json(true);
    }
}

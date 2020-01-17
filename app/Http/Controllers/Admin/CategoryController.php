<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAddRequest;
use App\Http\Requests\Category\CategoryEditRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $data['category'] = $this->categoryRepository->getAll();

        return view('admin.category.index', $data);
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
        $request = $request->only([
            'name',
            'description',
            'parent',
        ]);
        $categories = [
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent'],
        ];

        $this->categoryRepository->create($categories);

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
        $data['category'] = $this->categoryRepository->find($id);

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
        $request = $request->only([
            'name',
            'description',
            'parent',
        ]);
        $categories = [
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent'],
        ];

        $this->categoryRepository->update($categories, $id);

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
        $categories = $this->categoryRepository->delete($id);

        return response()->json(true);
    }
}

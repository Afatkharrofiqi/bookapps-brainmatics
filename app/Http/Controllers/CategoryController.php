<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryStoreException;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct(private CategoryInterface $categoryInterface)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::latest()->paginate(10)
        ];
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Gate::allows('create-category'), 403, 'Anda tidak memiliki hak akses!');

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $this->categoryInterface->store($request->all());
            return redirect()
                ->route('category.index')
                ->with('message-success', 'Category created successfully');
        } catch (\App\Exceptions\CategoryStoreException $e) {
            return redirect()
                ->route('category.index')
                ->with('message-fail', 'Category create fail. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(!Gate::allows('edit-category'), 403, 'Anda tidak memiliki hak akses!');
        // $data = [
        //     'category' => $category
        // ];
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $this->categoryInterface->update($request->all(), $category);
            return redirect()
                ->route('category.index')
                ->with('message-success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('category.index')
                ->with('message-fail', 'Category update failure. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!Gate::allows('delete-category'), 403, 'Anda tidak memiliki hak akses!');

        try {
            $this->categoryInterface->delete($category);
            return redirect()
                ->route('category.index')
                ->with('message-success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('category.index')
                ->with('message-fail', 'Category update failure. ' . $e->getMessage());
        }
    }

    public function getSelect2()
    {
        return Category::all();
    }
}

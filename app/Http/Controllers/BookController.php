<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['createdBy:id,name', 'updatedBy:id,name', 'categories'])
                        ->latest()
                        ->paginate(10);
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $book = new Book();
            $book->title = $request->title;
            $book->cover = $request->file('cover')->store('book-cover', 'public');
            $book->year = $request->year;
            $book->created_by = auth()->user()->id;
            $book->save();

            $book->categories()->attach($request->categories);
            DB::commit();
            return redirect()->route('book.index')->with('message-success', 'Book created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('book.index')->with('message-fail', 'Book create failure .'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::pluck('name', 'id');
        return view('book.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        DB::beginTransaction();
        try {
            $book->title = $request->title;
            if ($request->file('cover')) {
                if ($book->cover) {
                    Storage::delete('public/'.$book->cover);
                }
                $book->cover = $request->file('cover')->store('book-cover', 'public');
            }
            $book->year = $request->year;
            $book->updated_by = auth()->user()->id;
            $book->save();

            $book->categories()->sync($request->categories);

            DB::commit();
            return redirect()->route('book.index')->with('message-success', 'Book update successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('book.index')->with('message-fail', 'Book update failure .'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}

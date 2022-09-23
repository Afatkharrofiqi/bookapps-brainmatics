<?php

namespace App\Services;

use App\Exceptions\CategoryStoreException;
use App\Models\Book;
use App\Services\Interfaces\BookInterface;
use Illuminate\Support\Facades\DB;

class BookService implements BookInterface
{

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $book = new Book();
            $book->title = $data['title'];
            $book->cover = $data['cover']->file('cover')->store('book-cover', 'public');
            $book->year = $data['year'];
            $book->created_by = auth()->user()->id;
            $book->save();

            $book->categories()->attach($data['categories']);
            DB::commit();
            return redirect()->route('book.index')->with('message-success', 'Book created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('book.index')->with('message-fail', 'Book create failure .' . $e->getMessage());
        }
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}

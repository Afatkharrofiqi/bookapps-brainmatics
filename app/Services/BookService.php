<?php

namespace App\Services;

use App\Exceptions\CategoryStoreException;
use App\Models\Book;
use App\Services\Interfaces\BookInterface;

class BookService implements BookInterface {

    public function store(array $data)
    {
        try {
            $category = new Book;
            $category->name = $data['name'];
            $category->save();

            return $category;
        } catch (\Exception $th) {
            throw new CategoryStoreException($th->getMessage());
        }
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}

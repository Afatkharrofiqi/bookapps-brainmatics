<?php

namespace App\Services;

use App\Exceptions\CategoryStoreException;
use App\Models\Category;
use App\Services\Interfaces\CategoryInterface;

class CategoryService implements CategoryInterface {

    public function store(array $data)
    {
        try {
            $category = new Category();
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

    public function delete($category)
    {
        try {
            $category->delete();

        } catch (\Exception $th) {
            throw new CategoryStoreException($th->getMessage());
        }
    }
}

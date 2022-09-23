<?php

namespace App\Services\Interfaces;

use App\Models\Category;

interface CategoryInterface
{
    public function store(array $data);
    public function update(array $data, Category $category);
    public function delete($category);
}

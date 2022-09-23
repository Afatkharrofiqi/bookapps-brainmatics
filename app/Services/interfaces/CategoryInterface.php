<?php

namespace App\Services\Interfaces;

interface CategoryInterface {
    public function store(array $data);
    public function update($id);
    public function delete($category);
}

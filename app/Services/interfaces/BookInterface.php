<?php

namespace App\Services\Interfaces;

interface BookInterface {
    public function store(array $data);
    public function update($id);
    public function delete($id);
}

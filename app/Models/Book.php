<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id')->withDefault([
            'name' => '-'
        ]);
    }

    public function categories() {
        return $this->belongsToMany(
            Category::class, 'book_category', 'book_id', 'category_id');
    }
}

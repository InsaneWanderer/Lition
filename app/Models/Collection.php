<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable =[
        'slug',
        'name',
        'cover_path'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'collection_books');
    }
}

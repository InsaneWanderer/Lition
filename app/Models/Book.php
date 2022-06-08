<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_books');
    }

    public function files()
    {
        return $this->belongsTo(File::class);
    }
}

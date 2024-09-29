<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating'];

    #each review belongs to at least one book, review cannot exist without book

    public function book(){
        return $this->belongsTo(Book::class);
    }
}

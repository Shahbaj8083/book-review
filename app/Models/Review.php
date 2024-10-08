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

    #This event will not run when we mass assign the data using update method
    protected static function booted()
    {
        static::updated(fn(Review $review) => cache()->forget('book:'.$review->book_id));
        static::deleted(fn(Review $review) => cache()->forget('book:'.$review->book_id));
    }
}

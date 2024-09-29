<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    #book is parent of review table, one book can have multiple reviews
    protected $fillable = ['title', 'author'];

    public function review(){
       return $this->hasMany(Review::class);
    }
}

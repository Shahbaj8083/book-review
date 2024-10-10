<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Apply the throttle middleware to the store method to limit request frequency,
     * preventing multiple reviews at a time.
     */
    public function __construct()
    {
        $this->middleware('throttle:review')->only('store');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'review' => 'required|min:15',
            'rating' => 'required|min:1|max:5|integer'
        ]);
        $book->review()->create($data);
        return redirect()->route('book.show', $book);
    }
}

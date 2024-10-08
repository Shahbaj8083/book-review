<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', ''); #if filter variable is not there assign '' empty

        #when is used to first check if the data exist
        #if data exists anynomous function will be called
        //    $book = Book::when($title , function($query, $title){
        //      return $query->title($title);
        //    })->get();
        // this above function can also be written as arrow function
        $books = Book::when(
            $title,
            fn($query, $title) =>
            $query->title($title)
        );
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()
        };

        #we need unique cache key
        $cacheKey = 'books:' . $filter . ':' . $title;
        // $books = $books->get();
        $books = cache()->remember(
            $cacheKey,/*It will store the data inside books key */
            3600/*store in cache for 1 hr*/,
            fn() => $books->get()
        );

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $cacheKey = 'book:' . $book->id;
        $book = cache()->remember($cacheKey, 3600, fn() => $book->load(['review' => fn($query) => $query->latest()]));
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

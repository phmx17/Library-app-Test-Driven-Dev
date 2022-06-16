<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
  public function store(Request $request)
  {
    // $validated = request()->validate([ // this method does not require the injection of Request
    //   'title' => 'required',
    //   'author'
    // ]);

    $validated = $request->validate([ // requires injection
      'title' => 'required|max:255', // pipe | for multiple rules; works for nullable if entered for col in migration
      'author' => 'required', // every field is required; empty '' for no rule
    ]);

    Book::create($validated);
  }
}

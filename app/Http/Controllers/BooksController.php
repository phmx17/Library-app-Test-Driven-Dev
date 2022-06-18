<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
  public function store(Request $request)
  {
    // $validated = request()->validate([ // this 'helper' method does not require the injection of Request
    //   'title' => 'required',
    //   'author'
    // ]);
    // $validated = $this->validateRequest(); // no need to pass $request

    $book = Book::create($this->validateRequest()); // refactor by inlining the above process
    return redirect('/books/' . $book->id);
  }

  public function update(Request $request, Book $book)
  {
    // $validated = $this->validateRequest(); // no need to pass $request; refactor by inlining below

    // using an instance of book that got passed with route-model-binding instead of using the id and ->where()
    $book->update($this->validateRequest()); // modern method
    // Book::where('id', $book->id)->update($validated); // traditional method
    return redirect('/books/' . $book->id);
  }

  public function destroy(Book $book)
  {
    // $validated = $this->validateRequest(); // no need to pass $request; refactor by inlining below

    // using an instance of book that got passed with route-model-binding instead of using the id and ->where()
    $book->delete(); // modern method
    // Book::where('id', $book->id)->update($validated); // traditional method
    return redirect('/books');
  }


  /**
   * return @mixed
   */
  public function validateRequest()
  {
    return request()->validate([ // no injection, no passing of $request since using helper method request()
      'title' => 'required|max:255', // pipe | for multiple rules; works for nullable if entered for col in migration
      'author' => 'required', // every field is required; empty '' for no rule
    ]);
  }
}

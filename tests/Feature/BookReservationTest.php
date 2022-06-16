<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function a_book_can_be_added_to_the_library()
  {
    $this->withoutExceptionHandling(); // get the actual exception thrown without Laravel intervention: "404 not found"
    // instead we get: Symfony\Component\HttpKernel\Exception\NotFoundHttpException: POST http://localhost/books

    // hit a post route and generate a response object
    $response = $this->post('/books', [
      'title' => 'Cool Book Title',
      'author' => 'Slim Yelow'
    ]);
    $response->assertOk();
    $this->assertCount(1, Book::all());
  }
  /** @test */
  public function a_title_is_required()
  {
    // $this->withoutExceptionHandling();
    $response = $this->post('/books', [
      'title' => '',
      'author' => 'SY'
    ]);

    $response->assertSessionHasErrors(['title']);
  }
    /** @test */
    public function a_author_is_required()
    {
      // $this->withoutExceptionHandling();
      $response = $this->post('/books', [
        'title' => 'kewl book',
        'author' => ''
      ]);

      $response->assertSessionHasErrors(['author']);
    }

    /** @test */
    public function a_book_needs_to_be_updated()
    {
      $this->withoutExceptionHandling();
      $this->post('/books', [
        'title' => 'kewl book',
        'author' => 'Slim Yelow'
      ]);

      $book = Book::first();

      $this->patch('/books/' . $book->id,[
        'title' => 'patched title',
        'author' => 'patched author'
      ]);
      // check the DB for the update
      $this->assertEquals('patched title', Book::first()->title);
      $this->assertEquals('patched author', Book::first()->author);
    }


}

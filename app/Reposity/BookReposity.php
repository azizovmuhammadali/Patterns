<?php

namespace App\Reposity;

use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Reposity\BookReposityInterface;

class BookReposity implements BookReposityInterface
{
    /**
     * Create a new class instance.
     */
    use ResponseTrait;
   public function index(){
      $books = Book::with('author')->paginate(6);
      return $books;
   }
   public function create($data){
     $book = new Book();
   $book->user_id = $data['user_id'];
   $book->fill($data['translations']);
   $book->save();
   return $book->load('translations','author');
   }
   public function show($id){
   $book = Book::findOrFail($id);
   return $book->load('author','translations');
   }
   public function update($id, $data){
  $book = Book::findOrFail($id);
  $book->fill($data['translations']);
  $book->save();
  return $book->load('author','translations');
   }
   public function destroy($id){
      $book = Book::findOrFail($id);
    $book->delete();
    return $this->success(__('success.books.deleted'));
   }
}

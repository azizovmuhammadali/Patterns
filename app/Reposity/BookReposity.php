<?php

namespace App\Reposity;

use App\Models\Book;
use App\Services\AttachmentService;
use App\Traits\ResponseTrait;
use App\Events\AttachmentEvent;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Reposity\BookReposityInterface;

class BookReposity implements BookReposityInterface
{
   use ResponseTrait;
   public function __construct(protected AttachmentService $attachmentService)
   {
   }
   public function index()
   {
      $books = Book::with('author', 'images')->paginate(6);
      return $books;
   }
   public function create($data)
   {
      $book = new Book();
      $book->user_id = $data['user_id'];
      $book->fill($data['translations']);
      $book->save();
      // dd($data['images']);
      event(new AttachmentEvent($data['images'], $book->images()));
      // dd($book->images());
      return $book->load('translations', 'author');
   }
   public function show($id)
   {
      $book = Book::findOrFail($id);
      return $book->load('author', 'translations');
   }
   public function update($id, $data)
   {
      $book = Book::findOrFail($id);
      $book->fill($data['translations']);
      $book->save();
      if ($data['images']) {
         if ($book->images) {
            $this->attachmentService->destroy($book->images);
         }
         event(new AttachmentEvent($data['images'], $book->images()));
      }
      return $book->load('author', 'translations');
   }
   public function destroy($id)
   {
      $book = Book::findOrFail($id);
      $book->delete();
      return $this->success(__('success.books.deleted'));
   }
}

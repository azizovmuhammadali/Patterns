<?php

namespace App\Http\Controllers;

use App\DTO\BookDTO;
use App\Traits\ResponseTrait;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Interfaces\Services\BookServiceInterface;

class BookController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected BookServiceInterface $bookServiceInterface){}
    public function index()
    {
        $books = $this->bookServiceInterface->getAllBook();
        return $this->responsePagination($books,BookResource::collection($books),__('success.books.all'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $bookDto = new BookDTO(Auth::id(), $request->translations,$request->file('images'));
        $book = $this->bookServiceInterface->create($bookDto);
        return $this->success(new BookResource($book->load('translations','author','images')),__('success.books.created'),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookServiceInterface->getBookById($id);
        return $this->success(new BookResource($book->load('author','translations','images')),__('success.books.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        $bookDTO = new BookDTO(Auth::id(), $request->translations,$request->file('images'));
        $book = $this->bookServiceInterface->update($id,$bookDTO);
        return $this->success(new BookResource($book->load('author','translations','images')),__('success.books.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->bookServiceInterface->delete($id);
        return $this->success([],__('success.books.deleted'),204);
    }
}

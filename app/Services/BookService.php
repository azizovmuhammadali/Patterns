<?php

namespace App\Services;
use App\Traits\ResponseTrait;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Reposity\BookReposityInterface;

class BookService implements BookServiceInterface
{
    /**
     * Create a new class instance.
     */
    use TranslationTrait;
    use ResponseTrait;
    public function __construct(protected BookReposityInterface $bookReposityInterface){}
  public function getAllBook()
{
    return $this->bookReposityInterface->index(); 
}
  public function create($bookDTO){
    $translations = $this->prepareTranslations(['translations' => $bookDTO->translations], ['title','description']);
        $data = [
            'user_id' => Auth::id(),
            'translations' => $translations,
            'images' => $bookDTO->images,
        ];
        return $this->bookReposityInterface->create($data);
  }
  public function getBookById($id){
    return $this->bookReposityInterface->show($id);
  }
  public function update($id,$bookDTO){
    if(Auth::id() !== $bookDTO->user_id){
      return $this->error(__('errors.books.forbidden'), 403);
  }
  $translations = $this->prepareTranslations(['translations' => $bookDTO->translations], ['title','description']);
  $data = [
    'user_id' => $bookDTO->user_id,
    'translations' => $translations,
    'images' => $bookDTO->images,
];
     return $this->bookReposityInterface->update($id, $data);
  }
public function delete($id){
  return $this->bookReposityInterface->destroy($id);
}
}

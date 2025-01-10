<?php

namespace App\Interfaces\Services;

interface BookServiceInterface
{
    public function getAllBook();
    public function create($bookDTO);
    public function getBookById($id);
     public function update($id, $bookDTO);
     public function delete($id);
}

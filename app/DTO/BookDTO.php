<?php

namespace App\DTO;

class BookDTO
{
    /**
     * Create a new class instance.
     */
    public $author_id;
    public $title;
    public $description;
    public function __construct($author_id,$title,$description)
    {
        $this->author_id = $author_id;
        $this->title = $title;
        $this->description = $description;
    }
}

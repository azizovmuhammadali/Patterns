<?php

namespace App\DTO;

class BookDTO
{
    /**
     * Create a new class instance.
     */
    public $user_id;
    
    public $translations;
    public  $images;
    public function __construct($user_id,$translations, $images)
    {
        $this->user_id = $user_id;
        $this->translations = $translations;
        $this->images = $images;
    }
}

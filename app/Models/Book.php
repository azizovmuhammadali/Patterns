<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Book extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $fillable = [
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

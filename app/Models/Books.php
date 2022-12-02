<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'book_name', 'book_desc', 'book', 'book_slug','category_id', 'book_status' 
    ];
    protected $primaryKey = 'id';
    protected $table = 'books';
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    } 
}

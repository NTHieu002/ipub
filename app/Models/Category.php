<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'category_name', 'category_slug', 'book_status' 
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'category';
    public function books() {
        return $this->hasMany(Books::class, 'category_id');
    }   
}

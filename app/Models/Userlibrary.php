<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlibrary extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'book_id', 'user_id'
    ];
    protected $primaryKey = 'userlibrary_id';
    protected $table = 'userlibrary';
    public function books() {
        return $this->hasMany(Books::class, 'id');
    }   
}

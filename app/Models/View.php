<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'book_id', 'book_views', 
    ];
    protected $primaryKey = 'book_view_id';
    protected $table = 'book_view';
}

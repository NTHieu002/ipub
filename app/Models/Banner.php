<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'image', 'role_id','banner_status','user_id'
    ];
    protected $primaryKey = 'image_id';
    protected $table = 'images';
}

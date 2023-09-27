<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['name','description','image','u_id'];

    public function commits(){
        return $this->hasMany(Commit::class);
    }
}

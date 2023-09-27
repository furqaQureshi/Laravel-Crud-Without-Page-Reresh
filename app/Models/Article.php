<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = "articles";

    protected $fillable = ['author_id','title','content','publication_date'];

    public function authors(){
        return $this->belongsTo(Author::class,'author_id');
    }   
}

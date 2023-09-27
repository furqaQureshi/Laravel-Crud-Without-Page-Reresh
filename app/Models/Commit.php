<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    use HasFactory;

    protected $table = "commits";
    protected $fillable = ['user_id','post_id','commit'];

    public function commit(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
}

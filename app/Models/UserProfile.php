<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = "user_profiles";


    protected $fillable = ['user_id','address','phone_number','profile_picture'];

   public function user(){
    return $this->belongsTo(User::class,'user_id','id');
   }
}

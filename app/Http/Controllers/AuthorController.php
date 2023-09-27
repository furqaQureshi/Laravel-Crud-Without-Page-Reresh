<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Task;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function authors(){
        // // $author = Article::find(1)->whereHas('authors', function($q){
        // //     $q->where('publication_date','>','2022-11-06 11:25:52');
        // // });

        // $user = UserProfile::find(3);
        // dd($user->user->name);
        // $task = Task::all();
        // return view('layouts.index',compact('task'));
    }
}

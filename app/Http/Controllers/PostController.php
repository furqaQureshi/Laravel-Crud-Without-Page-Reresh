<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
     public function index() {
            $post = Post::all();
            return view('layouts.post',compact('post'));
    }
    public function store(Request $request){
        $post = new Post();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $fileName = "image-" . time() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $fileName);
        
                $post->name = $request->name;
                $post->description = $request->description;
                $post->image = $fileName;
                $post->u_id = Auth::user()->id;
                $post->save();
                return redirect(url('post'))->with('success','Post Create SuccessFully');
            }  
        } 
    }
    public function post_commit(Request $request){
        $commit = new Commit();
        $commit->user_id = $request->user_id;
        $commit->post_id = $request->post_id;
        $commit->commit = $request->commit;
        $commit->save();
        return redirect(route('post_show'))->with('success','Commit SuccessFully Add');
    }
    public function get_commit($user){
        $posts = Post::whereHas('commits', function($query) use($user) {
            $query->whereUserId($user);
        })->get();
        // dd($posts);
        // $posts = Post::with('commits')
        // ->where('id',$id)->get(); 
        return response()->json(['posts'=>$posts]);
    }
}

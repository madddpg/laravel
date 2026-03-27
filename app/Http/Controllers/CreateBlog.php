<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateBlog extends Controller
{
    public function create(Request $request){
        $fields=$request->validate([
            'blog_title' => 'required',
            'body' => 'required'
        ]);

        $fields['blog_title'] = strip_tags($fields['blog_title']);
        $fields['body'] = strip_tags($fields['body']);
        $fields['user_id'] = auth()->id();
        Post::create($fields);
        return redirect('/');
    }
}

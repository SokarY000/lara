<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use App\Models\User;


class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all();
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    public function show(Post $post)
    {
       
        // $singlePostFromDB = Post::find($postId);

        // return view('posts.show', ['post' => $singlePostFromDB]);
        return view('posts.show', ['post' => $post]);
    }
    public function create()
    {
       
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store()
    {
//        $request = request();
           
//        dd($request->title, $request->all());

        //1- get the user data
        $data = request()->all();

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        // dd($postCreator);
//        dd($data, $title, $description, $postCreator);

        //2- store the user data in database
        $post=new Post;
        $post->title= $title;
        $post->description=$description;
        $post->user_id=$postCreator;
        $post->save();
        //3- redirection to posts.index
        return to_route('posts.index');
    }

    public function edit(Post $post){
        $users = User::all();
        return view('posts.edit',['users' => $users,'post'=>$post]);
    }

    public function update(Post $post)
    {
        //1- get the user data

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

//        dd($title, $description, $postCreator);

        //2- update the user data in database
        $post->update([
            'title' => $title,
            'description' => $description,
            'user_id'=>$postCreator,
        ]);
        $post->description=$description;
        //3- redirection to posts.show

        return to_route('posts.show',$post->id );
    }

    public function destroy(Post $post)
    {
        //1- delete the post from database
        $post->delete();
        //2- redirect to posts.index
        return to_route('posts.index');
    }

}

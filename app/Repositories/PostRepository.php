<?php


namespace App\Repositories;


use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{


    public function selectAll()
    {
        return Post::where('published', 1)->get();
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function insert($request)
    {
        $mode = new Post();
        $mode->user_id = $request['user_id'];
        $mode->title = $request['title'];
        $mode->body = $request['body'];
        $mode->save();
        return $mode;
    }


}


<?php


namespace App\Models;



class Post extends BaseModel
{

    protected $table = 'posts';

    protected $fillable = [
        'id', 'user_id', 'title', 'body', 'published'
    ];

    protected $hidden = [

    ];

    protected $attributes = [
        'published' => 1,
    ];

//    protected $casts = [
//        'created_at' => 'datetime:U',
//    ];

}
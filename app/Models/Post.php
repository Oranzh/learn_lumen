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

    /**
     * @var array published  默认值1
     */
    protected $attributes = [
        'published' => 1,
    ];

    /**
     * @desc  强制转换类型
     * @var array
     */
    protected $casts = [
        'published'  => 'boolean',
        'title'  => 'int',
    ];



}
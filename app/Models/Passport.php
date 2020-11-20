<?php


namespace App\Models;



class Passport extends BaseModel
{


    protected $fillable = [
        'id', 'name'
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     * @var array published  默认值1
     */
    protected $attributes = [
    ];


    /**
     * The privileges belong to the Passport
     */
    public function privileges()
    {
        return $this->belongsToMany('App\Models\Privilege')->as('privileges')->withTimestamps()->wherePivot('id', '>', 1);
    }


}
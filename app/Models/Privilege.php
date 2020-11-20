<?php


namespace App\Models;


class Privilege extends BaseModel
{


    protected $fillable = [
        'id', 'name'
    ];

    protected $hidden = [

    ];

    /**
     * @var array published  默认值1
     */
    protected $attributes = [
    ];

    /**
     * The users belong to the privilege
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function passports()
    {
        return $this->belongsToMany('App\Models\Passport')->withPivot('id');
    }

}
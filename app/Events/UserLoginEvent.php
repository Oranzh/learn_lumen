<?php

namespace App\Events;

use App\Models\User;

class UserLoginEvent extends Event
{

    public $user;

    /**
     * Create a new event instance.
     * @param $user
     * @return void
     */
    public function __construct(User $user)
    {
        var_dump(__METHOD__);
        $this->user = $user;

    }
}

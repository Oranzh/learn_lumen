<?php


namespace App\Listeners;


use App\Events\UserRegisterEvent;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Log;

class UserRegisterEventListener extends Listener
{
    public function __construct()
    {
    }


    public function handle(UserRegisterEvent $event)
    {
        var_dump(__CLASS__);
        Log::info('Listener');
    }
}
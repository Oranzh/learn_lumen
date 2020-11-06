<?php


namespace App\Listeners;



class UserEventSubscriber
{

    /**
     * @param $event
     * Handle user login events.
     */
    public function handleUserLogin($event) {

        var_dump(get_class($event));
        var_dump($event->user->email);
        var_dump(__METHOD__);
    }

    /**
     * @param $event
     * Handle user logout events.
     */
    public function handleUserLogout($event) {
        //var_dump(get_class($event));
        var_dump(__METHOD__);

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\UserLoginEvent',
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            'App\Events\UserLogoutEvent',
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }

}
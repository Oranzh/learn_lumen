<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */

    /**
     * 第一，在系统中注册一个身份验证的服务
     * 第二，当服务启动时，建立一个针对请求做检查的守门员
     * 第三，在检查请求的过程中，如果要辨识入侵者，得建立一个匿名函数， 让RequestGuard判断是使用者还是访客
     * 第四，在难的中间件， Authenticate Middleware中，呼叫建立好的守门员进行检查
     *
     *
     * 身份验证系统， 总共有两处
     * 1，AuthServiceProvider  ViaRequest方法， AuthManager里面获得Guard和User的关系 ，从而进行身份验证
     * 2，Middleware/Authenticate  handle方法， jwtGuard类验证 是否是访客，是的话拒绝访问，是的话通行
     *
     *
     * 注意： config/auth.php
     * guard必须有两个字段 driver and provider
     * 这里的viaRequest方法，如果driver传的空或者有误，则取配置文件里的default guard里面的driver，此处是jwt
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        if ($this->app['auth']) {
            //var_dump($this->app['auth']);
            //object(Illuminate\Auth\AuthManager)
        }


        $this->app['auth']->viaRequest('', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });


    }
}

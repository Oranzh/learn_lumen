<?php


namespace App\Http\Controllers;


use App\Jobs\ExampleJob;
use App\Models\Passport;
use App\Models\Post;
use App\Models\Privilege;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExampleController extends Controller
{
    private $post;
    private $user;
    private $passport;
    private $privilege;

    public function __construct(Post $post, User $user, Passport $passport, Privilege $privilege)
    {
        $this->post = $post;
        $this->user = $user;
        $this->passport = $passport;
        $this->privilege = $privilege;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @link https://lumen.laravel.com/docs/5.1/queues#failed-job-events
     */
    public function testJob($id)
    {
        Log::info(Carbon::now());
        $job = (new ExampleJob($id))->delay(1);
        $this->dispatch($job);
        return response()->json('Job has finished');
    }

    public function randomInt()
    {
        return response()->json(random_int(1,5));
    }

    /**
     * test relationship one to many reverse
     */
    public function oneToManyReverse()
    {
        $post = $this->post->find(1);
        return response()->json(['name' => $post->user->name]);
    }


    public function oneToMany($id)
    {
        $res = $this->user->find($id)->posts()->where('title', '1')->get();

        return response()->json(['list' => $res[0]]);

    }


    public function allPassports()
    {
        $res = $this->passport->all();
        return response()->json($res);
    }

    /**
     * @desc passport拥有的权限
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function manyToMany($id)
    {
        $res = $this->passport->find($id)->privileges;
        return response()->json($res);
    }


    public function manyToMany2($id)
    {
        return response()->json($this->privilege->find($id)->passports);
    }

    public function iii()
    {
        $res = DB::table('mechanics')->insert(['name' => 'Lee']);
        return response()->json([$res]);
    }
}
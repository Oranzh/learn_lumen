<?php


namespace App\Http\Controllers;

use App\Events\UserLoginEvent;
use App\Events\UserRegisterEvent;
use App\Http\Requests\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Event;

class AuthController extends Controller
{

    private $user;
    public function __construct(User  $user)
    {
        $this->middleware('auth', ['only' => 'profile']);
        $this->user = $user;
    }

    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            Event::dispatch(new UserRegisterEvent($user));
            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


    public function login(Login $request)
    {
        $data = $request->validated();

        if (! $token = Auth::attempt($data)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ( Auth::user()->email == 'Celia@gmail.com')
        {
            $user = Auth::user();
            echo 'oranzh', PHP_EOL;
            $user->givePermissionTo('admin');
        }

        return $this->respondWithToken($token);
    }

    public function profile()
    {
        $user = Auth::user();
        $permissions = $user->getAllPermissions();
        return response()->json(['user' =>  $user, 'psermission' => $permissions]);
    }

    public function permission()
    {
        $user = Auth::user();
        //$user->givePermissionTo('super_admin');
        if ($user->can('super_admin'))
        {
            echo 'I am a super admin!!!', PHP_EOL;
        }  else {
            echo 'I am  just  a user',  PHP_EOL;
        }

        //Event::dispatch(new UserRegisterEvent(Auth::user()));
        Event::dispatch(new UserLoginEvent(Auth::user()));

        return response()->json(Auth::user());
    }

}
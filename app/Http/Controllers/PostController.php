<?php


namespace App\Http\Controllers;



use App\Http\Requests\Post\Create;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    private $post;


    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->post = $postRepository;
        $this->middleware('auth');
    }


    public function index()
    {
        $all = $this->post->selectAll();
        $message = 'Message ';
        $log = [
            'user' => 'Lee',
            'time' => '2020',
        ];
        Log::channel('mylog')->info($message, $log);
        Log::channel('mylog')->notice($message, $log);
        return response()->json($all);
    }

    public function show($id)
    {
        if ($info = Redis::get('post_'.$id)) {
            $info = json_decode($info, true);
        } else {
            $info = $this->post->find($id);
            Redis::set('post_'. $id, json_encode($info));
        }
        return response()->json($info);
    }

    public function create(Create $request)
    {

        $data = $request->validated();
        $model = $this->post->insert($data);
        return response()->json($model);

    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id' => 'required|int|min:1',
            'title' => 'string|min:5',
        ]);

        $post = $this->post->find($request['id']);
        $post->title = $request['title'];
        $post->save();
        return response()->json($post);
    }
}
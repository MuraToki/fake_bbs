<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//HomeController = PostController

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $q = \Request::query();

        if (isset($q['category_id'])) {
            # code...
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(3);
            $posts->load('category', 'user', 'tags');
            // dd($posts);
    
            return view('home', ['posts' => $posts, 'category_id' => $q['category_id']]);

          } elseif (isset($q['tag_name'])) {
            $posts = Post::latest()->where('content', 'like', '%'.$q['tag_name'].'%')->paginate(3);
            $posts->load('category', 'user', 'tags');


            return view('home', [
                'posts' => $posts,
                'tag_name' => $q['tag_name']
            ]);

            } else {
            # code...
            $posts = Post::latest()->paginate(3);
            $posts->load('category', 'user', 'tags');
            // dd($posts);
    
            return view('home', ['posts' => $posts]);
        }


    }

    public function create() {
        return view('posts.create');
    }

    public function store(PostRequest $request) {
        // dd($request->file('image'));
        if($request->file('image')->isValid()) {
            $id = Auth::id();
            $post = new Post;
            
            $post->title = $request->title;
            $post->content = $request->content;
            $post->category_id = $request->category_id;
            $post->user_id = $id;

            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);

            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);
            
            $tags = [];
            foreach ($match[1] as $tag) {
                $found = Tag::firstOrCreate(['tag_name' => $tag]);

                array_push($tags, $found);
            }

            $tag_ids = [];

            foreach ($tags as $tag) {
                array_push($tag_ids, $tag['id']);
            }

            // dd($tag_ids);

            // dd($post);
            $post->save();
            $post->tags()->attach($tag_ids);
        }
        return redirect()->route('home');
    }

    public function show(Post $post) {
        // dd($post);
        $post->load('category', 'user', 'comment.user');
        // dd($post);

        return view('posts.show', ['post' => $post]);
    }

    public function search(Request $request) {
        // dd($request->search);
        $posts = Post::where('title', 'like','%'.$request->search.'%')
        ->orWhere('content','like', '%'.$request->search.'%')->paginate(3);
        // dd($posts);
        $search_result = $request->search.'の検索結果'.$posts->total().'件';
        return view('home', ['posts' => $posts, 'search_result' => $search_result, 'search_query'  => $request->search]);
    }

    public function delete($id) {
        $post = Post::find($id);
        // dd($post);

        $post -> delete();
        return redirect()->route('home');
    }
}

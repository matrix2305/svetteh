<?php

namespace App\Http\Controllers;


use AppCore\Interfaces\IPostsService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    private IPostsService $postsService;

    public function __construct(IPostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postsService->getAllPosts();
        return view('posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postsService->getAllCategories();
        return view('createposts', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'text' => 'required|string',
                'image' => 'required|image|mimes:jpeg,jpg,png,giff,svg,bmp|max:4096'
            ]
        );

        $user_id = Auth::user()->getId();
        $data = $request->all();
        unset($data['_token'], $data['_method'], $data['title'], $data['text'], $data['image']);

        try {
            $categories = array_values($data);
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/posts'), $image_name);
            $this->postsService->addPost([
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'image' => $image_name,
                'categories' => $categories,
                'user_id' => $user_id,
            ]);
            return redirect()->route('createposts')->with('succes', 'Uspešno dodat post!');
        }catch (Exception $exception){
            unlink(public_path('images/posts'.$image_name));
            return redirect()->back()->with('error', 'Greška pri dodavanju!');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);
        $id = $request->input('id');
        $this->postsService->deletePost(intval($id));
        return redirect()->route('posts')->with('deleted', 'Uspešno obrisana objava!');
    }
}

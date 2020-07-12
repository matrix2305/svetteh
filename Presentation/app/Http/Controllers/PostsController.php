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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'text' => 'required|string',
                'image' => 'required|image|mimes:jpeg,jpg,png,giff,svg,bmp|max:4096',
                'category' => 'required|array|max:20'
            ]
        );

        $user_id = Auth::user()->getId();
        try {
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/posts'), $image_name);
            $this->postsService->addPost([
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'image' => $image_name,
                'categories' => $request->input('category'),
                'user_id' => $user_id,
            ]);
            return redirect()->route('createposts')->with('success', 'Uspešno dodat post!');
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
        $post = $this->postsService->findOnePost(intval($id));
        $categories = $this->postsService->getAllCategories();
        return view('editpost', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
          [
              'id' => 'required|integer',
              'image' => 'image|mimes:jpg,png,svg,bmp,jpeg|max:4096',
              'lastimage' => 'required|string:30',
              'title' => 'required|string:30',
              'text' => 'required',
              'categories' => 'required|array',
          ]
        );


        try {
            if ($request->hasFile('image')){
                $image = $request->file('image');
                unlink(public_path('/images/posts/'.$request->input('lastimage')));
                $extension = $image->extension();
                $image_name = time().'.'.$extension;
                $image->move(public_path('/images/posts/'),  $image_name);
            }else{
                $image_name = null;
            }

            $this->postsService->updatePost(
                [
                    'id' => $request->input('id'),
                    'image' => $image_name,
                    'title' => $request->input('title'),
                    'text' => $request->input('text'),
                    'categories' => $request->input('categories'),
                ]
            );

            return redirect()->route('posts')->with('updated', 'Uspešne izmene!');
        }catch (Exception $exception) {
            return redirect()->back()->with('error', 'Neuspešne izmene!');
        }

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
            'id' => 'required|integer',
            'image' => 'required|string:30'
        ]);
        try {
            $image = $request->input('image');
            unlink(public_path('/images/posts/'.$image));
            $id = $request->input('id');
            $this->postsService->deletePost(intval($id));
            return redirect()->route('posts')->with('deleted', 'Uspešno obrisana objava!');
        }catch (Exception $exception){
            return redirect()->route('posts')->with('error', 'Greška pri brisanju!');
        }
    }
}

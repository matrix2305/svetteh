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
        //
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
        dd($request->all());
        $request->validate(
            [
                'title' => ['required', 'max:255'],
                'text' => ['required'],
                'image' => ['required', 'image', 'mimes:jpeg,jpg,png,giff,svg,bmp', 'max:4096']
            ]
        );
        $cinput = array_diff($request->all(), ['__token', 'title', 'text', 'image']);
        $categories = array();
        for($i = 0; $i<count($cinput); $i++){
            if(!empty($cinput[$i])){
                $categories[] = [
                    'id' => $cinput[$i]
                ];
            }
        }
        $user_id = Auth::user()->getId();

        $image_name = time().'.'.$request->image->extension();
        try {
            $request->image->move(public_path('images/posts'), $image_name);
            $this->postsService->addPost([
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'image' => $image_name,
                'categories' => $categories,
                'user_id' => $user_id,
            ]);
            return redirect()->route('createposts')->with('error', 'Uspešno dodat post!');
        }catch (Exception $exception){
            unlink(public_path('images/posts'.$image_name));
            return redirect()->back()->with('error', 'Greška pri dodavanju!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}

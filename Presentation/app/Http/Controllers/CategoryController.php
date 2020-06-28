<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IPostsService;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
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
        $categories = $this->postsService->getAllCategories();
        return view('categories', ['categories' => $categories]);
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
                'category_name' => 'required',
                'category_color' => 'required'
            ]
        );

        try {
            $this->postsService->addCategory([
                'category_name' => $request->input('category_name'),
                'category_color' => $request->input('category_color')
            ]);
            return redirect()->route('categories')->with('success', 'Uspešno dodavanje!');
        }catch (Exception $exception){
            return redirect()->route('categories')->with('error', 'Kategorija već postoji!');
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
        $category = $this->postsService->findOneCategory(intval($id));
        return view('editcategory', ['category' => $category]);
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
                'name' => 'required|string:30',
                'color' => 'required|string:7'
            ]
        );

        try {
            $this->postsService->updateCategory([
               'id' => $request->input('id'),
               'name' => $request->input('name'),
               'color' => $request->input('color')
            ]);
            return redirect()->route('categories')->with('updated', 'Uspešne izmene!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Greška pri izmeni!');
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
        $request->validate(
            [
                'id' => 'required'
            ]
        );

        $this->postsService->deleteCategory($request->input('id'));
        return redirect()->route('categories')->with('deleted', 'Uspešno obrisana kategorija!');
    }
}

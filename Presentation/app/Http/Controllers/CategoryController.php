<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\ICategoriesService;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    private ICategoriesService $categoriesService;

    public function __construct(ICategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoryadd');
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
            $this->categoriesService->addCategory([
                'category_name' => $request->input('category_name'),
                'category_color' => $request->input('category_color')
            ]);
            return redirect()->route('addcategory')->with('success', 'Uspešno dodavanje!');
        }catch (Exception $exception){
            return redirect()->route('addcategory')->with('error', 'Kategorija već postoji!');
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
        return view('categories.edit');
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

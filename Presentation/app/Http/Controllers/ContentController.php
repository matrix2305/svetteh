<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IContentService;
use Illuminate\Http\Request;
use Exception;

class ContentController extends Controller
{
    private IContentService $contentService;

    public function __construct(IContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(){
        $content = $this->contentService->findContent();
        return view('content', ['content' => $content]);
    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string:50',
                'text' => 'required',
                'adress' => 'string:100',
                'phone' => 'string:50',
                'email' => 'required|email|max:70',
                'instagram' => 'max:100',
                'facebook' => 'max:100'
            ]
        );

        try {
            $this->contentService->updateContent(
                [
                    'name' => $request->input('name'),
                    'text' => $request->input('text'),
                    'adress' => $request->input('adress'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'instagram' => $request->input('instagram'),
                    'facebook' => $request->input('facebook'),
                ]
            );

            return redirect()->back()->with('success', 'Uspešne izmene!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Neupešne izmene!');
        }
    }
}

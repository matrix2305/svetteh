<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IPostsService;
use Illuminate\Http\Request;
use Exception;

class CommentsController extends Controller
{
    private IPostsService $postsService;

    public function __construct(IPostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    public function index(){
        $comments = $this->postsService->findComments();
        return view('comments', ['comments' => $comments]);
    }

    public function allow(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $this->postsService->allowComment(intval($request->input('id')));
            return redirect()->back()->with('success', 'Uspešno odobren komentar!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Došlo je do greške, pokušajte kasnije!');
        }
    }

    public function destroy(Request $request){
        $request->validate(
            [
                'id' => 'required'
            ]
        );

        try {
            $this->postsService->deleteComment(intval($request->input('id')));
            return redirect()->with('success', 'Uspešno obrisan komentar!');
        }catch (Exception $exception){
            return redirect()->with('error', 'Neuspešno brisanje, došlo je do greške!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\SendedMessageToDatabaseEvent;
use App\Events\Test;
use App\Jobs\SendEmail;
use AppCore\Interfaces\IContentService;
use AppCore\Interfaces\IPostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class PortalController extends Controller
{
    private IPostsService $postService;

    private IContentService $contentService;


    public function __construct(IPostsService $postService, IContentService $contentService)
    {
        $this->contentService = $contentService;
        $this->postService = $postService;
    }

    public function index()
    {
        $categories = $this->postService->getAllCategories();
        $posts = $this->postService->getAllPosts();
        $content = $this->contentService->findContent();
        return view('index', ['posts' => $posts, 'content' => $content, 'categories' => $categories]);
    }

    public function guestsMail(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string:40',
                'email' => 'required|email|max:70',
                'subject' => 'required|string'
            ]
        );

        SendEmail::dispatch($request->all());
        Event::dispatch(new SendedMessageToDatabaseEvent($request->all()));
        return redirect()->back()->with('success','Uspešno poslata poruka!');
    }
}

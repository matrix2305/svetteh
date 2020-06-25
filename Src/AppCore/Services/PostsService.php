<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\Interfaces\IPostsService;
use AppCore\Interfaces\IPostRepository;
use AppCore\Interfaces\ILog;

class PostsService implements IPostsService
{
    private IPostRepository $postsRepository;

    /**
     * @var Log
     */
    private ILog $log;

    public function __construct(IPostRepository $postsRepository, ILog $log)
    {
        $this->postsRepository = $postsRepository;
        $this->log = $log;
    }

    public function getAllPosts() : array
    {
        return $this->postsRepository->getAllPosts();
    }

    public function findOnePost(int $id) // Fix DTO
    {
        $post = $this->postsRepository->getOnePosts($id);
    }

    public function addPost(array $data)
    {
        // TODO: Implement addPost() method.
    }

    public function updatePost(array $data)
    {
        // TODO: Implement updatePost() method.
    }

    public function deletePost(int $id)
    {
        // TODO: Implement deletePost() method.
    }

}
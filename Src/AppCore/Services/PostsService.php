<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\Entities\Post;
use AppCore\Interfaces\IPostsService;
use Infrastructure\Interfaces\IPostRepository;
use Infrastructure\Log\Log;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Repository\PostsRepository;

class PostsService implements IPostsService
{
    /**
     * @var PostsRepository
     */
    private PostsRepository $postsRepository;

    /**
     * @var Log
     */
    private Log $log;

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
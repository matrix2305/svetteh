<?php
declare(strict_types = 1);
namespace AppCore\Services;

use Infrastructure\Interfaces\IPostRepository;
use Infrastructure\Log\Log;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Repository\PostsRepository;

class PostsService
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

    public function findOnePost($id)
    {
        $post = $this->postsRepository->getOnePosts($id);
    }

}
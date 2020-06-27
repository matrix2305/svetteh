<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\DTO\CategoryDTO;
use AppCore\DTO\PostsDTO;
use AppCore\Entities\Category;
use AppCore\Entities\Post;
use AppCore\Interfaces\IPostsService;
use AppCore\Interfaces\IPostsRepository;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;
use Exception;

class PostsService implements IPostsService
{
    private IPostsRepository $postsRepository;

    private IUsersRepository $usersRepository;
    /**
     * @var Log
     */
    private ILog $log;

    public function __construct(IPostsRepository $postsRepository, ILog $log, IUsersRepository $usersRepository)
    {
        $this->postsRepository = $postsRepository;
        $this->usersRepository = $usersRepository;
        $this->log = $log;
    }

    public function getAllPosts() : array
    {
        $posts = $this->postsRepository->getAllPosts();
        return PostsDTO::fromCollection($posts);
    }

    public function findOnePost(int $id) : PostsDTO
    {
        $post = $this->postsRepository->getOnePosts($id);
        return PostsDTO::fromEntity($post);
    }

    public function addPost(array $data)
    {
        try {
            $user = $this->usersRepository->getOneUser(intval($data['user_id']));
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setText($data['text']);
            $post->setImgPath($data['image']);
            $categories = $data['categories'];
            $post->setUser($user);
            for($i=0; $i<count($categories); $i++){
                $entity = $this->postsRepository->getOneCategory(intval($categories[$i]));
                $post->setCategories($entity);
            }
            $this->postsRepository->addPost($post);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function updatePost(array $data)
    {
        // TODO: Implement updatePost() method.
    }

    public function deletePost(int $id)
    {
        try {
            $this->postsRepository->deletePost($id);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function getAllCategories() : array
    {
        $categories = $this->postsRepository->getAllCategories();
        return CategoryDTO::fromCollection($categories);
    }

    public function addCategory(array $data)
    {
        try {
            $entity  = new Category();
            $entity->setCategoryName($data['category_name']);
            $entity->setCategoryColor($data['category_color']);
            $this->postsRepository->addCategory($entity);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteCategory(int $id)
    {
        try {
            $this->postsRepository->deleteCategory($id);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

}
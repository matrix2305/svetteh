<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\DTO\CategoryDTO;
use AppCore\Entities\Category;
use AppCore\Entities\Post;
use AppCore\Interfaces\IPostsService;
use AppCore\Interfaces\IPostsRepository;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;

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
        return $this->postsRepository->getAllPosts();
    }

    public function findOnePost(int $id) // Fix DTO
    {
        $post = $this->postsRepository->getOnePosts($id);
    }

    public function addPost(array $data)
    {
        $user = $this->usersRepository->getOneUser(intval($data['user_id']));
        $post = new Post();
        $post->setTitle($data['tittle']);
        $post->setText($data['text']);
        $post->setImgPath($data['image']);
        $categories = $data['categories'];
        $post->setUser($user);
        for($i=0; $i<count($categories); $i++){
            $entity = $this->postsRepository->getOneCategory($categories[$i]);
            $post->setCategories($entity);
        }
        $this->postsRepository->addPost($post);
    }

    public function updatePost(array $data)
    {
        // TODO: Implement updatePost() method.
    }

    public function deletePost(int $id)
    {
        // TODO: Implement deletePost() method.
    }

    public function getAllCategories() : array
    {
        $categories = $this->postsRepository->getAllCategories();
        return CategoryDTO::fromCollection($categories);
    }

    public function addCategory(array $data)
    {
        $entity  = new Category();
        $entity->setCategoryName($data['category_name']);
        $entity->setCategoryColor($data['category_color']);
        $this->postsRepository->addCategory($entity);
    }

    public function deleteCategory(int $id)
    {
        $this->postsRepository->deleteCategory($id);
    }

}
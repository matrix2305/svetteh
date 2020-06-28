<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\DTO\CategoryDTO;
use AppCore\DTO\CommentsDTO;
use AppCore\DTO\PostsDTO;
use AppCore\Entities\Category;
use AppCore\Entities\Comment;
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
        try {
            $post = $this->postsRepository->getOnePosts($data['id']);
            $post->setTitle($data['title']);
            $post->setText($data['text']);
            if(!empty($data['image'])){
                $post->setImgPath($data['image']);
            }
            $categories = $data['categories'];
            $post->clearCategories();
            for($i=0; $i<count($categories); $i++){
                $category = $this->postsRepository->getOneCategory(intval($categories[$i]));
                $post->setCategories($category);
            }
            $this->postsRepository->updatePost($post);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }

    }

    public function deletePost(int $id)
    {
        try {
            $entity = $this->postsRepository->getOnePosts($id);
            $this->postsRepository->deletePost($entity);
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

    public function findOneCategory(int $id) : CategoryDTO
    {
        $category = $this->postsRepository->getOneCategory($id);
        return CategoryDTO::fromEntity($category);
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

    public function updateCategory(array $data)
    {
        try {
            $entity = $this->postsRepository->getOneCategory(intval($data['id']));
            $entity->setCategoryName($data['name']);
            $entity->setCategoryColor($data['color']);
            $this->postsRepository->updateCategory($entity);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteCategory(int $id)
    {
        try {
            $entity = $this->postsRepository->getOneCategory($id);
            $this->postsRepository->deleteCategory($entity);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function findComments() : array
    {
        $comments = $this->postsRepository->getComments();
        return CommentsDTO::fromCollection($comments);
    }

    public function addComment(array $data)
    {
        try {
            $post = $this->postsRepository->getOnePosts(intval($data['post_id']));
            $comment = new Comment();
            $comment->setName($data['name']);
            $comment->setComment($data['comment']);
            $comment->setEmail($data['email']);
            $comment->setPost($post);
            $this->postsRepository->insertComment($comment);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function allowComment(int $id)
    {
        try {
            $entity = $this->postsRepository->getOneComment($id);
            $entity->setAllowed();
            $this->postsRepository->insertComment($entity);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteComment(int $id)
    {
        try {
            $comment = $this->postsRepository->getOneComment($id);
            $this->postsRepository->deleteComment($comment);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
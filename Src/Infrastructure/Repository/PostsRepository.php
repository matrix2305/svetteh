<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;

use AppCore\Entities\Category;
use AppCore\Entities\Comment;
use AppCore\Entities\Post;
use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IPostsRepository;

class PostsRepository implements IPostsRepository
{
    /**
     * @var EntityManager|EntityManagerInterface
     */
    private EntityManager $em;

    /**
     * @var ILog
     */
    private ILog $log;

    /**
     * @var string of entity class Post
     */
    private $post;

    /**
     * @var string
     */
    private $category;


    private $comments;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->post = Post::class;
        $this->category = Category::class;
        $this->comments = Comment::class;
    }

    /**
     * Method for get all post
     * @return array
     */
    public function getAllPosts() : array
    {
        return $this->em->getRepository($this->post)->findAll();
    }

    /**
     * Method for get one post
     * @param int $id
     * @return Post
     */
    public function getOnePosts(int $id) : Post
    {
        return  $this->em->find($this->post, $id);
    }

    /**
     * Method for add post
     * @param Post $post
     * @return string
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addPost(Post $post)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($post);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Method for update post
     * @param array $data
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function updatePost(Post $post)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($post);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * @param Post $post
     * @return string
     * @throws ConnectionException
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function deletePost(Post $post)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($post);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Method for get all categories
     * @return array
     */
    public function getAllCategories() : array
    {
        return $this->em->getRepository($this->category)->findAll();
    }

    /**
     * Method for get one category
     * @param int $id
     * @return Category
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getOneCategory(int $id) : Category
    {
        return $this->em->find($this->category, $id);
    }

    /**
     * Method for add category
     * @param Category $category
     * @return string
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addCategory(Category $category)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($category);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Method for update category
     * @param array $data
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function updateCategory(Category $category)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($category);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * Method for delete category
     * @param Category $category
     * @return string
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteCategory(Category $category)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($category);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Method for get all comments
     * @return array
     */
    public function getComments() : array
    {
        return $this->em->getRepository($this->comments)->findAll();
    }

    /**
     * Method for get one comment
     * @param int $id
     * @return Comment
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getOneComment(int $id) : Comment
    {
        return $this->em->find($this->comments, $id);
    }

    /**
     * Method for insert comment
     * @param Comment $comment
     * @return string
     * @throws ConnectionException
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function insertComment(Comment $comment)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($comment);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * Method for delete comment
     * @param Comment $comment
     * @return string
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteComment(Comment $comment)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($comment);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
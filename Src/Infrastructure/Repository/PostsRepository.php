<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;

use AppCore\Entities\Post;
use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Interfaces\IPostRepository;
use Infrastructure\Log\Log;

class PostsRepository implements IPostRepository
{
    /**
     * @var EntityManager|EntityManagerInterface
     */
    private EntityManager $em;

    /**
     * @var ILog|Log
     */
    private Log $log;

    /**
     * @var string of entity class Post
     */
    private $post;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->post = Post::class;
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
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
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
    public function updatePost(array $data)
    {
        try {
            $entity = $this->em->find($this->post, $data['id'], LockMode::OPTIMISTIC);
            $entity->setTittle($data[tittle]);
            $entity->setText($data['text']);
            if(!empty($data['img_path'])){
                $entity->setImgPath($data['img_path']);
            }
            $entity->setCategories($data['categories']);
            $this->em->flush();
        }catch (OptimisticLockException $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * @param int $id
     * @return string
     * @throws ConnectionException
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function deletePost(int $id)
    {
        $entity = $this->em->find($this->post, $id);
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($entity);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }
}
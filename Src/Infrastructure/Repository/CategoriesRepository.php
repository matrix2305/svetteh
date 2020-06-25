<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;


use AppCore\Entities\Category;
use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use AppCore\Interfaces\ICategoriesRepository;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Log\Log;

class CategoriesRepository implements ICategoriesRepository
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
     * @var string of entity class Category
     */
    private $category;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->category = Category::class;
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
    public function updateCategory(array $data){
        try {
            $entity = $this->em->find($this->category, $data['id'], LockMode::OPTIMISTIC);
            $entity->setCategoryName($data['category_name']);
            $entity->setCategoryColor($data['category_color']);
            $this->em->flush();
        }catch (OptimisticLockException $exception){
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
    public function deleteCategory(Category $category){
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
}
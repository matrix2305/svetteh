<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;


use AppCore\Entities\Role;
use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Interfaces\IRolesRepositroy;
use Infrastructure\Log\Log;

class RolesRepositroy implements IRolesRepositroy
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
     * @var string of entity Role type class
     */
    private $role;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->role = Role::class;
    }

    /**
     * Method for get all roles
     * @return array
     */
    public function getAllRoles() : array
    {
        return $this->em->getRepository($this->role)->findAll();
    }

    /**
     * Method for get one role
     * @param int $id
     * @return Role
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getOneRole(int $id) : Role
    {
        return $this->em->find($this->role, $id);
    }

    /**
     * Method for add role
     * @param Role $role
     * @return string
     * @throws ConnectionException
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addRole(Role $role)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($role);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Method for update role
     * @param array $data
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function updateRole(array $data)
    {
        try {
            $entity = $this->em->find($this->role, $data['id'], LockMode::OPTIMISTIC);
            $entity->setRoleColor($data['role_color']);
            $entity->setRoleName($data['role_name']);
        }catch (OptimisticLockException $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * Method for delete role
     * @param int $id
     * @return string
     * @throws ConnectionException
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function deleteRole(int $id)
    {
        $entity = $this->em->find($this->role, $id);
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
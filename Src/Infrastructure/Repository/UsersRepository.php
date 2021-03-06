<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;


use AppCore\Entities\Permissions;
use AppCore\Entities\Role;
use AppCore\Entities\User;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\OptimisticLockException;

class UsersRepository implements IUsersRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var ILog
     */
    private ILog $Log;

    /**
     * @var string of entity User type class
     */
    private $user;

    private $permission;

    private $role;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->Log = $log;
        $this->user = User::class;
        $this->role = Role::class;
        $this->permission = Permissions::class;
    }

    /**
     * Method for get all users
     * @return array
     */
    public function getAllUsers() : array
    {
        return $this->em->getRepository($this->user)->findAll();
    }

    /**
     * Method for find one entity of user by id
     * @param $id
     * @return User
     */
    public function getOneUser($id) : User
    {
        return $this->em->find($this->user, $id);
    }


    /**
     * Method for Add user
     * @param User $user
     * @return string
     * @throws ConnectionException
     */
    public function addUser(User $user)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($user);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * Method for update user
     * @param array $data
     * @return string
     * @throws ConnectionException
     */

    public function updateUser(User $user)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($user);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    /**
     * Method for delete user
     * @param int $id
     * @return string
     */

    public function deleteUser(User $user)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($user);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function getUserByEmailorUsername(string $username){
        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $field = "email";
        }else{
            $field = "username";
        }
        return $this->em->getRepository($this->user)->findOneBy([$field => $username]);
    }

    public function addPermission(Permissions $permissions) : ?string
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($permissions);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->rollback();
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function getAllPermissions() : array
    {
        return $this->em->getRepository($this->permission)->findAll();
    }

    public function getOnePermission(int $id) : Permissions
    {
        return $this->em->find($this->permission, $id);
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

    public function getRoleByName(string $name)
    {
        return $this->em->getRepository($this->role)->findOneBy(['role' => $name]);
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
            $this->Log->AddLog($exception->getMessage());
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
    public function updateRole(Role $role)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($role);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->Log->AddLog($exception->getMessage());
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
    public function deleteRole(Role $role)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($role);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->Log->AddLog($exception->getMessage());
            $this->em->getConnection()->rollBack();
            return $exception->getMessage();
        }
    }

}
<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;


use AppCore\Entities\User;
use Doctrine\DBAL\ConnectionException;
use AppCore\Interfaces\IUsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use AppCore\Interfaces\ILog;

class UsersRepository implements IUsersRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var string of entity User type class
     */
    private $user;

    /**
     * @var ILog
     */
    private ILog $Log;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->Log = $log;
        $this->user = User::class;
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

    public function updateUser(array $data)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $user = $this->em->find($this->user, $data['id']);
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            if(!empty($data['password'])){
                $user->setPassword($data['password']);
            }
            $user->setName($data['name']);
            $user->setLastname($data['lastname']);
            $this->em->flush();
            $this->em->getConnection()->beginTransaction();
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

    public function deleteUser(int $id)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $user = $this->em->find($this->user, $id);
            $this->em->remove($user);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
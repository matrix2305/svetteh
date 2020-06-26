<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\UsersDTO;
use AppCore\Entities\User;
use AppCore\Interfaces\IUsersService;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;

class UsersService implements IUsersService
{
    private ILog $Log;
    private IUsersRepository $UsersRepository;

    public function __construct(IUsersRepository $usersRepository, ILog $log)
    {
        $this->UsersRepository = $usersRepository;
        $this->Log = $log;
    }

    public function getAllUsers() : array
    {
        $GetAllUsers = $this->UsersRepository->GetAllUsers();
        return UsersDTO::fromCollection($GetAllUsers);
    }

    public function getOneUser($id) : UsersDTO
    {
        $GetOneUser = $this->UsersRepository->GetOneUser($id);
        return UsersDTO::fromEntity($GetOneUser);
    }

    public function addUser(array $data)
    {
        $role = $this->UsersRepository->getOneRole(1);
        $user = new User();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setLastname($data['lastname']);
        $user->setRole($role);
        $this->UsersRepository->AddUser($user);
    }

    public function updateUser(array $data) : void
    {
        $this->UsersRepository->updateUser($data);
    }

    public function deleteUser($id) : void
    {
        $this->UsersRepository->deleteUser($id);
    }

    public function login(string $username) : UsersDTO
    {
        $user =  $this->UsersRepository->getUserByEmailorUsername($username);
        return UsersDTO::fromEntity($user);
    }

    public function register(string $username) : UsersDTO
    {
        $user =  $this->UsersRepository->getUserByEmailorUsername($username);
        return UsersDTO::fromEntity($user);
    }
}

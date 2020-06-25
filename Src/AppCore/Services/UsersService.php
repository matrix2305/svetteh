<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\UsersDTO;
use AppCore\Entities\User;
use AppCore\Interfaces\IUsersService;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;
use AppCore\Interfaces\IRolesRepository;

class UsersService implements IUsersService
{
    private ILog $Log;
    private IUsersRepository $UsersRepository;
    private IRolesRepository $RolesRepository;

    public function __construct(IUsersRepository $usersRepository, ILog $log, IRolesRepository $rolesRepositroy)
    {
        $this->UsersRepository = $usersRepository;
        $this->Log = $log;
        $this->RolesRepository = $rolesRepositroy;
    }

    public function getAllUsers() : array
    {
        $GetAllUsers = $this->UsersRepository->GetAllUsers();
        return UsersDTO::formCollection($GetAllUsers);
    }

    public function getOneUser($id) : UsersDTO
    {
        $GetOneUser = $this->UsersRepository->GetOneUser($id);
        return UsersDTO::formEntity($GetOneUser);
    }

    public function addUser(array $data)
    {
        $role = $this->RolesRepository->getOneRole(1);
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

}

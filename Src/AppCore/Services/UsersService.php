<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\UsersDTO;
use AppCore\Entities\Role;
use AppCore\Entities\User;
use AppCore\Interfaces\IUsersService;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Interfaces\IRolesRepositroy;
use Infrastructure\Interfaces\IUsersRepository;
use Infrastructure\Log\Log;
use Infrastructure\Repository\RolesRepositroy;
use Infrastructure\Repository\UsersRepository;

class UsersService implements IUsersService
{
    private Log $Log;
    private UsersRepository $UsersRepository;
    private RolesRepositroy $RolesRepository;

    public function __construct(IUsersRepository $usersRepository, ILog $log, IRolesRepositroy $rolesRepositroy)
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

    public function addUser(array $data) : ?string
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
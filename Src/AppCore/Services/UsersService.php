<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\PermissionsDTO;
use AppCore\DTO\RoleDTO;
use AppCore\DTO\UsersDTO;
use AppCore\Entities\Permissions;
use AppCore\Entities\Role;
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
        $role = $this->UsersRepository->getOneRole(intval($data['role_id']));
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

    public function deleteUser(int $id) : void
    {
        $this->UsersRepository->deleteUser($id);
    }

    public function login(string $username) : ?UsersDTO
    {
        $user =  $this->UsersRepository->getUserByEmailorUsername($username);
        if(!empty($user)){
            return UsersDTO::fromEntity($user);
        }else{
            return null;
        }
    }

    public function register(string $username) : ?UsersDTO
    {
        $user =  $this->UsersRepository->getUserByEmailorUsername($username);
        if(!empty($user)){
            return UsersDTO::fromEntity($user);
        }else{
            return null;
        }
    }

    public function getAllRoles() : array
    {
        $roles = $this->UsersRepository->getAllRoles();
        return RoleDTO::fromCollection($roles);
    }

    public function findRoleByName(string $name) : ?RoleDTO
    {
        $role = $this->UsersRepository->getRoleByName($name);
        if(!empty($role)){
            return RoleDTO::fromEntity($role);
        }else{
            return null;
        }
    }

    public function addRole(array $data) : void
    {
        $role = new Role();
        $role->setName($data['name']);
        $role->setRoleColor($data['color']);
        $permissions = $data['permissions'];
        foreach ($permissions as $input){
            $entity = $this->UsersRepository->getOnePermission(intval($input['id']));
            $role->setPermissions($entity);
        }
        $this->UsersRepository->addRole($role);
    }

    public function getAllPermissions() : array
    {
        $permissions =  $this->UsersRepository->getAllPermissions();
        return PermissionsDTO::fromCollection($permissions);
    }

    public function deleteRole(int $id) : void
    {
        $this->UsersRepository->deleteRole($id);
    }

}

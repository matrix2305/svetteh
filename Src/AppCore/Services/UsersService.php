<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\PermissionsDTO;
use AppCore\DTO\RoleDTO;
use AppCore\DTO\UsersDTO;
use AppCore\Entities\Role;
use AppCore\Entities\User;
use AppCore\Interfaces\IUsersService;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IUsersRepository;
use Exception;

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
        try {
            $role = $this->UsersRepository->getOneRole(intval($data['role_id']));
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setName($data['name']);
            $user->setLastname($data['lastname']);
            $user->setRole($role);
            $this->UsersRepository->AddUser($user);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function updateUser(array $data)
    {
        try {
            $this->UsersRepository->updateUser($data);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $this->UsersRepository->deleteUser($id);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
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

    public function findRoleById(int $id) : RoleDTO
    {
        $role = $this->UsersRepository->getOneRole($id);
        return RoleDTO::fromEntity($role);
    }

    public function getAllRoles() : array
    {
        $roles = $this->UsersRepository->getAllRoles();
        return RoleDTO::fromCollection($roles);
    }

    public function findRoleByName(string $name) : RoleDTO
    {
        $role = $this->UsersRepository->getRoleByName($name);
        return RoleDTO::fromEntity($role);
    }

    public function addRole(array $data)
    {
        try {
            $role = new Role();
            $role->setName($data['name']);
            $role->setRoleColor($data['color']);
            $permissions = $data['permissions'];
            for ($i = 0; $i<count($permissions); $i++){
                if(!empty($permissions)){
                    $entity = $this->UsersRepository->getOnePermission(intval($permissions[$i]));
                    $role->setPermissions($entity);
                }
            }
            $this->UsersRepository->addRole($role);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function getAllPermissions() : array
    {
        $permissions =  $this->UsersRepository->getAllPermissions();
        return PermissionsDTO::fromCollection($permissions);
    }

    public function deleteRole(int $id)
    {
        try {
            $this->UsersRepository->deleteRole($id);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

}

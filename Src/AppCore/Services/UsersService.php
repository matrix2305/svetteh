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
            $user = $this->UsersRepository->getOneUser(intval($data['id']));
            $role = $this->UsersRepository->getOneRole(intval($data['role_id']));
            $user->setRole($role);
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            if(!empty($data['password'])){
                $user->setPassword($data['password']);
            }
            if(!empty($data['avatar'])){
                $user->setAvatarName($data['avatar']);
            }
            $user->setName($data['name']);
            $user->setLastname($data['lastname']);
            $this->UsersRepository->updateUser($user);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $user = $this->UsersRepository->getOneUser($id);
            $this->UsersRepository->deleteUser($user);
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

    public function register(string $username) : ?UsersDTO
    {
        $user =  $this->UsersRepository->getUserByEmailorUsername($username);
        if(!empty($user)){
            return UsersDTO::fromEntity($user);
        }else{
            return null;
        }

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

    public function updateRole(array $data)
    {
        try {
            $entity = $this->UsersRepository->getOneRole(intval($data['id']));
            $entity->setName($data['name']);
            $entity->setRoleColor($data['color']);
            $entity->clearPermissions();
            $permissions = $data['permissions'];
            for ($i = 0; $i<count($permissions); $i++){
                $permission = $this->UsersRepository->getOnePermission(intval($permissions[$i]));
                $entity->setPermissions($permission);
            }
            $this->UsersRepository->updateRole($entity);
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
            $role = $this->UsersRepository->getOneRole($id);
            $this->UsersRepository->deleteRole($role);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

}

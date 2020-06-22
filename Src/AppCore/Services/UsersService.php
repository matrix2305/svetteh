<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\DTO\UsersDTO;
use AppCore\Entities\User;
use AppCore\Interfaces\IUserService;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Interfaces\IUsersRepository;
use Infrastructure\Log\Log;
use Infrastructure\Repository\UsersRepository;
use Mockery\Exception;

class UsersService implements IUserService
{
    private Log $Log;
    private UsersRepository $UsersRepository;

    public function __construct(IUsersRepository $usersRepository, ILog $log)
    {
        $this->UsersRepository = $usersRepository;
        $this->Log = $log;
    }

    public function GetAllUsers()
    {
        try {
            $GetAllUsers = $this->UsersRepository->GetAllUsers();
            return UsersDTO::formCollection($GetAllUsers);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function GetOneUser($id)
    {
        try {
            $GetOneUser = $this->UsersRepository->GetOneUser($id);
            return UsersDTO::formEntity($GetOneUser);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function AddUser(array $data)
    {
        try {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setName($data['name']);
            $user->setLastname($data['lastname']);

            $this->UsersRepository->AddUser($user);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function UpdateUser(array $data)
    {
        try {
            $this->UsersRepository->UpdateUser($data);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function DeleteUser($id)
    {
        try {
            $this->UsersRepository->DeleteUser($id);
        }catch (Exception $exception){
            $this->Log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

}
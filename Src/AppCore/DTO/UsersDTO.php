<?php


namespace AppCore\DTO;


use AppCore\Entities\Role;
use AppCore\Entities\User;


class UsersDTO extends BaseDTO
{
    public int $id;
    public string $username;
    public string $email;
    public ?string $name;
    public ?string $lastname;
    public RoleDTO $role;

    public static function fromEntity(User $user) : UsersDTO
    {
        return new self(
            [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'lastname' => $user->getLastname(),
                'role' => RoleDTO::fromEntity($user->getRole())
            ]
        );
    }

    public static function fromCollection(array $data) : array
    {
        $usersCollection = array();
        if(!empty($data)){
            foreach ($data as $user){
                if($user instanceof User){
                    $usersCollection[] = self::fromEntity($user);
                }
            }
        }

        return $usersCollection;
    }
}
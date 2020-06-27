<?php


namespace AppCore\DTO;


use AppCore\Entities\User;
use DateTime;
class UsersDTO extends BaseDTO
{
    public int $id;
    public string $username;
    public string $email;
    public ?string $name;
    public ?string $lastname;
    public string $updatedAt;
    public string $createdAt;
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
                'updatedAt' => $user->getUpdatedAt()->format('d/m/Y  H:i:s'),
                'createdAt' => $user->getUpdatedAt()->format('d/m/Y  H:i:s'),
                'role' => RoleDTO::fromEntity($user->getRole())
            ]
        );
    }

    public static function fromCollection(array $users) : array
    {
        $usersCollection = array();
        if(!empty($users)){
            foreach ($users as $user){
                if($user instanceof User){
                    $usersCollection[] = self::fromEntity($user);
                }
            }
        }
        return $usersCollection;
    }
}
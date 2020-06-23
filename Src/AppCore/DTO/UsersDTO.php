<?php


namespace AppCore\DTO;


use AppCore\Entities\User;
use Mockery\Exception;

class UsersDTO extends BaseDTO
{
    private int $id;
    private string $username;
    private string $email;
    private string $name;
    private string $lastname;

    public static function formEntity(User $user){
        return new self(
            [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'lastname' => $user->getLastname()
            ]
        );
    }

    public static function formCollection(array $data){
        $usersCollection = array();
        if(!empty($data)){
            foreach ($data as $user){
                if($user instanceof User){
                    $usersCollection[] = self::formEntity($user);
                }
            }
        }

        return $usersCollection;
    }
}
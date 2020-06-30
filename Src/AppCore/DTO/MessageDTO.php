<?php
namespace AppCore\DTO;


use AppCore\Entities\Message;

class MessageDTO extends BaseDTO
{
    public int $id;
    public static $name;
    public string $email;
    public string $message;


    public static function fromEntity(Message $message){
        return new self(
            [
                'id' => $message->getId(),
                'name' => $message->getName(),
                'email' => $message->getEmail(),
                'message' => $message->getMessage(),
            ]
        );
    }

    public static function fromCollection(array $data) : array
    {
        $messageCollection = array();
        if (!empty($data)){
            foreach ($data as $message){
                if ($message instanceof Message){
                    $messageCollection[] = self::fromEntity($message);
                }
            }
        }

        return $messageCollection;
    }
}
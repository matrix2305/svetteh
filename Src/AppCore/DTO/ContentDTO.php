<?php
namespace AppCore\DTO;


use AppCore\Entities\Content;

class ContentDTO extends BaseDTO
{
    public string $name;
    public string $text;
    public ?string $adress;
    public ?string $phone;
    public string $email;
    public string $instagram;
    public string $facebook;

    public static function fromEntity(Content $content){
        return new self(
            [
                'name' => $content->getName(),
                'text' => $content->getText(),
                'adress' => $content->getAdress(),
                'phone' => $content->getPhone(),
                'email' => $content->getEmail(),
                'instagram' => $content->getInstagram(),
                'facebook' => $content->getFacebook(),
            ]
        );
    }
}
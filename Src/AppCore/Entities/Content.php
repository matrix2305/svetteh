<?php
declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name = "content")
 */
class Content
{
    /**
     * @ORM\Id
     * @ORM\Column(name = "id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name = "name", type = "string", length = 50)
     */
    private string $name;

    /**
     * @ORM\Column(name = "text", type = "text")
     */
    private string $text;

    /**
     * @ORM\Column(name = "adress", type = "string", length = 100, nullable = true)
     */
    private string $adress;

    /**
     * @ORM\Column(name = "email", type = "string", length = 50)
     */
    private string $email;

    /**
     * @ORM\Column(name = "phone", type = "string", length = 50, nullable = true)
     */
    public string $phone;

    /**
     * @ORM\Column(name = "instagram", type = "string", length = 100, nullable = true)
     */
    private string $instagram;

    /**
     * @ORM\Column(name = "facebook", type = "string", length = 100, nullable = true)
     */
    private string $facebook;

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function setText(string $text) : void
    {
        $this->text = $text;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getAdress() : string
    {
        return $this->adress;
    }

    public function setAdresss(string $adress) : void
    {
        $this->adress = $adress;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    public function setPhone(string $phone) : void
    {
        $this->phone =$phone;
    }

    public function getInstagram() : ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram) : void
    {
        $this->instagram = $instagram;
    }

    public function getFacebook() : string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook) : void
    {
        $this->facebook = $facebook;
    }
}
<?php declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue("IDENTITY")
     */
    private int $id;


    /**
     * @ORM\Column(name="name", type="string", length=50)
     */
    private string $name;

    /**
     * @ORM\Column(name="email", type="string", length=70)
     */
    private string $email;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private string $message;

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

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email =  $email;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }
}
<?php
declare(strict_types = 1);

namespace AppCore\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Arr;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuth;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Users
 * @package AppCore\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name = "users")
 */
class User implements Authenticatable, CanResetPasswordContract
{
    use DoctrineAuth, CanResetPassword, Timestamps, Notifiable;

    /**
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string $username
     * @ORM\Column(name="username", type="string")
     */
    private string $username;

    /**
     * @var string $email
     * @ORM\Column(name="email", type="string")
     */
    private string $email;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string")
     */
    private string $name;

    /**
     * @var string $lastname
     * @ORM\Column(name="lastname", type="string")
     */
    private string $lastname;


    /**
     * @OneToMany(targetEntity="Post", mappedBy="user")
     */
    private ArrayCollection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }


    public function getId() : int
    {
        return $this->id;
    }


    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname) : void
    {
        $this->lastname = $lastname;
    }

}
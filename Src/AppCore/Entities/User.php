<?php
declare(strict_types = 1);

namespace AppCore\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuth;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
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
    use DoctrineAuth, CanResetPassword, Notifiable;

    /**
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name = "created_at", type="datetime")
     */
    private string $createdAt;

    /**
     * @Version @Column(name = "updated_at", type = "datetime")
     */
    private string $updatedAt;

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
     * @OneToMany(targetEntity="Post", mappedBy="users", cascade={"persist", "remove"}, fetch = "LAZY")
     */
    private ArrayCollection $posts;

    /**
     * @ManyToOne(targetEntity="Role", inversedBy="users", cascade={"persist", "remove"}, fetch = "EAGER")
     */
    private Role $role;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Method for get all post of user
     * @return ArrayCollection
     */
    public function getPosts() : ArrayCollection
    {
        return $this->posts;
    }

    /**
     * Method for get id of user
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method for get username of user
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * Method for set username of user
     * @param string $username
     */
    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    /**
     * Method for get email of user
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Method for set email of user
     * @param string $email
     */
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    /**
     * Method for get name of user
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Method for set name of user
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Method for get lastname of user
     * @return string
     */
    public function getLastname() : string
    {
        return $this->lastname;
    }

    /**
     * Method for set lastname of user
     * @param string $lastname
     */
    public function setLastname(string $lastname) : void
    {
        $this->lastname = $lastname;
    }
}
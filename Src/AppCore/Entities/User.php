<?php
declare(strict_types = 1);

namespace AppCore\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use LaravelDoctrine\ACL\Contracts\Permission;
use LaravelDoctrine\ACL\Contracts\Role;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuth;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionContract;

/**
 * Class Users
 * @package AppCore\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements Authenticatable, CanResetPasswordContract, HasRolesContract, HasPermissionContract
{
    use DoctrineAuth, CanResetPassword, Notifiable, HasRoles, HasPermissions;

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
     * @Version @ORM\Column(name = "updated_at", type = "datetime")
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
     * @ORM\OneToMany(targetEntity="Post", mappedBy="users", cascade={"persist", "remove"}, fetch = "LAZY")
     */
    private ArrayCollection $posts;


    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    private $roles;

    /**
     * @ACL\HasPermissions
     */
    private $permissions;

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


    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions(){

        return $this->permissions;

    }

    /**
     * @param string $permission
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }
}
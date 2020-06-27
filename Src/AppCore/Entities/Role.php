<?php


namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column (name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;
    /**
     * @ORM\Column(name="role", type="string", unique=true)
     */
    private string $role;

    /**
     * @ORM\Column(name="color", type="string")
     */
    private string $color;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role", cascade={"remove"}, fetch="LAZY")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Permissions", inversedBy="role", cascade={"persist"}, fetch="EAGER")
     */
    private $permissions;


    public function __construct()
    {
        $this->permissions = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    /**
     * Method for get id of role
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }


    /**
     * Method for get role name
     * @return string
     */
    public function getName() : string
    {
        return $this->role;
    }

    /**
     * Method for set role name
     * @param string $role
     */
    public function setName(string $role) : void
    {
        $this->role = $role;
    }

    /**
     * Method for get role color
     * @return string
     */
    public function getRoleColor() : string
    {
        return $this->color;
    }

    /**
     * Method for set role color
     * @param string $color
     */
    public function setRoleColor(string $color) : void
    {
        $this->color = $color;
    }

    /**
     * Method for get permissions for role
     * @return array
     */
    public function getPermissions() : array
    {
        return $this->permissions->toArray();
    }

    /**
     * Method for set permissions
     * @param Permissions $permissions
     */
    public function setPermissions(Permissions $permissions) : void
    {
        $this->permissions->add($permissions);
    }
}

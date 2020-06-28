<?php
declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="permissions")
 */
class Permissions
{
    /**
     * @ORM\Id
     * @ORM\Column(name = "id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name = "permission", type = "string", length = 50)
     */
    private string $permission;

    /**
     * @ORM\Column(name = "name", type = "string", length = 50)
     */
    private string $name;


    /**
     * @ORM\ManyToMany(targetEntity = "Role", mappedBy="permission", cascade = {"persist", "remove"}, fetch = "LAZY")
     */
    private $role;


    public function __construct()
    {
        $this->role = new ArrayCollection();
    }

    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method for set permission
     * @param string $permission
     */
    public function setPermission(string $permission) : void
    {
        $this->permission = $permission;
    }

    /**
     * Method for get permission
     * @return string
     */
    public function getPermission() : string
    {
        return $this->permission;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
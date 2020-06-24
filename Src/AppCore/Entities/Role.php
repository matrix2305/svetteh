<?php


namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;

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
     * @ORM\Column(name="role", type="string")
     */
    private string $role;

    /**
     * @ORM\Column(name="color", type="string")
     */
    private string $roleColor;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private string $createdAt;

    /**
     * @Version @ORM\Column(name="updated_at", type="datetime")
     */
    private string $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role", cascade={"persist", "remove"}, fetch="LAZY")
     */
    private User $user;

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
        return $this->roleColor;
    }

    /**
     * Method for set role color
     * @param string $roleColor
     */
    public function setRoleColor(string $roleColor) : void
    {
        $this->roleColor = $roleColor;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
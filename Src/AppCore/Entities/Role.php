<?php


namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Role
 * @package AppCore\Entities
 * @ORM\Entity
 * @ORM\(table = "roles")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column(name = "id", type="bigint")
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
     * @ORM\Column(name = "role_name", type = "string")
     */
    private string $roleMame;

    /**
     * @ORM\Column(name = "role_column", type = "string")
     */
    private string $roleColor;

    /**
     * @OneToMany(targetEntity = "User", mappedBy="roles", cascade={"persist", "remove"}, fetch = "LAZY")
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
     * Method for set id of role
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    /**
     * Method for get role name
     * @return string
     */
    public function getRoleName() : string
    {
        return $this->roleMame;
    }

    /**
     * Method for set role name
     * @param string $roleName
     */
    public function setRoleName(string $roleName) : void
    {
        $this->roleName = $roleName;
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
}
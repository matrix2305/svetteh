<?php


namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;
use LaravelDoctrine\ACL\Contracts\Role as RoleContract;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Mappings as ACL;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements RoleContract
{
    use HasPermissions;

    /**
     * @ORM\Id
     * @ORM\Column (name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private string $createdAt;

    /**
     * @Version @Column(name="updated_at", type="datetime")
     */
    private string $updatedAt;

    /**
     * @ORM\Column(name="role_name", type="string")
     */
    private string $roleMame;

    /**
     * @ORM\Column(name="role_column", type="string")
     */
    private string $roleColor;

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
    public function getName() : string
    {
        return $this->roleMame;
    }

    /**
     * Method for set role name
     * @param string $roleName
     */
    public function setName(string $roleName) : void
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

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setPermissions($permissions){
        $this->permissions = $permissions;
    }
}
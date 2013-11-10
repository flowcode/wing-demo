<?php

namespace flowcode\miweb\domain;

use flowcode\miweb\service\RoleService;

/**
 * Description of Role
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class Role {

    private $id;
    private $name;
    private $permissions;

    function __construct() {
        $this->permissions = NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPermissions() {
        if ($this->permissions == NULL) {
            $roleSrv = new RoleService();
            $this->permissions = $roleSrv->findPermissions($this);
        }
        return $this->permissions;
    }

    public function setPermissions($permissions) {
        $this->permissions = $permissions;
    }

    public function __toString() {
        return $this->name;
    }

}

?>

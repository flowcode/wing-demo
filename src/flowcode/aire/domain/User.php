<?php

namespace flowcode\aire\domain;

use flowcode\aire\service\UserService;

/**
 * Usuario de la aplicacion.
 *
 * @author Juan Manuel Aguero.
 */
class User {

    private $id;
    private $name;
    private $username;
    private $password;
    private $roles;
    private $mail;

    public function __construct() {
        $this->roles = NULL;
    }

    public function __toString() {
        return $this->username;
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

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        if (!is_null($username) && is_string($username)) {
            $this->username = $username;
        }
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (!is_null($password) && is_string($password)) {
            $this->password = $password;
        }
    }

    /**
     * Get roles.
     * @return \Iterator roles.
     */
    public function getRoles() {
        if ($this->roles == NULL) {
            $userSrv = new UserService();
            $this->roles = $userSrv->findRoles($this);
        }
        return $this->roles;
    }

    public function getRolesNames() {
        $roles = "";
        $rolesCollection = $this->getRoles();
        if ($rolesCollection->count() > 0) {
            foreach ($rolesCollection as $role) {
                $roles .= $role->getName() . ", ";
            }
        }
        return $roles;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getMail() {
        return $this->mail;
    }

}

?>

<?php

namespace flowcode\miweb\domain;

/**
 * Description of Permission
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class Permission {

    private $id;
    private $name;

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

    public function __toString() {
        return $this->name;
    }

}

?>

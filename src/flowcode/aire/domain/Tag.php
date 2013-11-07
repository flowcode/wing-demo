<?php

namespace flowcode\aire\domain;

/**
 * Description of Tag
 *
 * @author juanma
 */
class Tag {

    private $name;
    private $id;

    function __construct() {
        $this->id = null;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function __toString() {
        return $this->name;
    }

}

?>

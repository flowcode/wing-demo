<?php

namespace flowcode\miweb\domain;

/**
 * Description of Todo
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class Todo {

    private $id;
    private $description;
    private $priority;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

}

?>

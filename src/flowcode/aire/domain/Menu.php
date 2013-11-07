<?php

namespace flowcode\aire\domain;

/**
 * Description of Menu
 *
 * @author juanma
 */
class Menu {

    private $id;
    private $name;
    private $items = null;

    public function __construct() {
        $this->items = NULL;
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

    public function getItems() {
        if (is_null($this->items)) {
            $itemMenuSrv = new \flowcode\aire\service\ItemMenuService();
            $this->items = $itemMenuSrv->findByMenu($this);
        }
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
    }

    public function getMainItems() {
        $itemMenuSrv = new \flowcode\aire\service\ItemMenuService();
        return $itemMenuSrv->findFathersByMenu($this);
    }

}

?>

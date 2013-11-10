<?php

namespace flowcode\miweb\domain;

use flowcode\miweb\service\ProductService;

/**
 * Description of Product
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class Product {

    private $id;
    private $name;
    private $description;
    private $status;
    private $categorys;
    private $images;

    function __construct() {
        $this->id = null;
        $this->categorys = NULL;
        $this->images = NULL;
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

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCategorys() {
        if ($this->categorys == NULL) {
            $productSrv = new ProductService();
            $this->categorys = $productSrv->findCategorys($this);
        }
        return $this->categorys;
    }

    public function setCategorys($categorys) {
        $this->categorys = $categorys;
    }

    public function getImages() {
        if (is_null($this->images)) {
            $productSrv = new ProductService();
            $this->images = $productSrv->findImages($this);
        }
        return $this->images;
    }

    public function setImages($images) {
        $this->images = $images;
    }

    public function __toString() {
        return $this->name;
    }

}
?>


<?php

namespace flowcode\miweb\domain;

use flowcode\miweb\service\ProductImageService;

/**
 * Description of ProductImage
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class ProductImage {

    private $id;
    private $name;
    private $description;
    private $path;
    private $products;

    function __construct() {
        $this->id = null;
        $this->products = NULL;
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

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getProducts() {
        if ($this->products == NULL) {
            $productImageSrv = new ProductImageService();
            $this->products = $productImageSrv->findProducts($this);
        }
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
    }

    public function __toString() {
        return $this->name;
    }

}
?>


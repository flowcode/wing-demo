<?php

namespace flowcode\miweb\domain;

use flowcode\miweb\service\ProductCategoryService;

/**
 * Description of ProductCategory
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class ProductCategory {

    private $id;
    private $name;
    private $description;
    private $products;

    function __construct() {
        $this->id = null;
        $this->products = NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if (!empty($id))
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

    public function getProducts() {
        if ($this->products == NULL) {
            $productCategorySrv = new ProductCategoryService();
            $this->products = $productCategorySrv->findProducts($this);
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


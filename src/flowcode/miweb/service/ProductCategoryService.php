<?php

namespace flowcode\miweb\service;

use flowcode\miweb\dao\ProductCategoryDao;
use flowcode\miweb\domain\ProductCategory;

/**
 * Description of ProductCategoryService
 *
 * @author juanma
 */
class ProductCategoryService {

    private $productCategoryDao;

    public function __construct() {
        $this->productCategoryDao = new ProductCategoryDao();
    }

    public function findAll() {
        return $this->productCategoryDao->findAll();
    }

    public function save(ProductCategory $productCategory) {
        return $this->productCategoryDao->save($productCategory);
    }

    public function delete(ProductCategory $productCategory) {
        $this->productCategoryDao->delete($productCategory);
    }

    public function findById($id) {
        return $this->productCategoryDao->findById($id);
    }

    /**
     * Find all productCategorys by filter.
     * @return \flowcode\wing\utils\Pager. 
     */
    public function findByFilter($filter = null, $page = 1) {
        $pager = $this->productCategoryDao->findByFilter($filter, $page);
        return $pager;
    }

    public function findProducts(ProductCategory $productCategory) {
        return $this->productCategoryDao->findProducts($productCategory);
    }

}

?>

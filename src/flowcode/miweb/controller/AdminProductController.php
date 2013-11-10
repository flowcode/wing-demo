<?php

namespace flowcode\miweb\controller;

use flowcode\miweb\domain\Product;
use flowcode\miweb\domain\ProductCategory;
use flowcode\miweb\domain\ProductImage;
use flowcode\miweb\domain\UserMessage;
use flowcode\miweb\service\ProductCategoryService;
use flowcode\miweb\service\ProductImageService;
use flowcode\miweb\service\ProductService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * Description of AdminProduct
 *
 * @author juanma
 */
class AdminProductController extends BaseController {

    private $productService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-login");
        $this->productService = new ProductService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["page"] = $httpRequest->getParameter("page");
        if (is_null($viewData["page"]) || empty($viewData["page"])) {
            $viewData["page"] = 1;
        }
        $viewData["pager"] = $this->productService->findByFilter($viewData["filter"], $viewData["page"]);

        return new View($viewData, "backend/shop/productList");
    }

    function create(HttpRequest $HttpRequest) {
        $viewData["product"] = new Product();
        $productCategorySrv = new ProductCategoryService();
        $viewData["categorys"] = $productCategorySrv->findAll();
        $productImageSrv = new ProductImageService();
        $viewData["images"] = $productImageSrv->findAll();
        $viewData['action'] = "Nuevo";
        return new View($viewData, "backend/shop/productForm");
    }

    function save(HttpRequest $httpRequest) {

        /* creo la nueva instancia y seteo valores */
        $product = new Product();
        $product->setId($httpRequest->getParameter("id"));
        $product->setName($httpRequest->getParameter("name"));
        $product->setDescription($httpRequest->getParameter("description"));
        $product->setStatus($httpRequest->getParameter("status"));

        $categorys = array();
        if (isset($_POST["categorys"])) {
            foreach ($_POST["categorys"] as $idproductCategory) {
                $productCategory = new ProductCategory();
                $productCategory->setId($idproductCategory);
                $categorys[] = $productCategory;
            }
        }
        $product->setCategorys($categorys);
        $images = array();
        if (isset($_POST["images"])) {
            foreach ($_POST["images"] as $productImagePath) {
                $productImage = new ProductImage();
                $productImageId = intval($productImagePath);
                if ($productImageId != 0) {
                    $productImage->setId($productImageId);
                } else {
                    $productImage->setPath($productImagePath);
                }
                $images[] = $productImage;
            }
        }
        $product->setImages($images);

        if ($this->productService->save($product)) {
            $viewData['message'] = new UserMessage("success", "Post creado con éxito");
            $this->redirect("/adminProduct/index");
        } else {
            $productCategorySrv = new ProductCategoryService();
            $viewData["categorys"] = $productCategorySrv->findAll();
            $productImageSrv = new ProductImageService();
            $viewData["images"] = $productImageSrv->findAll();
            $viewData['action'] = "Nuevo";
            $viewData['product'] = $product;
            $viewData['message'] = new UserMessage("danger", "Algo salió mal");
            return new View($viewData, "backend/shop/productForm");
        }
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData["product"] = $this->productService->findById($id);
        $productCategorySrv = new ProductCategoryService();
        $viewData["categorys"] = $productCategorySrv->findAll();
        $productImageSrv = new ProductImageService();
        $viewData["images"] = $productImageSrv->findAll();

        $viewData['action'] = "Editar";
        return new View($viewData, "backend/shop/productForm");
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $product = $this->productService->findById($id);
        $this->productService->delete($product);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

}

?>

<?php

namespace flowcode\miweb\controller;

use flowcode\miweb\domain\Product;
use flowcode\miweb\domain\ProductCategory;
use flowcode\miweb\domain\UserMessage;
use flowcode\miweb\service\ProductCategoryService;
use flowcode\miweb\service\ProductService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * Description of AdminProductCategory
 *
 * @author juanma
 */
class AdminProductCategoryController extends BaseController {

    private $productCategoryService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-login");
        $this->productCategoryService = new ProductCategoryService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["page"] = $httpRequest->getParameter("page");
        if (is_null($viewData["page"]) || empty($viewData["page"])) {
            $viewData["page"] = 1;
        }
        $viewData["pager"] = $this->productCategoryService->findByFilter($viewData["filter"], $viewData["page"]);

        return new View($viewData, "backend/shop/productCategoryList");
    }

    function create(HttpRequest $HttpRequest) {
        $viewData["productCategory"] = new ProductCategory();
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();
        $viewData["action"] = "nueva";
        return new View($viewData, "backend/shop/productCategoryForm");
    }

    function save(HttpRequest $httpRequest) {

        /* creo la nueva instancia y seteo valores */
        $productCategory = new ProductCategory();
        $productCategory->setId($httpRequest->getParameter("id"));
        $productCategory->setName($httpRequest->getParameter("name"));
        $productCategory->setDescription($httpRequest->getParameter("description"));

        $products = array();
        if (isset($_POST["products"])) {
            foreach ($_POST["products"] as $idproduct) {
                $product = new Product();
                $product->setId($idproduct);
                $products[] = $product;
            }
        }
        $productCategory->setProducts($products);

        if ($this->productCategoryService->save($productCategory)) {
            $viewData['message'] = new UserMessage("success", "Categoria creado con éxito");
            $this->redirect("/adminProductCategory/index");
        } else {
            $viewData['action'] = "Nuevo";
            $viewData['productCategory'] = $productCategory;
            $productSrv = new ProductService();
            $viewData["products"] = $productSrv->findAll();
            $viewData['message'] = new UserMessage("danger", "Algo salió mal");
            return new View($viewData, "backend/shop/productCategoryForm");
        }
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData["productCategory"] = $this->productCategoryService->findById($id);
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();
        $viewData['action'] = "Editar";
        return new View($viewData, "backend/shop/productCategoryForm");
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $productCategory = $this->productCategoryService->findById($id);
        $this->productCategoryService->delete($productCategory);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

}

?>

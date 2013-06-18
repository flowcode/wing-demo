<?php

namespace flowcode\front\controller;

use flowcode\shop\service\ProductService;
use flowcode\wing\mvc\Controller;
use flowcode\wing\mvc\HttpRequest;
use flowcode\wing\mvc\View;

/**
 * Description of ProductController
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class ProductController extends Controller {

    private $productService;

    public function __construct() {
        $this->setIsSecure(FALSE);
        $this->productService = new ProductService();
    }

    public function index(HttpRequest $httpRequest) {
        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["numpage"] = $httpRequest->getParameter("page");
        if (is_null($viewData["numpage"]) || empty($viewData["numpage"])) {
            $viewData["numpage"] = 1;
        }
        $viewData["page"] = new \flowcode\cms\domain\Page();
        $viewData["page"]->setName("Products");
        $viewData["page"]->setDescription("Products");
        $viewData["pager"] = $this->productService->findByFilter($viewData["filter"], $viewData["numpage"]);

        return View::getControllerView($this, "front/view/product/productList", $viewData);
    }

    public function view(HttpRequest $httpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $httpRequest->getParams();
        $id = $params[0];

        $viewData["product"] = $this->productService->findById($id);

        return View::getControllerView($this, "front/view/product/product", $viewData);
    }

}

?>

<?php

namespace flowcode\miweb\controller;

use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * 
 */
class AdminHelpController extends BaseController {

    public function __construct() {
        $this->setIsSecure(true);
        $this->addPermission("admin-login");
    }

    public function index(HttpRequest $httpRequest) {
        $viewData["message"] = "";
        return new View($viewData, "backend/cms/help");
    }

}

?>

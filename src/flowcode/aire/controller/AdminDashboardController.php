<?php

namespace flowcode\aire\controller;

use flowcode\aire\service\UserService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;


/**
 * 
 */
class AdminDashboardController extends BaseController {

    private $userService;

    public function __construct() {
        $this->userService = new UserService();
        $this->setIsSecure(true);
        $this->addPermission("admin-login");
    }

    public function index(HttpRequest $httpRequest) {
        $viewData["message"] = "";
        return new View($viewData, "backend/admin-home");
    }
    
}

?>

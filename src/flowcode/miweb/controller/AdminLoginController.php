<?php

namespace flowcode\miweb\controller;

use flowcode\miweb\service\UserService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * 
 */
class AdminLoginController extends BaseController {

    private $userService;

    public function __construct() {
        $this->userService = new UserService();
        $this->setIsSecure(false);
    }

    public function index(HttpRequest $httpRequest) {
        $viewData["message"] = "";
        $viewData = null;
        return new View($viewData, "backend/cms/login");
    }

    public function validate(HttpRequest $httpRequest) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($this->userService->loginUsuario($username, $password)) {
            $this->redirect("/admin");
            return true;
        }

        $viewData["message"] = "Invalid username and password combination";

        return new View($viewData, "backend/login/index");
    }

    public function logout(HttpRequest $httpRequest) {
        // destroy session
        session_destroy();
        $this->redirect("/adminLogin/index");
    }

    public function restricted(HttpRequest $httpRequest) {
        $viewData["message"] = "";
        $viewData["data"] = "";
        return new BareView($viewData, "cms/view/admin/restricted");
    }

}

?>

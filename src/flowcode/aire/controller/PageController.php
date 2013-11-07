<?php

namespace flowcode\aire\controller;

use flowcode\aire\domain\Page;
use flowcode\aire\domain\PlainPageManager;
use flowcode\aire\service\PageService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\Enlace;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * 
 */
class PageController extends BaseController {

    private $pageService;

    function __construct() {
        $this->setIsSecure(false);
        $this->pageService = new PageService();
        $this->setName("page");
        $this->setModule("cms");
    }

    public function index(HttpRequest $httpRequest) {
        $viewData['data'] = "";
        return new View($viewData, "frontend/page/index");
    }

    public static function getPageByPermalink($permalink) {
        $page = $this->pageService->getPageByPermalink($permalink);
        return $page;
    }

    public function manage(HttpRequest $httpRequest) {
        $permalink = substr($httpRequest->getRequestedUrl(), 1);

        $page = null;
        if (strlen($permalink) <= 0) {
            $permalink = Enlace::get("homepage", "permalink");
        }
        $page = $this->pageService->getPageByPermalink($permalink);

        if (is_null($page)) {
            return $this->manageNotFound($permalink);
        }

        switch ($page->getType()) {
            case Page::$type_plain:
                return $this->managePlainPage($page);
                break;
            case Page::$type_custom:
                $this->manageCustomPage($page);
                break;
            default:
                $this->manageNotFound($permalink);
                break;
        }
    }

    private function managePlainPage(Page $page) {
        $pm = new PlainPageManager($page);
        $viewData = $pm->getViewData();

        return new View($viewData, "frontend/page/plain-page");
    }

    private function manageCustomPage(Page $page) {
        die("not implemented");
        require_once "view/page/pageList.view.php";
    }

    private function manageNotFound($permalink) {
        $viewData['page'] = new Page();
        $viewData['msg'] = "";
        return new View($viewData, "frontend/page/page-not-found");
    }

    public function error() {
        $viewData['data'] = "";
        return new View($viewData, "backend/page/error-page");
    }

}

?>

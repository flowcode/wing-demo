<?php

namespace flowcode\aire\controller;

use flowcode\aire\domain\Page;
use flowcode\aire\domain\UserMessage;
use flowcode\aire\service\PageService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;
use flowcode\wing\utils\PermalinkBuilder;

/**
 * Description of AdminPageController
 *
 * @author juanma
 */
class AdminPageController extends BaseController {

    private $pageSrv;

    function __construct() {
        $this->pageSrv = new PageService();
        $this->addPermission("admin-page-create");
        $this->addPermission("admin-page-delete");
        $this->addPermission("admin-page-update");
        $this->setIsSecure(true);
    }

    public function pages(HttpRequest $httpRequest) {

        $viewData['filter'] = $httpRequest->getParameter('search');

        $viewData['page'] = $httpRequest->getParameter('page');
        if (is_null($viewData['page']) || empty($viewData['page'])) {
            $viewData['page'] = 1;
        }

        $viewData['pager'] = $this->pageSrv->findByFilter($viewData['filter'], $viewData['page']);

        return new View($viewData, "backend/cms/pages");
    }

    public function createSimple(HttpRequest $httpRequest) {
        $viewData['page'] = new Page();
        $viewData['action'] = "Nueva";
        return new View($viewData, "backend/cms/pageFormSimple");
    }
    
    public function createList(HttpRequest $httpRequest) {
        $viewData['page'] = new Page();
        $viewData['action'] = "Nueva";
        return new View($viewData, "backend/cms/pageForm");
    }
    
    public function createGallery(HttpRequest $httpRequest) {
        $viewData['page'] = new Page();
        $viewData['action'] = "Nueva";
        return new View($viewData, "backend/cms/pageForm");
    }

    public function save(HttpRequest $httpRequest) {

        // obtengo los datos
        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : NULL;
        $name = $httpRequest->getParameter("name");
        $permalink = $this->buildPermalink($name);

        $page = new Page();
        $page->setId($id);
        $page->setName($name);
        $page->setPermalink($permalink);
        $page->setDescription($httpRequest->getParameter("description"));
        $page->setHtmlContent($httpRequest->getParameter("htmlContent"));
        $page->setStatus($httpRequest->getParameter("status"));
        $page->setType($httpRequest->getParameter("type"));

        // la guardo
        $id = $this->pageSrv->savePage($page);

        if (!empty($id)) {
            $viewData['message'] = new UserMessage("success", "Página creada con éxito.");
            $this->redirect("/adminPage/pages");
        } else {
            $viewData['action'] = "Editar";
            $viewData['page'] = $page;
            $viewData['message'] = new UserMessage("danger", "Algo salió mal.");
            return new View($viewData, "backend/cms/pageForm");
        }
    }

    public function edit(HttpRequest $httpRequest) {
        $idPage = $httpRequest->getParameter("id");

        $pageSrv = new PageService();
        $page = $pageSrv->findPageById($idPage);

        $viewData['action'] = "Editar";
        $viewData['page'] = $page;
        return new View($viewData, "backend/cms/pageFormSimple");
    }

    public function delete(HttpRequest $httpRequest) {
        $idPage = $httpRequest->getParameter("id");

        $pageSrv = new PageService();
        $page = $pageSrv->findPageById($idPage);
        $pageSrv->delete($page);

        $this->redirect("/adminPage/pages");
    }

    private function buildPermalink($title) {

        $permalinkBuilder = new PermalinkBuilder();
        $permalinkBuilder->setInputString($title);
        $permalinkBuilder->build();
        $permalink = $permalinkBuilder->getPermalink();

        $pages = $this->pageSrv->getPagesByPermalinkAprox($permalink);
        $permalinkBuilder->setSimilarCount($pages->count());
        $permalinkBuilder->build();
        $permalink = $permalinkBuilder->getPermalink();
        return $permalink;
    }

}

?>
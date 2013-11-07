<?php

namespace flowcode\aire\controller;

use flowcode\aire\service\PageService;
use flowcode\aire\service\PostService;
use flowcode\aire\service\TagService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * Description of HomeController
 *
 * @author juanma
 */
class BlogController extends BaseController {

    public function __construct() {
        $this->setIsSecure(FALSE);
    }

    public function post(HttpRequest $httpRequest) {

        $p = $httpRequest->getParams();
        $permalink = $p[0];

        $postSrv = new PostService();
        $post = $postSrv->findByPermalink($permalink);

//        $page = new Page();
//        $page->setName($post->getTitle());
//        if (strlen($post->getDescription()) > 0) {
//            $page->setDescription($post->getDescription());
//        }
//        $viewData['page'] = $page;
        $viewData['post'] = $post;
        
        $tagSrv = new TagService();
        $viewData['tags'] = $tagSrv->findAll();

        return new View($viewData, "frontend/blog/post");
    }

    public function index(HttpRequest $httpRequest) {

        $pageSrv = new PageService();
        $viewData['page'] = $pageSrv->getPageByPermalink("blog");

        $viewData['tag'] = $httpRequest->getParameter('tag');

        $viewData['pageNumber'] = $httpRequest->getParameter('page');
        if (is_null($viewData['pageNumber']) || empty($viewData['pageNumber'])) {
            $viewData['pageNumber'] = 1;
        }
        
        $tagSrv = new TagService();
        $viewData['tags'] = $tagSrv->findAll();

        $postSrv = new PostService();
        $viewData['pager'] = $postSrv->findByTag($viewData['tag'], $httpRequest->getParameter('year'), $httpRequest->getParameter('month'), $viewData['pageNumber']);

        return new View($viewData, "frontend/blog/index");
    }
    


}

?>

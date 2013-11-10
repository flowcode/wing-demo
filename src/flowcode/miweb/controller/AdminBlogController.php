<?php

namespace flowcode\miweb\controller;

use flowcode\miweb\domain\Post;
use flowcode\miweb\domain\Tag;
use flowcode\miweb\domain\UserMessage;
use flowcode\miweb\service\PostService;
use flowcode\miweb\service\TagService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;
use flowcode\wing\utils\PermalinkBuilder;

/**
 * Description of AdminNoticia
 *
 * @author Juan Manuel Aguero. 
 */
class AdminBlogController extends BaseController {

    private $postService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-blog-post-create");
        $this->addPermission("admin-blog-post-edit");
        $this->addPermission("admin-blog-post-delete");
        $this->postService = new PostService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData['filter'] = $httpRequest->getParameter('search');

        $viewData['page'] = $httpRequest->getParameter('page');
        if (is_null($viewData['page']) || empty($viewData['page'])) {
            $viewData['page'] = 1;
        }

        $viewData['pager'] = $this->postService->findByFilter($viewData['filter'], $viewData['page']);
        return new View($viewData, "backend/post/postList");
    }

    /**
     * Acceder a la creacion de una nueva entidad.
     * @param type $HttpRequest 
     */
    public function createPost($HttpRequest) {

        $viewData['post'] = new Post();

        // tags
        $tagSrv = new TagService();
        $viewData['tags'] = $tagSrv->findAll();
        $viewData['action'] = "Nuevo";

        return new View($viewData, "backend/post/postForm");
    }

    /**
     * Guardar una entidad.
     * @param type $HttpRequest 
     */
    function savePost(HttpRequest $httpRequest) {

        // obtengo los datos
        $title = $httpRequest->getParameter("title");

        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : NULL;
        $permalink = (isset($_POST['permalink']) && !empty($_POST['permalink'])) ? $_POST['permalink'] : $this->buildPermalink($title);

        $tags = array();
        if (isset($_POST['tags'])) {
            foreach ($_POST['tags'] as $idTag) {
                $tag = new Tag();
                $tag->setId($idTag);
                $tags[] = $tag;
            }
        }

        // creo la nueva instancia y seteo valores
        $post = new Post();
        $post->setId($id);
        $post->setPermalink($permalink);
        $post->setTitle($title);
        $post->setDescription($httpRequest->getParameter("description"));
        $post->setIntro($httpRequest->getParameter("intro"));
        $post->setBody($httpRequest->getParameter("body"));
        $post->setType($httpRequest->getParameter("type"));
        $post->setStatus(Post::$published);
        $post->setDate($httpRequest->getParameter("date"));
        $post->setTags($tags);

        if ($this->postService->save($post)) {
            $viewData['message'] = new UserMessage("success", "Post creado con éxito");
            $this->redirect("/adminBlog/index");
        } else {
            // tags
            $tagSrv = new TagService();
            $viewData['tags'] = $tagSrv->findAll();
            $viewData['action'] = "Nuevo";
            $viewData['post'] = $post;
            $viewData['message'] = new UserMessage("danger", "Algo salió mal");
            return new View($viewData, "backend/post/postForm");
        }
    }

    /**
     * Modificar una entidad.
     * @param type $HttpRequest 
     */
    function editPost($HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $post = $this->postService->findById($id);
        $viewData['post'] = $post;

        // tags
        $tagSrv = new TagService();
        $viewData['tags'] = $tagSrv->findAll();

        $viewData['action'] = "Editar";

        return new View($viewData, "backend/post/postForm");
    }

    /**
     * Eliminar una entidad.
     * @param type $HttpRequest 
     */
    function deletePost($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $post = $this->postService->findById($id);
        $this->postService->delete($post);

        $this->redirect("/adminBlog/index");
    }

    private function buildPermalink($title) {

        $permalinkBuilder = new PermalinkBuilder();
        $permalinkBuilder->setInputString($title);
        $permalinkBuilder->build();
        $permalink = $permalinkBuilder->getPermalink();

        $posts = $this->postService->getBySimilarPermalink($permalink);
        $permalinkBuilder->setSimilarCount(count($posts));
        $permalinkBuilder->build();
        $permalink = $permalinkBuilder->getPermalink();
        return $permalink;
    }

    public function tags(HttpRequest $httpRequest) {
        $tagSrv = new TagService();
        $viewData['filter'] = $httpRequest->getParameter('search');

        $viewData['page'] = $httpRequest->getParameter('page');
        if (is_null($viewData['page']) || empty($viewData['page'])) {
            $viewData['page'] = 1;
        }

        $viewData['pager'] = $tagSrv->findByFilter($viewData['filter'], $viewData['page']);

        return new View($viewData, "backend/post/tags");
    }

    public function createTag(HttpRequest $httpRequest) {
        $viewData['tag'] = new Tag();
        $viewData["action"] = "Nuevo";
        return new View($viewData, "backend/post/tagForm");
    }

    public function editTag(HttpRequest $httpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $httpRequest->getParams();
        $id = $params[0];

        $tagSrv = new TagService();
        $viewData['tag'] = $tagSrv->findById($id);
        $viewData["action"] = "Editar";
        return new View($viewData, "backend/post/tagForm");
    }

    public function saveTag(HttpRequest $httpRequest) {
        $tag = new Tag();
        if (!is_null($httpRequest->getParameter("id")) && $httpRequest->getParameter("id") != "") {
            $tag->setId($httpRequest->getParameter("id"));
        }
        $tag->setName($httpRequest->getParameter("name"));

        $tagSrv = new TagService();
        $id = $tagSrv->save($tag);

        if (!empty($id)) {
            $viewData['message'] = new UserMessage("success", "Post creado con éxito");
            $this->redirect("/adminBlog/tags");
        } else {
            $viewData["action"] = "Editar";
            $viewData['tag'] = $tag;
            $viewData['message'] = new UserMessage("danger", "El no pudo ser guardado.");
            return new View($viewData, "backend/post/tagForm");
        }
    }

    public function deleteTag(HttpRequest $httpRequest) {
        $p = $httpRequest->getParams();
        $idTag = $p[0];
        $tagSrv = new TagService();
        $tag = $tagSrv->findById($idTag);
        $tagSrv->delete($tag);

        $this->redirect("/adminBlog/tags");
    }

}

?>

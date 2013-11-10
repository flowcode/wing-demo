<?php

namespace flowcode\miweb\service;

use flowcode\miweb\dao\PostDao;
use flowcode\miweb\domain\Post;


/**
 * 
 */
class PostService {

    private $postDao;

    function __construct() {
        $this->postDao = new PostDao();
    }

    /**
     * Save a post.
     * @param Post $post
     * @return type
     */
    public function save(Post $post) {
        return $this->postDao->save($post);
    }

    /**
     * Obtiene todas las Noticias.
     * @return type 
     */
    public function findByFilter($filter = null, $page = 1) {
        $pager = $this->postDao->findByFilter($filter, $page);
        return $pager;
    }

    /**
     * Obtiene noticas filtradas.
     * @return type 
     */
    public function findByTag($tag, $year, $month, $page = 1) {
        $pager = $this->postDao->findByTagYearMonth($tag, $year, $month, $page);
        return $pager;
    }

    /**
     * 
     * @param type $id
     * @return Post $post.
     */
    public function findById($id) {
        return $this->postDao->findById($id);
    }

    /**
     * Find a post by its permalinl.
     * @param type $permalink
     * @return Post $post.
     */
    public function findByPermalink($permalink) {
        $post = $this->postDao->findByPermalink($permalink);
        return $post;
    }

    /**
     * Gets posts with similar permalinks.
     * @return array $posts
     */
    public function getBySimilarPermalink($permalink) {
        $posts = $this->postDao->getBySimilarPermalink($permalink);
        return $posts;
    }

    /**
     * Elimina la Noticia correspondiente al id.
     * 
     * @param type $id 
     */
    public function delete(Post $post) {
        $this->postDao->delete($post);
    }

    public function findTagsByPost(Post $post) {
        return $this->postDao->findTags($post);
    }

}

?>

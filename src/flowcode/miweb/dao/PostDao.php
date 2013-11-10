<?php

namespace flowcode\miweb\dao;

use flowcode\miweb\domain\Post;
use flowcode\ceibo\builder\MapperBuilder;
use flowcode\ceibo\EntityManager;
use flowcode\wing\utils\Pager;

class PostDao {

    public function __construct() {
        
    }

    public function save(Post $post) {
        return EntityManager::getInstance()->save($post);
    }

    public function findById($id) {
        $em = EntityManager::getInstance();
        return $em->findById("post", $id);
    }

    /**
     * Delete entity from database.
     * @param Post $post 
     */
    function delete(Post $post) {
        $em = EntityManager::getInstance();
        $em->delete($post);
    }

    /**
     * Find entitys by the configured filter.
     * @param type $filter
     * @param type $page
     * @return Pager
     */
    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("post", $filter, $page, "date", "desc");
        return $pager;
    }

    /**
     * Get post with similar permalinks.
     * @param String $permalink
     * @return array
     */
    public function getBySimilarPermalink($permalink) {

        $em = EntityManager::getInstance();
        $posts = $em->findByWhereFilter("post", "permalink LIKE '$permalink%' ", "date", "desc");

        return $posts;
    }

    public function findByPermalink($permalink) {
        $post = NULL;
        $em = EntityManager::getInstance();
        $posts = $em->findByWhereFilter("post", "permalink = '$permalink' ", "date", "desc");
        if ($posts->count() > 0) {
            $posts->rewind();
            $post = $posts->current();
        }
        return $post;
    }

    /**
     * 
     */
    function findByTagYearMonth($tag, $year, $month, $page = 1) {
        $cantSlotsPorPagina = 10;
        $desde = ($page - 1) * $cantSlotsPorPagina;

        $selectQuery = "SELECT * FROM post p ";
        $id = 'id';
        if (isset($tag) && $tag != null) {
            $selectQuery .= ", post_tag pt, tag t ";
        }

        $whereQuery = " WHERE 1=1 ";
        if (isset($tag) && $tag != null) {
            $whereQuery .= "AND pt.id_post = p.id ";
            $whereQuery .= "AND pt.id_tag = t.id ";
            $whereQuery .= "AND t.name = '" . $tag . "' ";
            $id = 'id_noticia';
        }
        if (isset($year) && $year != null) {
            $whereQuery .= " AND YEAR(p.date) = '" . $year . "'";
        }
        if (isset($month) && $month != null) {
            $whereQuery .= " AND MONTH(p.date) = '" . $month . "'";
        }
        $orderQuery = " ORDER BY p.date DESC ";
        $pageQuery = " LIMIT $desde , $cantSlotsPorPagina ";

        $noticias = array();
        $query = $selectQuery . $whereQuery . $orderQuery . $pageQuery;

        $result = EntityManager::getInstance()->getDataSource()->query($query);
        if ($result) {
            foreach ($result as $fila) {
                $mapper = MapperBuilder::buildFromName(EntityManager::getInstance()->getMapping(), "post");
                $noticias[] = $mapper->createObject($fila);
            }
        }

        $selectCountQuery = "SELECT count(*) as total FROM post p ";
        $id = 'id';
        if (isset($tag) && $tag != null) {
            $selectCountQuery .= ", post_tag pt, tag t ";
        }
        $query = $selectCountQuery . $whereQuery;

        $result = EntityManager::getInstance()->getDataSource()->query($query);
        $itemCount = $result[0]["total"];
        $pager = new Pager($noticias, $itemCount, $cantSlotsPorPagina, $page);

        return $pager;
    }

    public function findTags(Post $post) {
        $em = EntityManager::getInstance();
        $tags = $em->findRelation($post, "Tags");
        return $tags;
    }

}

?>
